<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order;

use Swag\PayPalApp\Api\Struct\PayPalApiCollection;

/**
 * @extends PayPalApiCollection<PurchaseUnit>
 */
class PurchaseUnitCollection extends PayPalApiCollection
{
    public static function getExpectedClass(): string
    {
        return PurchaseUnit::class;
    }
}
