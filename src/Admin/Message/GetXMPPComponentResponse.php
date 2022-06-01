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
use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetXMPPComponentResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetXMPPComponentResponse implements ResponseInterface
{
    /**
     * XMPP Component Information
     * @Accessor(getter="getComponent", setter="setComponent")
     * @SerializedName("xmppcomponent")
     * @Type("Zimbra\Admin\Struct\XMPPComponentInfo")
     * @XmlElement
     */
    private XMPPComponentInfo $component;

    /**
     * Constructor method for GetXMPPComponentResponse
     *
     * @param XMPPComponentInfo $component
     * @return self
     */
    public function __construct(XMPPComponentInfo $component)
    {
        $this->setComponent($component);
    }

    /**
     * Gets the component.
     *
     * @return XMPPComponentInfo
     */
    public function getComponent(): XMPPComponentInfo
    {
        return $this->component;
    }

    /**
     * Sets the component.
     *
     * @param  XMPPComponentInfo $component
     * @return self
     */
    public function setComponent(XMPPComponentInfo $component): self
    {
        $this->component = $component;
        return $this;
    }
}
