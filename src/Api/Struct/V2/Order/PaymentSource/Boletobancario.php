<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\V2\Common\Address;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Boletobancario\TaxInfo;

#[OA\Schema(schema: 'swag_paypal_v2_order_payment_source_boletobancario')]
class Boletobancario extends AbstractAPMPaymentSource
{
    #[OA\Property(type: 'string')]
    protected string $email;

    #[OA\Property(type: 'string')]
    protected string $expiryDate;

    #[OA\Property(ref: TaxInfo::class)]
    protected TaxInfo $taxInfo;

    #[OA\Property(ref: Address::class)]
    protected Address $billingAddress;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getExpiryDate(): string
    {
        return $this->expiryDate;
    }

    public function setExpiryDate(string $expiryDate): void
    {
        $this->expiryDate = $expiryDate;
    }

    public function getTaxInfo(): TaxInfo
    {
        return $this->taxInfo;
    }

    public function setTaxInfo(TaxInfo $taxInfo): void
    {
        $this->taxInfo = $taxInfo;
    }

    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(Address $billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }
}
