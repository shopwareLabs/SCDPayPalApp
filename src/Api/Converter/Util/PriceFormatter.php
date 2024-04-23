<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Converter\Util;

use Shopware\App\SDK\Context\Cart\CalculatedTax;

class PriceFormatter
{
    private const DEFAULT_DECIMALS = 2;

    private const OTHER_DECIMALS = [
        'HUF' => 0,
        'JPY' => 0,
        'TWD' => 0,
    ];

    public function formatPrice(float $price, ?string $countryCode = null): string
    {
        $decimals = self::OTHER_DECIMALS[$countryCode] ?? self::DEFAULT_DECIMALS;

        return \number_format($this->roundPrice($price, $countryCode), $decimals, '.', '');
    }

    public function roundPrice(float $price, ?string $countryCode = null): float
    {
        $decimals = self::OTHER_DECIMALS[$countryCode] ?? self::DEFAULT_DECIMALS;

        return \round($price, $decimals);
    }

    /**
     * @param array<CalculatedTax> $taxCollection
     */
    public function getTaxAmount(array $taxCollection): float
    {
        $taxAmount = 0.0;
        foreach ($taxCollection as $tax) {
            $taxAmount += $tax->getTax();
        }

        return $taxAmount;
    }
}
