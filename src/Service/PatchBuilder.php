<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Service;

use Shopware\App\SDK\Context\Cart\CartPrice;
use Shopware\App\SDK\Context\Order\Order;
use Shopware\App\SDK\Context\Order\OrderTransaction;
use Swag\PayPalApp\Api\Converter\Util\ItemListProvider;
use Swag\PayPalApp\Api\Converter\Util\PurchaseUnitProvider;
use Swag\PayPalApp\Api\Struct\V2\Patch;

class PatchBuilder
{
    /**
     * @internal
     */
    public function __construct(
        private readonly PurchaseUnitProvider $purchaseUnitProvider,
        private readonly ItemListProvider $itemListProvider,
    ) {
    }

    public function createPurchaseUnitPatch(
        Order $order,
        OrderTransaction $orderTransaction,
    ): Patch {
        $purchaseUnit = $this->purchaseUnitProvider->createPurchaseUnit(
            $orderTransaction->getAmount(),
            $order->getShippingCosts(),
            null,
            $this->itemListProvider->getItemList($order->getCurrency(), $order),
            $order->getCurrency(),
            $order->getTaxStatus() !== CartPrice::TAX_STATE_GROSS, /* @phpstan-ignore-line */
            $order,
            $orderTransaction
        );
        $purchaseUnitArray = \json_decode((string) \json_encode($purchaseUnit), true);

        $purchaseUnitPatch = new Patch();
        $purchaseUnitPatch->assign([
            'op' => Patch::OPERATION_REPLACE,
            'path' => '/purchase_units/@reference_id==\'default\'',
        ]);
        $purchaseUnitPatch->setValue($purchaseUnitArray);

        return $purchaseUnitPatch;
    }
}
