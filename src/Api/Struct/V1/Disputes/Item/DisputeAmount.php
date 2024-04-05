<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\V1\Common\Money;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_dispute_amount')]
class DisputeAmount extends Money
{
}
