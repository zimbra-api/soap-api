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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateXMPPComponentRequest class
 * Create an XMPP component
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateXMPPComponentRequest extends SoapRequest
{
    /**
     * XMPP Component details
     * 
     * @Accessor(getter="getComponent", setter="setComponent")
     * @SerializedName("xmppcomponent")
     * @Type("Zimbra\Admin\Struct\XMPPComponentSpec")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var XMPPComponentSpec
     */
    private $component;

    /**
     * Constructor
     * 
     * @param XMPPComponentSpec $component
     * @return self
     */
    public function __construct(XMPPComponentSpec $component)
    {
        $this->setComponent($component);
    }

    /**
     * Get component
     *
     * @return XMPPComponentSpec
     */
    public function getComponent(): XMPPComponentSpec
    {
        return $this->component;
    }

    /**
     * Set component
     *
     * @param  XMPPComponentSpec $component
     * @return self
     */
    public function setComponent(XMPPComponentSpec $component): self
    {
        $this->component = $component;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateXMPPComponentEnvelope(
            new CreateXMPPComponentBody($this)
        );
    }
}
