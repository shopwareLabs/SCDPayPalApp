<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Subscription\BillingInfo;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\Common\Amount;

/**
 * @codeCoverageIgnore
 *
 * @experimental
 *
 * This class is experimental and not officially supported.
 * It is currently not used within the plugin itself. Use with caution.
 */
#[OA\Schema(schema: 'swag_paypal_v1_subscription_billing_info_last_payment')]
class LastPayment extends PayPalApiStruct
{
    #[OA\Property(ref: Amount::class)]
    protected Amount $amount;

    #[OA\Property(type: 'string')]
    protected string $time;

    public function getAmount(): Amount
    {
        return $this->amount;
    }

    public function setAmount(Amount $amount): void
    {
        $this->amount = $amount;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTime(string $time): void
    {
        $this->time = $time;
    }
}
