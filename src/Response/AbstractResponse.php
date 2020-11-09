<?php

declare(strict_types=1);

namespace Kerox\Fcm\Response;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractResponse implements ResponseInterface
{
    private ResponseInterface $response;
    private Serializer $serializer;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->serializer = new Serializer(
            [
                new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), null, new ReflectionExtractor()),
                new ArrayDenormalizer(),
            ],
            [
                new JsonEncoder(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getProtocolVersion(): string
    {
        return $this->response->getProtocolVersion();
    }

    /**
     * {@inheritdoc}
     */
    public function withProtocolVersion($version)
    {
        $new = clone $this;
        $new->response->withProtocolVersion($version);

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    /**
     * {@inheritdoc}
     */
    public function hasHeader($name): bool
    {
        return $this->response->hasHeader($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader($name): array
    {
        return $this->response->getHeader($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaderLine($name): string
    {
        return $this->response->getHeaderLine($name);
    }

    /**
     * {@inheritdoc}
     */
    public function withHeader($name, $value)
    {
        $new = clone $this;
        $new->response->withHeader($name, $value);

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public function withAddedHeader($name, $value)
    {
        $new = clone $this;
        $new->response->withAddedHeader($name, $value);

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public function withoutHeader($name)
    {
        $new = clone $this;
        $new->response->withoutHeader($name);

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): StreamInterface
    {
        return $this->response->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function withBody(StreamInterface $body)
    {
        $new = clone $this;
        $new->response->withBody($body);

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * {@inheritdoc}
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        $new = clone $this;
        $new->response->withStatus($code, $reasonPhrase);

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public function getReasonPhrase(): string
    {
        return $this->response->getReasonPhrase();
    }

    /**
     * @return array|object|null
     */
    protected function getDeserializeBody(string $type)
    {
        if ($this->getStatusCode() >= StatusCodeInterface::STATUS_OK) {
            return $this->serializer->deserialize((string) $this->getBody(), $type, JsonEncoder::FORMAT);
        }

        return null;
    }
}
