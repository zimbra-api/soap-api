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
use Zimbra\Admin\Struct\XMPPComponentSpec;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * CreateXMPPComponentRequest class
 * Create an XMPP component
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateXMPPComponentRequest extends Request
{
    /**
     * XMPP Component details
     * @Accessor(getter="getComponent", setter="setComponent")
     * @SerializedName("xmppcomponent")
     * @Type("Zimbra\Admin\Struct\XMPPComponentSpec")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private XMPPComponentSpec $component;

    /**
     * Constructor method for CreateXMPPComponentRequest
     * 
     * @param XMPPComponentSpec $component
     * @return self
     */
    public function __construct(XMPPComponentSpec $component)
    {
        $this->setComponent($component);
    }

    /**
     * Gets component
     *
     * @return XMPPComponentSpec
     */
    public function getComponent(): XMPPComponentSpec
    {
        return $this->component;
    }

    /**
     * Sets component
     *
     * @param  XMPPComponentSpec $name
     * @return self
     */
    public function setComponent(XMPPComponentSpec $component): self
    {
        $this->component = $component;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new CreateXMPPComponentEnvelope(
            new CreateXMPPComponentBody($this)
        );
    }
}
