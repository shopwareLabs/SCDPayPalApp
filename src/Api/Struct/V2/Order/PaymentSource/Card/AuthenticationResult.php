<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Card;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Card\AuthenticationResult\ThreeDSecure;

#[OA\Schema(schema: 'swag_paypal_v2_order_payment_source_card_authentication_result')]
class AuthenticationResult extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $liabilityShift;

    #[OA\Property(ref: ThreeDSecure::class, nullable: true)]
    protected ?ThreeDSecure $threeDSecure = null;

    public function getLiabilityShift(): string
    {
        return $this->liabilityShift;
    }

    public function setLiabilityShift(string $liabilityShift): void
    {
        $this->liabilityShift = $liabilityShift;
    }

    public function getThreeDSecure(): ?ThreeDSecure
    {
        return $this->threeDSecure;
    }

    public function setThreeDSecure(?ThreeDSecure $threeDSecure): void
    {
        $this->threeDSecure = $threeDSecure;
    }
}
