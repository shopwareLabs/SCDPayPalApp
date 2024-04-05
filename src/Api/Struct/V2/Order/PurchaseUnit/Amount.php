<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\V2\Common\Money;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Amount\Breakdown;

#[OA\Schema(schema: 'swag_paypal_v2_order_purchase_unit_amount')]
class Amount extends Money
{
    #[OA\Property(ref: Breakdown::class, nullable: true)]
    protected ?Breakdown $breakdown = null;

    public function getBreakdown(): ?Breakdown
    {
        return $this->breakdown;
    }

    public function setBreakdown(?Breakdown $breakdown): void
    {
        $this->breakdown = $breakdown;
    }
}
