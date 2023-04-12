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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\XMPPComponentSelector;
use Zimbra\Common\Struct\{AttributeSelector, AttributeSelectorTrait, SoapEnvelopeInterface, SoapRequest};

/**
 * GetXMPPComponentRequest class
 * Get XMPP Component
 * XMPP stands for Extensible Messaging and Presence Protocol
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetXMPPComponentRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * XMPP component selector
     * 
     * @var XMPPComponentSelector
     */
    #[Accessor(getter: 'getComponent', setter: 'setComponent')]
    #[SerializedName('xmppcomponent')]
    #[Type(XMPPComponentSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private XMPPComponentSelector $component;

    /**
     * Constructor
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
     * Get the component.
     *
     * @return XMPPComponentSelector
     */
    public function getComponent(): XMPPComponentSelector
    {
        return $this->component;
    }

    /**
     * Set the component.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetXMPPComponentEnvelope(
            new GetXMPPComponentBody($this)
        );
    }
}
