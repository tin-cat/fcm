<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

class FcmOptions implements \JsonSerializable
{
    private ?string $analyticsLabel = null;

    public function setAnalyticsLabel(string $analyticsLabel): self
    {
        $this->analyticsLabel = $analyticsLabel;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'analytics_label' => $this->analyticsLabel,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
