<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Notification\WebpushNotification;
use Kerox\Fcm\Model\Message\Options\WebpushFcmOptions;

class WebpushConfig implements \JsonSerializable
{
    use ValidatorTrait;

    private array $headers = [];
    private array $data = [];
    private ?WebpushNotification $notification = null;
    private ?WebpushFcmOptions $fcmOptions = null;

    public function setHeaders(array $headers): self
    {
        $this->isValidData($headers);

        $this->headers = $headers;

        return $this;
    }

    public function setData(array $data): self
    {
        $this->isValidData($data);

        $this->data = $data;

        return $this;
    }

    public function setNotification(WebpushNotification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    public function setFcmOptions(WebpushFcmOptions $fcmOptions): self
    {
        $this->fcmOptions = $fcmOptions;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'headers' => $this->headers,
            'data' => $this->data,
            'notification' => $this->notification,
            'fcm_options' => $this->fcmOptions,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
