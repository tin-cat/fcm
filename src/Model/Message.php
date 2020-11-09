<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model;

use Kerox\Fcm\Helper\UtilityTrait;
use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\AndroidConfig;
use Kerox\Fcm\Model\Message\ApnsConfig;
use Kerox\Fcm\Model\Message\Notification;
use Kerox\Fcm\Model\Message\FcmOptions;
use Kerox\Fcm\Model\Message\WebpushConfig;

class Message implements \JsonSerializable
{
    use UtilityTrait;
    use ValidatorTrait;

    private ?string $name = null;
    private array $data = [];
    private ?Notification $notification = null;
    private ?AndroidConfig $android = null;
    private ?WebpushConfig $webpush = null;
    private ?ApnsConfig $apns = null;
    private ?FcmOptions $fcmOptions = null;
    private ?string $token = null;
    private ?string $topic = null;
    private ?string $condition = null;

    /**
     * @param \Kerox\Fcm\Model\Message\Notification|string $message
     *
     * @throws \Exception
     */
    public function __construct($message)
    {
        if (\is_string($message)) {
            $message = new Notification($message);
        }

        if (!$message instanceof Notification) {
            throw new \InvalidArgumentException(sprintf('$message must be a string or an instance of "%s".', Notification::class));
        }

        $this->notification = $message;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setData(array $data): self
    {
        $this->isValidData($data);

        $this->data = $data;

        return $this;
    }

    public function setAndroid(AndroidConfig $android): self
    {
        $this->android = $android;

        return $this;
    }

    public function setWebpush(WebpushConfig $webpush): self
    {
        $this->webpush = $webpush;

        return $this;
    }

    public function setApns(ApnsConfig $apns): self
    {
        $this->apns = $apns;

        return $this;
    }

    public function setFcmOptions(FcmOptions $fcmOptions): self
    {
        $this->fcmOptions = $fcmOptions;

        return $this;
    }

    public function setToken(string $token): self
    {
        $this->topic = $this->condition = null;
        $this->token = $token;

        return $this;
    }

    public function setTopic(string $topic): self
    {
        $this->isValidTopicName($topic);

        $this->token = $this->condition = null;
        $this->topic = $topic;

        return $this;
    }

    public function setCondition(string $condition): self
    {
        $this->token = $this->topic = null;
        $this->condition = $condition;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'name' => $this->name,
            'data' => $this->data,
            'notification' => $this->notification,
            'android' => $this->android,
            'webpush' => $this->webpush,
            'apns' => $this->apns,
            'fcm_options' => $this->fcmOptions,
            'token' => $this->token,
            'topic' => $this->topic,
            'condition' => $this->condition,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
