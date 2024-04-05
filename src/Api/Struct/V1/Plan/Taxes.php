<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Plan;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

/**
 * @codeCoverageIgnore
 *
 * @experimental
 *
 * This class is experimental and not officially supported.
 * It is currently not used within the plugin itself. Use with caution.
 */
#[OA\Schema(schema: 'swag_paypal_v1_plan_taxes')]
class Taxes extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $percentage;

    #[OA\Property(type: 'boolean')]
    protected bool $inclusive;

    public function getPercentage(): string
    {
        return $this->percentage;
    }

    public function setPercentage(string $percentage): void
    {
        $this->percentage = $percentage;
    }

    public function isInclusive(): bool
    {
        return $this->inclusive;
    }

    public function setInclusive(bool $inclusive): void
    {
        $this->inclusive = $inclusive;
    }
}
