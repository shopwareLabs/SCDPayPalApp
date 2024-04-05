<?php

namespace Swag\PayPalApp\Api\Gateway;

use Shopware\App\SDK\Shop\ShopInterface;
use Swag\PayPalApp\Api\Client\ApiContext;
use Swag\PayPalApp\Api\Client\AuthenticationBuilder;
use Swag\PayPalApp\Api\Client\ClientFactory;
use Swag\PayPalApp\Api\Client\CredentialsIdentifier;
use Swag\PayPalApp\Api\Constants;
use Swag\PayPalApp\Api\Struct\PayPalApiCollection;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V2\Order;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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
        $options->setHeaders($context->toHeaders());
        if ($body) {
            $options->setJson($body);
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

        return new $responseClass();
    }
}