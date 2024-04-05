<?php

namespace Swag\PayPalApp\Api\Client;

use Swag\PayPalApp\Api\Struct\V1\Token;

class AuthenticationBuilder
{
    private const ALG_NONE_HEADER = 'eyJhbGciOiJub25lIn0=';

    private ?Token $liveToken = null;
    private ?Token $sandboxToken = null;

    public function __construct(
        private string $clientId,
        private string $clientIdSandbox,
        private readonly AuthenticationClientFactory $authenticationClientFactory,
    ) {
    }

    public function getAccessToken(bool $sandbox): string
    {
        if ($sandbox && ($this->sandboxToken === null || !$this->sandboxToken->isValid())) {
            $this->sandboxToken = $this->fetchToken($sandbox);
        }
        if (!$sandbox && ($this->liveToken === null || !$this->liveToken->isValid())) {
            $this->liveToken = $this->fetchToken($sandbox);
        }

        return $sandbox ? $this->sandboxToken->getAccessToken() : $this->liveToken->getAccessToken();
    }

    public function getAuthAssertion(bool $sandbox, string $merchantId): string
    {
        $clientId = $sandbox ? $this->clientIdSandbox : $this->clientId;

        $payload = [
            'iss' => $clientId,
            'payer_id' => $merchantId,
        ];

        return \sprintf('%s.%s.', self::ALG_NONE_HEADER, \base64_encode(\json_encode($payload, \JSON_THROW_ON_ERROR)));
    }

    private function fetchToken(bool $sandbox): Token
    {
        $client = $this->authenticationClientFactory->createAuthenticationClient($sandbox);
        $response = $client->request('POST', 'v1/oauth2/token', [
            'body' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        $data = $response->toArray();

        return (new Token())->assign($data);
    }
}