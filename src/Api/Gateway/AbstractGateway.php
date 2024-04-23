<?php

namespace Swag\PayPalApp\Api\Gateway;

use Swag\PayPalApp\Api\Client\ApiContext;
use Swag\PayPalApp\Api\Client\ClientFactory;
use Swag\PayPalApp\Api\Struct\PayPalApiCollection;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Symfony\Component\HttpClient\HttpOptions;

abstract class AbstractGateway
{
    public function __construct(
        protected readonly ClientFactory $clientFactory,
    ) {}

    protected function isThirdParty(): bool
    {
        return true;
    }

    /**
     * @template T of PayPalApiStruct|PayPalApiCollection
     *
     * @param class-string<T>|null $responseClass
     *
     * @return T|null
     */
    protected function request(string $method, string $uri, PayPalApiStruct|PayPalApiCollection|null $body, ?string $responseClass, ApiContext $context): PayPalApiStruct|PayPalApiCollection|null
    {
        $client = $this->isThirdParty() ? $this->clientFactory->createThirdPartyClient($context) : $this->clientFactory->createFirstPartyClient($context);
        $options = new HttpOptions();
        if ($body || ($method !== 'GET' && $method !== 'DELETE')) {
            $options->setJson($body);
            $options->setHeaders([
                ...$context->toHeaders(),
                'Content-Type' => 'application/json',
            ]);
        } else {
            $options->setHeaders($context->toHeaders());
        }

        $response = $client->request($method, $uri, $options->toArray());

        if ($response->getStatusCode() >= 400) {
            // throw exception
            $response->getContent();
        }

        if ($responseClass === null) {
            return null;
        }

        $responseStruct = new $responseClass();
        $responseStruct->assign($response->toArray());

        return $responseStruct;
    }
}