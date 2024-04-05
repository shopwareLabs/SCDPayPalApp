<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Common\Attributes;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v2_order_payment_source_common_attributes_verification')]
class Verification extends PayPalApiStruct
{
    public const METHOD_SCA_WHEN_REQUIRED = 'SCA_WHEN_REQUIRED';
    public const METHOD_SCA_ALWAYS = 'SCA_ALWAYS';

    #[OA\Property(type: 'string')]
    protected string $method = self::METHOD_SCA_ALWAYS;

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }
}
