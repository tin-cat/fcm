<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Options;

use Kerox\Fcm\Model\Message\FcmOptions;

class WebpushFcmOptions extends FcmOptions
{
    private ?string $link = null;

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array += [
            'link' => $this->link,
        ];

        return array_filter($array);
    }
}
