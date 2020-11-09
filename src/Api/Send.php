<?php

declare(strict_types=1);

namespace Kerox\Fcm\Api;

use Fig\Http\Message\RequestMethodInterface;
use Kerox\Fcm\Model\Message;
use Psr\Http\Message\ResponseInterface;

class Send extends AbstractApi
{
    public function message(Message $message, bool $validateOnly = false): ResponseInterface
    {
        $uri = sprintf('%s/messages:send', $this->projectId);

        $request = $this->createRequest(RequestMethodInterface::METHOD_POST, $uri, [
            'message' => $message,
            'validate_only' => $validateOnly,
        ]);

        return $this->client->sendRequest($request);
    }
}
