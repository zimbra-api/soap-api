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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetItemRequest extends SoapRequest
{
    /**
     * Item specification
     * 
     * @var ItemSpec
     */
    #[Accessor(getter: "getItem", setter: "setItem")]
    #[SerializedName(name: 'item')]
    #[Type(name: ItemSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $item;

    /**
     * Constructor
     *
     * @param  ItemSpec $item
     * @return self
     */
    public function __construct(ItemSpec $item)
    {
        $this->setItem($item);
    }

    /**
     * Get item
     *
     * @return ItemSpec
     */
    public function getItem(): ItemSpec
    {
        return $this->item;
    }

    /**
     * Set item
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetItemEnvelope(
            new GetItemBody($this)
        );
    }
}
