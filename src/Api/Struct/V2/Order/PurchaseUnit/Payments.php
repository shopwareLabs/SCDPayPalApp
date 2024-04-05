<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Payments\Authorization;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Payments\AuthorizationCollection;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Payments\Capture;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Payments\CaptureCollection;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Payments\Refund;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Payments\RefundCollection;

#[OA\Schema(schema: 'swag_paypal_v2_order_purchase_unit_payments')]
class Payments extends PayPalApiStruct
{
    #[OA\Property(type: 'array', items: new OA\Items(ref: Authorization::class), nullable: true)]
    protected ?AuthorizationCollection $authorizations = null;

    #[OA\Property(type: 'array', items: new OA\Items(ref: Capture::class), nullable: true)]
    protected ?CaptureCollection $captures = null;

    #[OA\Property(type: 'array', items: new OA\Items(ref: Refund::class), nullable: true)]
    protected ?RefundCollection $refunds = null;

    public function getAuthorizations(): ?AuthorizationCollection
    {
        return $this->authorizations;
    }

    public function setAuthorizations(?AuthorizationCollection $authorizations): void
    {
        $this->authorizations = $authorizations;
    }

    public function getCaptures(): ?CaptureCollection
    {
        return $this->captures;
    }

    public function setCaptures(?CaptureCollection $captures): void
    {
        $this->captures = $captures;
    }

    public function getRefunds(): ?RefundCollection
    {
        return $this->refunds;
    }

    public function setRefunds(?RefundCollection $refunds): void
    {
        $this->refunds = $refunds;
    }
}
