<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Common;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_common_sub_reason')]
class SubReason extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $subReason;

    public function getSubReason(): string
    {
        return $this->subReason;
    }

    public function setSubReason(string $subReason): void
    {
        $this->subReason = $subReason;
    }
}
