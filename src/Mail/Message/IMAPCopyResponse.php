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
use Zimbra\Common\Struct\SoapResponse;

/**
 * IMAPCopyResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IMAPCopyResponse extends SoapResponse
{
    /**
     * new items
     *
     * @Accessor(getter="getItems", setter="setItems")
     * @Type("array<Zimbra\Mail\Struct\IMAPItemInfo>")
     * @XmlList(inline=true, entry="item", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getItems", setter: "setItems")]
    #[Type("array<Zimbra\Mail\Struct\IMAPItemInfo>")]
    #[XmlList(inline: true, entry: "item", namespace: "urn:zimbraMail")]
    private $items = [];

    /**
     * Constructor
     *
     * @param  array $items
     * @return self
     */
    public function __construct(array $items = [])
    {
        $this->setItems($items);
    }

    /**
     * Set items
     *
     * @param  array $items
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->items = array_filter(
            $items,
            static fn($item) => $item instanceof IMAPItemInfo
        );
        return $this;
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
