<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Converter;


use Shopware\App\SDK\Context\Cart\Cart;
use Shopware\App\SDK\Context\Payment\PaymentPayAction;
use Shopware\App\SDK\Context\SalesChannelContext\SalesChannelContext;
use Swag\PayPalApp\Api\Struct\V2\Common\Name;
use Swag\PayPalApp\Api\Struct\V2\Common\Address;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Paypal;
use Symfony\Component\HttpFoundation\ParameterBag;

class PayPalOrderBuilder extends AbstractOrderBuilder
{
    protected function buildPaymentSourceFromOrder(
        PaymentPayAction $paymentTransaction,
        ParameterBag $requestDataBag,
        PaymentSource $paymentSource
    ): void {
        $paypal = new Paypal();
        $paymentSource->setPaypal($paypal);

        $billingAddress = $paymentTransaction->order->getBillingAddress();
        if ($billingAddress === null) {
            throw new \Exception('Billing address is missing');
        }

        $address = new Address();
        $this->addressProvider->createAddress($billingAddress, $address);
        $paypal->setAddress($address);

        $experienceContext = $this->createExperienceContext($paymentTransaction->order->getSalesChannelId(), $paymentTransaction);
        $paypal->setExperienceContext($experienceContext);

        $customer = $paymentTransaction->order->getOrderCustomer();
        if ($customer === null) {
            throw new \Exception('Order customer is missing');
        }

        $paypal->setEmailAddress($customer->getEmail());
        $name = new Name();
        $name->setGivenName($customer->getFirstName());
        $name->setSurname($customer->getLastName());
        $paypal->setName($name);
    }

    protected function buildPaymentSourceFromCart(Cart $cart, SalesChannelContext $salesChannelContext, ParameterBag $requestDataBag, PaymentSource $paymentSource): void
    {
        $paypal = new Paypal();
        $paymentSource->setPaypal($paypal);

        $paypal->setExperienceContext($this->createExperienceContext($salesChannelContext->getSalesChannel()->getId()));

        $customer = $salesChannelContext->getCustomer();
        if ($customer === null) {
            return;
        }

        $paypal->setEmailAddress($customer->getEmail());
        $name = new Name();
        $name->setGivenName($customer->getFirstName());
        $name->setSurname($customer->getLastName());
        $paypal->setName($name);

        $billingAddress = $customer->getActiveBillingAddress();
        if ($billingAddress === null) {
            throw new \Exception('Billing address is missing');
        }
        $address = new Address();
        $this->addressProvider->createAddress($billingAddress, $address);
        $paypal->setAddress($address);
    }
}
