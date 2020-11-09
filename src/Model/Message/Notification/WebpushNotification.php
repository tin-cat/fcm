<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\AbstractNotification;

class WebpushNotification extends AbstractNotification
{
    use ValidatorTrait;

    public const PERMISSION_DENIED = 'denied';
    public const PERMISSION_GRANTED = 'granted';
    public const PERMISSION_DEFAULT = 'default';

    public const DIR_AUTO = 'auto';
    public const DIR_LTR = 'ltr';
    public const DIR_RTL = 'rtl';

    private string $permission = self::PERMISSION_DEFAULT;
    private array $actions = [];
    private ?string $badge = null;

    /**
     * @var mixed
     */
    private $data;

    private string $dir = self::DIR_AUTO;
    private ?string $lang = null;
    private ?string $tag = null;
    private ?string $icon = null;
    private ?string $image = null;
    private bool $renotify = false;
    private bool $requireInteraction = false;
    private bool $silent = false;
    private ?int $timestamp = null;
    private array $vibrate = [];
    private bool $sticky = false;

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

    public function setPermission(string $permission): self
    {
        $this->permission = $permission;

        return $this;
    }

    public function setActions(array $actions): self
    {
        $this->actions = $actions;

        return $this;
    }

    public function setBadge(string $badge): self
    {
        $this->isValidUrl($badge);

        $this->badge = $badge;

        return $this;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setDir(string $dir): self
    {
        $this->dir = $dir;

        return $this;
    }

    public function setLang(string $lang): self
    {
        $this->isValidLang($lang);

        $this->lang = $lang;

        return $this;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function setIcon(string $icon): self
    {
        $this->isValidUrl($icon);

        $this->icon = $icon;

        return $this;
    }

    public function setImage(string $image): self
    {
        $this->isValidUrl($image);

        $this->image = $image;

        return $this;
    }

    public function setRenotify(bool $renotify): self
    {
        $this->renotify = $renotify;

        return $this;
    }

    public function setRequireInteraction(bool $requireInteraction): self
    {
        $this->requireInteraction = $requireInteraction;

        return $this;
    }

    public function setSilent(bool $silent): self
    {
        $this->silent = $silent;

        return $this;
    }

    public function setTimestamp(\DateTime $dateTime): self
    {
        $this->timestamp = $dateTime->getTimestamp();

        return $this;
    }

    public function setVibrate(array $vibratePattern): self
    {
        $this->isValidVibratePattern($vibratePattern);

        $this->vibrate = $vibratePattern;

        return $this;
    }

    public function setSticky(bool $sticky): self
    {
        $this->sticky = $sticky;

        return $this;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array += [
            'permission' => $this->permission,
            'actions' => $this->actions,
            'badge' => $this->badge,
            'data' => $this->data,
            'dir' => $this->dir,
            'lang' => $this->lang,
            'tag' => $this->tag,
            'icon' => $this->icon,
            'image' => $this->image,
            'renotify' => $this->renotify,
            'requireInteraction' => $this->requireInteraction,
            'silent' => $this->silent,
            'timestamp' => $this->timestamp,
            'vibrate' => $this->vibrate,
            'sticky' => $this->sticky,
        ];

        return array_filter($array);
    }
}
