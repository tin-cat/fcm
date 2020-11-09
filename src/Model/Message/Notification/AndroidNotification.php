<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification;

use Kerox\Fcm\Model\Message\AbstractNotification;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification\LightSettings;

class AndroidNotification extends AbstractNotification
{
    public const PRIORITY_UNSPECIFIED = 'PRIORITY_UNSPECIFIED';
    public const PRIORITY_MIN = 'PRIORITY_MIN';
    public const PRIORITY_LOW = 'PRIORITY_LOW';
    public const PRIORITY_DEFAULT = 'PRIORITY_DEFAULT';
    public const PRIORITY_HIGH = 'PRIORITY_HIGH';
    public const PRIORITY_MAX = 'PRIORITY_MAX';

    public const VISIBILITY_UNSPECIFIED = 'VISIBILITY_UNSPECIFIED';
    public const VISIBILITY_PRIVATE = 'PRIVATE';
    public const VISIBILITY_PUBLIC = 'PUBLIC';
    public const VISIBILITY_SECRET = 'SECRET';

    private ?string $icon = null;
    private ?string $color = null;
    private ?string $sound = null;
    private ?string $tag = null;
    private ?string $clickAction = null;
    private ?string $bodyLocKey = null;
    private ?string $bodyLocArgs = null;
    private ?string $titleLocKey = null;
    private ?string $titleLocArgs = null;
    private ?string $channelId = null;
    private ?string $ticker = null;
    private bool $sticky = false;
    private ?string $eventTime = null;
    private bool $localOnly = false;
    private string $notificationPriority = self::PRIORITY_UNSPECIFIED;
    private bool $defaultSound = false;
    private bool $defaultVibrateTimings = false;
    private bool $defaultLightSettings = false;
    private array $vibrateTimings = [];
    private string $visibility = self::VISIBILITY_UNSPECIFIED;
    private int $notificationCount = 0;
    private ?LightSettings $lightSettings = null;
    private ?string $image = null;

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function setSound(string $sound): self
    {
        $this->sound = $sound;

        return $this;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function setClickAction(string $clickAction): self
    {
        $this->clickAction = $clickAction;

        return $this;
    }

    public function setBodyLocKey(string $bodyLocKey): self
    {
        $this->bodyLocKey = $bodyLocKey;

        return $this;
    }

    public function setBodyLocArgs(string $bodyLocArgs): self
    {
        $this->bodyLocArgs = $bodyLocArgs;

        return $this;
    }

    public function setTitleLocKey(string $titleLocKey): self
    {
        $this->titleLocKey = $titleLocKey;

        return $this;
    }

    public function setTitleLocArgs(string $titleLocArgs): self
    {
        $this->titleLocArgs = $titleLocArgs;

        return $this;
    }

    public function setChannelId(string $channelId): self
    {
        $this->channelId = $channelId;

        return $this;
    }

    public function setTicker(string $ticker): self
    {
        $this->ticker = $ticker;

        return $this;
    }

    public function setSticky(bool $sticky): self
    {
        $this->sticky = $sticky;

        return $this;
    }

    public function setEventTime(string $eventTime): self
    {
        $this->eventTime = $eventTime;

        return $this;
    }

    public function setLocalOnly(bool $localOnly): self
    {
        $this->localOnly = $localOnly;

        return $this;
    }

    public function setNotificationPriority(string $notificationPriority): self
    {
        $this->notificationPriority = $notificationPriority;

        return $this;
    }

    public function setDefaultSound(bool $defaultSound): self
    {
        $this->defaultSound = $defaultSound;

        return $this;
    }

    public function setDefaultVibrateTimings(bool $defaultVibrateTimings): self
    {
        $this->defaultVibrateTimings = $defaultVibrateTimings;

        return $this;
    }

    public function setDefaultLightSettings(bool $defaultLightSettings): self
    {
        $this->defaultLightSettings = $defaultLightSettings;

        return $this;
    }

    public function setVibrateTimings(array $vibrateTimings): self
    {
        $this->vibrateTimings = $vibrateTimings;

        return $this;
    }

    public function setVisibility(string $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function setNotificationCount(int $notificationCount): self
    {
        $this->notificationCount = $notificationCount;

        return $this;
    }

    public function setLightSettings(LightSettings $lightSettings): self
    {
        $this->lightSettings = $lightSettings;

        return $this;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array += [
            'icon' => $this->icon,
            'color' => $this->color,
            'sound' => $this->sound,
            'tag' => $this->tag,
            'click_action' => $this->clickAction,
            'body_loc_key' => $this->bodyLocKey,
            'body_loc_args' => [
                $this->bodyLocArgs,
            ],
            'title_loc_key' => $this->titleLocKey,
            'title_loc_args' => [
                $this->titleLocArgs,
            ],
            'channel_id' => $this->channelId,
            'ticker' => $this->ticker,
            'sticky' => $this->sticky,
            'event_time' => $this->eventTime,
            'local_only' => $this->localOnly,
            'notification_priority' => $this->notificationPriority,
            'default_sound' => $this->defaultSound,
            'default_vibrate_timings' => $this->defaultVibrateTimings,
            'default_light_settings' => $this->defaultLightSettings,
            'vibrate_timings' => $this->vibrateTimings,
            'visibility' => $this->visibility,
            'notification_count' => $this->notificationCount,
            'light_settings' => $this->lightSettings,
            'image' => $this->image,
        ];

        return array_filter($array);
    }
}
