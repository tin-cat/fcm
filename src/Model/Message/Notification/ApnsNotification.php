<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification;

use Kerox\Fcm\Helper\UtilityTrait;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound;

class ApnsNotification implements \JsonSerializable
{
    use UtilityTrait;

    private ?Alert $alert = null;
    private string $sound = Sound::DEFAULT_NAME;
    private int $badge = 1;
    private int $contentAvailable = 0;
    private ?string $category = null;
    private ?string $threadId = null;
    private int $mutableContent = 0;
    private ?string $targetContentId = null;

    /**
     * @param string|\Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert $alert
     */
    public function setAlert($alert): self
    {
        if (\is_string($alert)) {
            $alert = new Alert($alert);
        }

        if (!$alert instanceof Alert) {
            throw new \InvalidArgumentException(sprintf('alert must be a string or an instance of "%s".', Alert::class));
        }

        $this->alert = $alert;

        return $this;
    }

    /**
     * @param \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound|string $sound
     */
    public function setSound($sound): self
    {
        $this->sound = $sound;

        return $this;
    }

    public function setBadge(bool $badge): self
    {
        $this->badge = (int) $badge;

        return $this;
    }

    public function setContentAvailable(bool $contentAvailable): self
    {
        $this->contentAvailable = (int) $contentAvailable;

        return $this;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function setThreadId(string $threadId): self
    {
        $this->threadId = $threadId;

        return $this;
    }

    public function isMutableContent(bool $mutableContent = true): self
    {
        $this->mutableContent = (int) $mutableContent;

        return $this;
    }

    public function setTargetContentId(string $targetContentId): self
    {
        $this->targetContentId = $targetContentId;

        return $this;
    }

    public function toArray(): array
    {
        $json = [
            'alert' => $this->alert,
            'badge' => $this->badge,
            'sound' => $this->sound,
            'thread-id' => $this->threadId,
            'category' => $this->category,
            'content-available' => $this->contentAvailable,
            'mutable-content' => $this->mutableContent,
            'target-content-id' => $this->targetContentId,
        ];

        return $this->arrayFilter(['aps' => $json]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
