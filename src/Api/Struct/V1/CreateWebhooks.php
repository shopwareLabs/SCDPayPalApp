<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\CreateWebhooks\EventType;
use Swag\PayPalApp\Api\Struct\V1\CreateWebhooks\EventTypeCollection;

#[OA\Schema(schema: 'swag_paypal_v1_create_webhooks')]
class CreateWebhooks extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $url;

    #[OA\Property(type: 'array', items: new OA\Items(ref: EventType::class))]
    protected EventTypeCollection $eventTypes;

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getEventTypes(): EventTypeCollection
    {
        return $this->eventTypes;
    }

    public function setEventTypes(EventTypeCollection $eventTypes): void
    {
        $this->eventTypes = $eventTypes;
    }
}
