<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification\ApnsNotification;

use Kerox\Fcm\Model\Message\AbstractNotification;

class Alert extends AbstractNotification
{
    private ?string $subTitle;
    private ?string $launchImage;
    private ?string $titleLocKey;
    private array $titleLocArgs = [];
    private ?string $subTitleLocKey;
    private array $subTitleLocArgs = [];
    private ?string $locKey;
    private array $locArgs = [];

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setSubTitle(string $subTitle): self
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    public function setTitleLocKey(string $titleLocKey): self
    {
        $this->titleLocKey = $titleLocKey;

        return $this;
    }

    public function setTitleLocArgs(array $titleLocArgs): self
    {
        $this->titleLocArgs = $titleLocArgs;

        return $this;
    }

    public function setSubTitleLocKey(string $subTitleLocKey): self
    {
        $this->subTitleLocKey = $subTitleLocKey;

        return $this;
    }

    public function setSubTitleLocArgs(array $subTitleLocArgs): self
    {
        $this->subTitleLocArgs = $subTitleLocArgs;

        return $this;
    }

    public function setLocKey(string $locKey): self
    {
        $this->locKey = $locKey;

        return $this;
    }

    public function setLocArgs(array $locArgs): self
    {
        $this->locArgs = $locArgs;

        return $this;
    }

    public function setLaunchImage(string $launchImage): self
    {
        $this->launchImage = $launchImage;

        return $this;
    }

    public function toArray(): array
    {
        $json = parent::toArray();
        $json += [
            'subtitle' => $this->subTitle,
            'launch-image' => $this->launchImage,
            'title-loc-key' => $this->titleLocKey,
            'title-loc-args' => $this->titleLocArgs,
            'subtitle-loc-key' => $this->subTitleLocKey,
            'subtitle-loc-args' => $this->subTitleLocArgs,
            'loc-key' => $this->locKey,
            'loc-args' => $this->locArgs,
        ];

        return array_filter($json);
    }
}
