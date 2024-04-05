<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\V1\Disputes\Common\Transaction;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_disputed_transaction')]
class DisputedTransaction extends Transaction
{
    #[OA\Property(type: 'boolean')]
    protected bool $sellerProtectionEligible;

    public function isSellerProtectionEligible(): bool
    {
        return $this->sellerProtectionEligible;
    }

    public function setSellerProtectionEligible(bool $sellerProtectionEligible): void
    {
        $this->sellerProtectionEligible = $sellerProtectionEligible;
    }
}
