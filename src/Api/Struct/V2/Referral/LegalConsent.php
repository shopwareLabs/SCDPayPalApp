<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Referral;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v2_referral_legal_consent')]
class LegalConsent extends PayPalApiStruct
{
    public const CONSENT_TYPE_SHARE_DATA = 'SHARE_DATA_CONSENT';

    #[OA\Property(type: 'string', default: self::CONSENT_TYPE_SHARE_DATA)]
    protected string $type = self::CONSENT_TYPE_SHARE_DATA;

    #[OA\Property(type: 'boolean')]
    protected bool $granted = true;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function isGranted(): bool
    {
        return $this->granted;
    }

    public function setGranted(bool $granted): void
    {
        $this->granted = $granted;
    }
}
