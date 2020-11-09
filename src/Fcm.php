<?php

declare(strict_types=1);

namespace Kerox\Fcm;

use Kerox\Fcm\Api\Send;
use Psr\Http\Client\ClientInterface;

class Fcm
{
    public const API_URL = 'https://fcm.googleapis.com';
    public const API_VERSION = 'v1';

    private string $apiKey;
    private string $oauthToken;
    private string $projectId;
    private ClientInterface $client;

    public function __construct(string $apiKey, string $oauthToken, string $projectId, ClientInterface $client)
    {
        $this->apiKey = $apiKey;
        $this->oauthToken = $oauthToken;
        $this->projectId = $projectId;
        $this->client = $client;
    }

    public function send(): Send
    {
        return new Send($this->apiKey, $this->oauthToken, $this->projectId, $this->client);
    }
}
