<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\MerchantIntegrations;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\MerchantIntegrations\OauthIntegration\OauthThirdParty;
use Swag\PayPalApp\Api\Struct\V1\MerchantIntegrations\OauthIntegration\OauthThirdPartyCollection;

#[OA\Schema(schema: 'swag_paypal_v1_merchant_integrations_oauth_integration')]
class OauthIntegration extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $integrationMethod;

    #[OA\Property(type: 'string')]
    protected string $integrationType;

    #[OA\Property(type: 'string')]
    protected string $status;

    #[OA\Property(type: 'array', items: new OA\Items(ref: OauthThirdParty::class))]
    protected OauthThirdPartyCollection $oauthThirdParty;

    public function getIntegrationMethod(): string
    {
        return $this->integrationMethod;
    }

    public function setIntegrationMethod(string $integrationMethod): void
    {
        $this->integrationMethod = $integrationMethod;
    }

    public function getIntegrationType(): string
    {
        return $this->integrationType;
    }

    public function setIntegrationType(string $integrationType): void
    {
        $this->integrationType = $integrationType;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getOauthThirdParty(): OauthThirdPartyCollection
    {
        return $this->oauthThirdParty;
    }

    public function setOauthThirdParty(OauthThirdPartyCollection $oauthThirdParty): void
    {
        $this->oauthThirdParty = $oauthThirdParty;
    }
}
