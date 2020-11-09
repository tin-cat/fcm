<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

abstract class AbstractNotification implements NotificationInterface, \JsonSerializable
{
    protected string $title;
    protected ?string $body = null;

    abstract public function setBody(string $body): self;

    public function toArray(): array
    {
        $array = [
            'title' => $this->title,
            'body' => $this->body,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
