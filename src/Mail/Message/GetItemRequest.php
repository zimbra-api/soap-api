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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\ItemSpec;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * GetItemRequest class
 * Get item
 * A successful GetItemResponse will contain a single element appropriate for the type of the requested item if there
 * is no matching item, a fault containing the code mail.NO_SUCH_ITEM is returned
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetItemRequest extends Request
{
    /**
     * Item specification
     * @Accessor(getter="getItem", setter="setItem")
     * @SerializedName("item")
     * @Type("Zimbra\Mail\Struct\ItemSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ItemSpec $item;

    /**
     * Constructor method for GetItemRequest
     *
     * @param  ItemSpec $item
     * @return self
     */
    public function __construct(ItemSpec $item)
    {
        $this->setItem($item);
    }

    /**
     * Gets item
     *
     * @return ItemSpec
     */
    public function getItem(): ItemSpec
    {
        return $this->item;
    }

    /**
     * Sets item
     *
     * @param  ItemSpec $item
     * @return self
     */
    public function setItem(ItemSpec $item): self
    {
        $this->item = $item;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetItemEnvelope(
            new GetItemBody($this)
        );
    }
}
