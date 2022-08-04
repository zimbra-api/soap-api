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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetXMPPComponentResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetXMPPComponentResponse extends SoapResponse
{
    /**
     * XMPP Component Information
     * @Accessor(getter="getComponent", setter="setComponent")
     * @SerializedName("xmppcomponent")
     * @Type("Zimbra\Admin\Struct\XMPPComponentInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?XMPPComponentInfo $component = NULL;

    /**
     * Constructor method for GetXMPPComponentResponse
     *
     * @param XMPPComponentInfo $component
     * @return self
     */
    public function __construct(?XMPPComponentInfo $component = NULL)
    {
        if ($component instanceof XMPPComponentInfo) {
            $this->setComponent($component);
        }
    }

    /**
     * Get the component.
     *
     * @return XMPPComponentInfo
     */
    public function getComponent(): ?XMPPComponentInfo
    {
        return $this->component;
    }

    /**
     * Set the component.
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
