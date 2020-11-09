<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Options;

use Kerox\Fcm\Model\Message\FcmOptions;

class ApnsFcmOptions extends FcmOptions
{
    private ?string $image = null;

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array += [
            'image' => $this->image,
        ];

        return array_filter($array);
    }
}
