<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification;
use Kerox\Fcm\Model\Message\Options\AndroidFcmOptions;

class AndroidConfig implements \JsonSerializable
{
    use ValidatorTrait;

    public const PRIORITY_NORMAL = 'normal';
    public const PRIORITY_HIGH = 'high';

    private ?string $collapseKey = null;
    private string $priority = self::PRIORITY_NORMAL;
    private ?string $ttl = null;
    private ?string $restrictedPackageName = null;
    private array $data = [];
    private ?AndroidNotification $notification = null;
    private ?AndroidFcmOptions $fcmOptions = null;
    private ?bool $directBootOk = null;

    public function setCollapseKey(string $collapseKey): self
    {
        $this->collapseKey = $collapseKey;

        return $this;
    }

    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function setTtl(string $ttl): self
    {
        $this->isValidTtl($ttl);

        $this->ttl = $ttl;

        return $this;
    }

    public function setRestrictedPackageName(string $restrictedPackageName): self
    {
        $this->restrictedPackageName = $restrictedPackageName;

        return $this;
    }

    public function setData(array $data): self
    {
        $this->isValidData($data);

        $this->data = $data;

        return $this;
    }

    public function setNotification(AndroidNotification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    public function setFcmOptions(AndroidFcmOptions $fcmOptions): self
    {
        $this->fcmOptions = $fcmOptions;

        return $this;
    }

    public function setDirectBootOk(bool $directBootOk): self
    {
        $this->directBootOk = $directBootOk;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'collapse_key' => $this->collapseKey,
            'priority' => $this->priority,
            'ttl' => $this->ttl,
            'restricted_package_name' => $this->restrictedPackageName,
            'data' => $this->data,
            'notification' => $this->notification,
            'fcm_options' => $this->fcmOptions,
            'direct_boot_ok' => $this->directBootOk,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
