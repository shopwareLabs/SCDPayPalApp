<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Common;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v2_common_link')]
class Link extends PayPalApiStruct
{
    public const RELATION_APPROVE = 'approve';
    public const RELATION_PAYER_ACTION = 'payer-action';
    public const RELATION_UP = 'up';

    #[OA\Property(type: 'string')]
    protected string $href;

    #[OA\Property(type: 'string')]
    protected string $rel;

    #[OA\Property(type: 'string')]
    protected string $method;

    #[OA\Property(type: 'string', nullable: true)]
    protected ?string $encType = null;

    public function getHref(): string
    {
        return $this->href;
    }

    public function setHref(string $href): void
    {
        $this->href = $href;
    }

    public function getRel(): string
    {
        return $this->rel;
    }

    public function setRel(string $rel): void
    {
        $this->rel = $rel;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getEncType(): ?string
    {
        return $this->encType;
    }

    public function setEncType(?string $encType): void
    {
        $this->encType = $encType;
    }
}
