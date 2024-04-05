<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\Plan\BillingCycle;
use Swag\PayPalApp\Api\Struct\V1\Plan\BillingCycleCollection;
use Swag\PayPalApp\Api\Struct\V1\Plan\PaymentPreferences;
use Swag\PayPalApp\Api\Struct\V1\Plan\Taxes;

/**
 * @codeCoverageIgnore
 *
 * @experimental
 *
 * This class is experimental and not officially supported.
 * It is currently not used within the plugin itself. Use with caution.
 */
#[OA\Schema(schema: 'swag_paypal_v1_plan')]
class Plan extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $productId;

    #[OA\Property(type: 'string')]
    protected string $name;

    #[OA\Property(type: 'string', nullable: true)]
    protected ?string $description = null;

    #[OA\Property(type: 'string')]
    protected string $status;

    #[OA\Property(type: 'array', items: new OA\Items(ref: BillingCycle::class))]
    protected BillingCycleCollection $billingCycles;

    #[OA\Property(ref: PaymentPreferences::class)]
    protected PaymentPreferences $paymentPreferences;

    #[OA\Property(ref: Taxes::class)]
    protected Taxes $taxes;

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getBillingCycles(): BillingCycleCollection
    {
        return $this->billingCycles;
    }

    public function setBillingCycles(BillingCycleCollection $billingCycles): void
    {
        $this->billingCycles = $billingCycles;
    }

    public function getPaymentPreferences(): PaymentPreferences
    {
        return $this->paymentPreferences;
    }

    public function setPaymentPreferences(PaymentPreferences $paymentPreferences): void
    {
        $this->paymentPreferences = $paymentPreferences;
    }

    public function getTaxes(): Taxes
    {
        return $this->taxes;
    }

    public function setTaxes(Taxes $taxes): void
    {
        $this->taxes = $taxes;
    }
}
