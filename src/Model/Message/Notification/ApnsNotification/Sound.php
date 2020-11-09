<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification\ApnsNotification;

class Sound implements \JsonSerializable
{
    public const DEFAULT_NAME = 'default';

    private int $critical = 0;
    private string $name = self::DEFAULT_NAME;
    private float $volume = 0.0;

    public function isCritical(bool $critical = true): self
    {
        $this->critical = (int) $critical;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setVolume(float $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'critical' => $this->critical,
            'name' => $this->name,
            'volume' => $this->volume,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
