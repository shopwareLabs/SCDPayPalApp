<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\Common\Link;
use Swag\PayPalApp\Api\Struct\V1\Common\LinkCollection;
use Swag\PayPalApp\Api\Struct\V1\Disputes\Item;
use Swag\PayPalApp\Api\Struct\V1\Disputes\ItemCollection;

#[OA\Schema(schema: 'swag_paypal_v1_disputes')]
class Disputes extends PayPalApiStruct
{
    #[OA\Property(type: 'array', items: new OA\Items(ref: Item::class), nullable: true)]
    protected ?ItemCollection $items = null;

    #[OA\Property(type: 'array', items: new OA\Items(ref: Link::class))]
    protected LinkCollection $links;

    public function getItems(): ?ItemCollection
    {
        return $this->items;
    }

    public function setItems(?ItemCollection $items): void
    {
        $this->items = $items;
    }

    public function getLinks(): LinkCollection
    {
        return $this->links;
    }

    public function setLinks(LinkCollection $links): void
    {
        $this->links = $links;
    }
}
