<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * HostName struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
    private $_hostName;

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
    public function getHostName()
    {
        return $this->_hostName;
    }

    /**
     * Sets hostname
     *
     * @param  string $hn
     * @return self
     */
    public function setHostName($hostName)
    {
        $this->_hostName = trim($hostName);
        return $this;
    }
}
