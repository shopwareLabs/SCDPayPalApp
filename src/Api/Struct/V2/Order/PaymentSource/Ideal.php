<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource;

use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'swag_paypal_v2_order_payment_source_ideal')]
class Ideal extends AbstractAPMPaymentSource
{
}
