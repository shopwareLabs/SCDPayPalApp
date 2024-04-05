<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Plan\BillingCycle;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\Common\Money;

/**
 * @codeCoverageIgnore
 *
 * @experimental
 *
 * This class is experimental and not officially supported.
 * It is currently not used within the plugin itself. Use with caution.
 */
#[OA\Schema(schema: 'swag_paypal_v1_plan_billing_cycle_pricing_scheme')]
class PricingScheme extends PayPalApiStruct
{
    #[OA\Property(ref: Money::class)]
    protected Money $fixedPrice;

    public function getFixedPrice(): Money
    {
        return $this->fixedPrice;
    }

    public function setFixedPrice(Money $fixed_price): void
    {
        $this->fixedPrice = $fixed_price;
    }
}
