<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Common;

use Swag\PayPalApp\Api\Struct\PayPalApiCollection;

/**
 * @extends PayPalApiCollection<Link>
 */
class LinkCollection extends PayPalApiCollection
{
    public static function getExpectedClass(): string
    {
        return Link::class;
    }

    public function getRelation(string $rel): ?Link
    {
        foreach ($this->elements as $link) {
            if ($link->getRel() === $rel) {
                return $link;
            }
        }

        return null;
    }
}
