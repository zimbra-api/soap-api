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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DeleteXMPPComponentRequest class
 * Delete an XMPP Component
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeleteXMPPComponentRequest extends SoapRequest
{
    /**
     * XMPP Component details
     * 
     * @var Component
     */
    #[Accessor(getter: 'getComponent', setter: 'setComponent')]
    #[SerializedName(name: 'xmppcomponent')]
    #[Type(name: Component::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $component;

    /**
     * Constructor
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
     * Set the component.
     *
     * @return Component
     */
    public function getComponent(): ?Component
    {
        return $this->component;
    }

    /**
     * Set the component.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DeleteXMPPComponentEnvelope(
            new DeleteXMPPComponentBody($this)
        );
    }
}
