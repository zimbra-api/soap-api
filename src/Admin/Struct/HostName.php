<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * HostName struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="hostname")
 */
class HostName
{
    /**
     * @Accessor(getter="getHostName", setter="setHostName")
     * @SerializedName("hn")
     * @Type("string")
     * @XmlAttribute
     */
    private $hostName;

    /**
     * Constructor method for HostName
     * @param  string $hn Hostname
     * @return self
     */
    public function __construct($hostName)
    {
        $this->setHostName($hostName);
    }

    /**
     * Gets hostname
     *
     * @return string
     */
    public function getHostName(): string
    {
        return $this->hostName;
    }

    /**
     * Sets hostname
     *
     * @param  string $hostName
     * @return self
     */
    public function setHostName(string $hostName): self
    {
        $this->hostName = $hostName;
        return $this;
    }
}
