<?php

declare(strict_types=1);

namespace Kerox\Fcm\Api;

use Kerox\Fcm\Fcm;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractApi implements RequestFactoryInterface, UriFactoryInterface
{
    protected string $apiKey;
    protected string $oauthToken;
    protected string $projectId;
    protected ClientInterface $client;
    protected Psr17Factory $factory;
    protected Serializer $serializer;

    public function __construct(string $apiKey, string $oauthToken, string $projectId, ClientInterface $client)
    {
        $this->apiKey = $apiKey;
        $this->oauthToken = $oauthToken;
        $this->projectId = $projectId;
        $this->client = $client;
        $this->factory = new Psr17Factory();
        $this->serializer = new Serializer(
            [new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())],
            [new JsonEncoder()]
        );
    }

    public function createUri(string $uri = '', array $queryParameters = []): UriInterface
    {
        $queryParameters += ['key' => $this->apiKey];

        $query = [];
        foreach ($queryParameters as $parameter => $value) {
            if (\is_array($value)) {
                $value = implode(',', $value);
            }

            $query[] = sprintf('%s=%s', $parameter, urlencode((string) $value));
        }

        if (!empty($query)) {
            $uri = sprintf('%s?%s', $uri, implode('&', $query));
        }

        return $this->factory->createUri(sprintf('%s/%s/%s', Fcm::API_URL, Fcm::API_VERSION, $uri));
    }

    public function createRequest(string $method, $uri, array $body = []): RequestInterface
    {
        if (!($uri instanceof UriInterface)) {
            $uri = $this->createUri($uri);
        }

        $content = $this->serializer->serialize($body, JsonEncoder::FORMAT, [ObjectNormalizer::SKIP_NULL_VALUES => true]);

        return $this->factory->createRequest($method, $uri)
            ->withHeader('Authorization', sprintf('Bearer %s', $this->oauthToken))
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json')
            ->withBody($this->factory->createStream($content));
    }
}
