<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\IMAPItemInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * IMAPCopyResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class IMAPCopyResponse implements ResponseInterface
{
    /**
     * new items
     * 
     * @Accessor(getter="getItems", setter="setItems")
     * @Type("array<Zimbra\Mail\Struct\IMAPItemInfo>")
     * @XmlList(inline=true, entry="item", namespace="urn:zimbraMail")
     */
    private $items = [];

    /**
     * Constructor method for IMAPCopyResponse
     *
     * @param  array $items
     * @return self
     */
    public function __construct(array $items = [])
    {
        $this->setItems($items);
    }

    /**
     * Add item
     *
     * @param  IMAPItemInfo $item
     * @return self
     */
    public function addItem(IMAPItemInfo $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Sets items
     *
     * @param  array $items
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->items = array_filter($items, static fn ($item) => $item instanceof IMAPItemInfo);
        return $this;
    }

    /**
     * Gets items
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}