<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Common;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_common_seller')]
class Seller extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $email;

    #[OA\Property(type: 'string')]
    protected string $merchantId;

    #[OA\Property(type: 'string')]
    protected string $name;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
