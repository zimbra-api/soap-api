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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllXMPPComponentsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllXMPPComponentsResponse")
 */
class GetAllXMPPComponentsResponse implements ResponseInterface
{
    /**
     * Information on XMPP components
     * 
     * @Accessor(getter="getComponents", setter="setComponents")
     * @SerializedName("xmppcomponent")
     * @Type("array<Zimbra\Admin\Struct\XMPPComponentInfo>")
     * @XmlList(inline = true, entry = "xmppcomponent")
     */
    private $components;

    /**
     * Constructor method for GetAllXMPPComponentsResponse
     * @param array $components
     * @return self
     */
    public function __construct(array $components = [])
    {
        $this->setComponents($components);
    }

    /**
     * Add a component
     *
     * @param  XMPPComponentInfo $component
     * @return self
     */
    public function addComponent(XMPPComponentInfo $component): self
    {
        $this->components[] = $component;
        return $this;
    }

    /**
     * Sets components
     *
     * @param  array $components
     * @return self
     */
    public function setComponents(array $components): self
    {
        $this->components = [];
        foreach ($components as $component) {
            if ($component instanceof XMPPComponentInfo) {
                $this->components[] = $component;
            }
        }
        return $this;
    }

    /**
     * Gets components
     *
     * @return array
     */
    public function getComponents(): array
    {
        return $this->components;
    }
}
