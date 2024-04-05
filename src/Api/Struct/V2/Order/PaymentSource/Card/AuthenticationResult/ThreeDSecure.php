<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Card\AuthenticationResult;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v2_order_payment_source_card_authentication_result_3d_secure')]
class ThreeDSecure extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $enrollmentStatus;

    #[OA\Property(type: 'string')]
    protected ?string $authenticationStatus = null;

    public function getEnrollmentStatus(): string
    {
        return $this->enrollmentStatus;
    }

    public function setEnrollmentStatus(string $enrollmentStatus): void
    {
        $this->enrollmentStatus = $enrollmentStatus;
    }

    public function getAuthenticationStatus(): ?string
    {
        return $this->authenticationStatus;
    }

    public function setAuthenticationStatus(?string $authenticationStatus): void
    {
        $this->authenticationStatus = $authenticationStatus;
    }
}
