<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Converter\Util;


use Shopware\App\SDK\Context\Order\OrderTransaction;

class CustomIdProvider
{
    public function createCustomId(OrderTransaction $orderTransaction): string {
        return \json_encode([
            'oTId' => $orderTransaction->getId(),
        ], \JSON_THROW_ON_ERROR);
    }
}
