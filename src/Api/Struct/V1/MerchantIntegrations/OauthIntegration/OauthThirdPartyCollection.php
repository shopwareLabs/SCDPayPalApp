<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\MerchantIntegrations\OauthIntegration;

use Swag\PayPalApp\Api\Struct\PayPalApiCollection;

/**
 * @extends PayPalApiCollection<OauthThirdParty>
 */
class OauthThirdPartyCollection extends PayPalApiCollection
{
    public static function getExpectedClass(): string
    {
        return OauthThirdParty::class;
    }
}
