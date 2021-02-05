<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\XMPPComponentSelector;
use Zimbra\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Soap\Request;

/**
 * GetXMPPComponentRequest class
 * Get XMPP Component
 * XMPP stands for Extensible Messaging and Presence Protocol
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetXMPPComponentRequest")
 */
class GetXMPPComponentRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * XMPP Component selector
     * @Accessor(getter="getComponent", setter="setComponent")
     * @SerializedName("xmppcomponent")
     * @Type("Zimbra\Admin\Struct\XMPPComponentSelector")
     * @XmlElement
     */
    private $component;

    /**
     * Constructor method for GetXMPPComponentRequest
     * 
     * @param  XMPPComponentSelector $component
     * @param  string $attrs
     * @return self
     */
    public function __construct(XMPPComponentSelector $component, ?string $attrs = NULL)
    {
        $this->setComponent($component);
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets the component.
     *
     * @return XMPPComponentSelector
     */
    public function getComponent(): XMPPComponentSelector
    {
        return $this->component;
    }

    /**
     * Sets the component.
     *
     * @param  XMPPComponentSelector $component
     * @return self
     */
    public function setComponent(XMPPComponentSelector $component): self
    {
        $this->component = $component;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetXMPPComponentEnvelope)) {
            $this->envelope = new GetXMPPComponentEnvelope(
                new GetXMPPComponentBody($this)
            );
        }
    }
}