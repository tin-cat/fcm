<?php

declare(strict_types=1);

namespace Kerox\Fcm\Tests\Api;

use Kerox\Fcm\Api\Send;
use Kerox\Fcm\Model\Message;
use PHPUnit\Framework\TestCase;

class SendTest extends TestCase
{
    public function testSendMessage(): void
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../Mocks/Response/Send/basic.json');
        $mockedResponse = new MockHandler([
            new Response(200, [], $bodyResponse),
        ]);

        $handler = HandlerStack::create($mockedResponse);
        $client = new Client([
            'handler' => $handler,
        ]);

        $sendApi = new Send('abcd1234', 'myproject-b5ae1', $client);

        $message = new Message('Breaking News');
        $message->setToken('4321dcba');

        $response = $sendApi->message($message, true);

        self::assertSame('projects/myproject-b5ae1/messages/0:1500415314455276%31bd1c9631bd1c96', $response->getName());
        self::assertSame('0:1500415314455276%31bd1c9631bd1c96', $response->getMessageId());
    }

    public function testSendMessageWithResponseError(): void
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../Mocks/Response/Send/error.json');
        $mockedResponse = new MockHandler([
            new Response(200, [], $bodyResponse),
        ]);

        $handler = HandlerStack::create($mockedResponse);
        $client = new Client([
            'handler' => $handler,
        ]);

        $sendApi = new Send('abcd1234', 'myproject-b5ae1', $client);

        $message = new Message('Breaking News');
        $message->setToken('4321dcba');

        $response = $sendApi->message($message, true);

        self::assertNull($response->getName());
        self::assertNull($response->getMessageId());
        self::assertTrue($response->hasError());
        self::assertSame('UNSPECIFIED_ERROR', $response->getErrorCode());
        self::assertSame('No more information is available about this error.', $response->getErrorMessage());
    }
}
