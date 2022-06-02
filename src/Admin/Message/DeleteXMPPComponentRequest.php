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
use Zimbra\Admin\Struct\XMPPComponentSelector as Component;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * DeleteXMPPComponentRequest class
 * Delete an XMPP Component
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteXMPPComponentRequest extends Request
{
    /**
     * XMPP Component details
     * @Accessor(getter="getComponent", setter="setComponent")
     * @SerializedName("xmppcomponent")
     * @Type("Zimbra\Admin\Struct\XMPPComponentSelector")
     * @XmlElement
     */
    private ?Component $component = NULL;

    /**
     * Constructor method for DeleteXMPPComponentRequest
     * 
     * @param  Component $component
     * @return self
     */
    public function __construct(?Component $component = NULL)
    {
        if ($component instanceof Component) {
            $this->setComponent($component);
        }
    }

    /**
     * Sets the component.
     *
     * @return Component
     */
    public function getComponent(): ?Component
    {
        return $this->component;
    }

    /**
     * Sets the component.
     *
     * @param  Component $component
     * @return self
     */
    public function setComponent(Component $component): self
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
        return new DeleteXMPPComponentEnvelope(
            new DeleteXMPPComponentBody($this)
        );
    }
}
