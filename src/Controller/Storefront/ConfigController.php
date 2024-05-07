<?php

declare(strict_types=1);

namespace Swag\PayPalApp\Controller\Storefront;

use Http\Discovery\Psr17Factory;
use PHPUnit\Util\Json;
use Psr\Http\Message\ResponseInterface;
use Shopware\App\SDK\Context\Cart\Cart;
use Shopware\App\SDK\Context\SalesChannelContext\SalesChannelContext;
use Shopware\App\SDK\Context\Storefront\StorefrontAction;
use Swag\PayPalApp\Api\Client\ApiContext;
use Swag\PayPalApp\Api\Client\AuthenticationBuilder;
use Swag\PayPalApp\Api\Converter\PayPalOrderBuilder;
use Swag\PayPalApp\Api\Gateway\OrderGateway;
use Swag\PayPalApp\Repository\CredentialsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/storefront/config')]
class ConfigController
{
    public function __construct(
        private readonly CredentialsRepository $credentialsRepository,
    ) {
    }

    #[Route('/', name: 'storefront.config', methods: ['GET'])]
    public function pay(StorefrontAction $action, Request $request): Response
    {
        $apiContext = new ApiContext(
            $action->claims->getSalesChannelId(),
            $action->shop,
        );
        $credentials = $this->credentialsRepository->getShopConfig($apiContext);

        return new JsonResponse([
            'clientId' => $credentials->getClientId(),
            'merchantPayerId' => $credentials->getMerchantId(),
        ]);
    }
}
