<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification;
use Kerox\Fcm\Model\Message\Options\ApnsFcmOptions;

class ApnsConfig implements \JsonSerializable
{
    use ValidatorTrait;

    private array $headers = [];
    private ?ApnsNotification $payload = null;
    private ?ApnsFcmOptions $fcmOptions = null;

    public function setHeaders(array $headers): self
    {
        $this->isValidData($headers);

        $this->headers = $headers;

        return $this;
    }

    public function setPayload(ApnsNotification $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    public function setFcmOptions(ApnsFcmOptions $fcmOptions): self
    {
        $this->fcmOptions = $fcmOptions;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'headers' => $this->headers,
            'payload' => $this->payload,
            'fcm_options' => $this->fcmOptions,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
