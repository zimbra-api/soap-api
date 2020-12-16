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
use Zimbra\Admin\Struct\NetworkInformation;
use Zimbra\Soap\ResponseInterface;

/**
 * GetServerNIfsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetServerNIfsResponse")
 */
class GetServerNIfsResponse implements ResponseInterface
{
    /**
     * Network interface information
     * 
     * @Accessor(getter="getNetworkInterfaces", setter="setNetworkInterfaces")
     * @SerializedName("ni")
     * @Type("array<Zimbra\Admin\Struct\NetworkInformation>")
     * @XmlList(inline = true, entry = "ni")
     */
    private $networkInterfaces;

    /**
     * Constructor method for GetServerNIfsResponse
     * @param array $networkInterfaces
     * @return self
     */
    public function __construct(array $networkInterfaces = [])
    {
        $this->setNetworkInterfaces($networkInterfaces);
    }

    /**
     * Add a network information
     *
     * @param  NetworkInformation $ni
     * @return self
     */
    public function addNetworkInterface(NetworkInformation $ni): self
    {
        $this->networkInterfaces[] = $ni;
        return $this;
    }

    /**
     * Sets network informations
     *
     * @param  array $networkInterfaces
     * @return self
     */
    public function setNetworkInterfaces(array $networkInterfaces): self
    {
        $this->networkInterfaces = [];
        foreach ($networkInterfaces as $ni) {
            if ($ni instanceof NetworkInformation) {
                $this->networkInterfaces[] = $ni;
            }
        }
        return $this;
    }

    /**
     * Gets network informations
     *
     * @return array
     */
    public function getNetworkInterfaces(): array
    {
        return $this->networkInterfaces;
    }
}
