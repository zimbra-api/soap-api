<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

use Zimbra\Enum\AccountBy;

/**
 * AccountInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="account")
 */
class AccountInfo
{
    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("string")
     * @XmlAttribute
     */
    private $_by;

    /**
     * @Accessor(getter="getMountpointTraversed", setter="setMountpointTraversed")
     * @SerializedName("link")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $_mountpointTraversed;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * Constructor method for AccountInfo
     * @param  string $by
     * @param  bool $mountpointTraversed
     * @param  string $value
     * @return self
     */
    public function __construct($by, $mountpointTraversed = null, $value = null)
    {
        $this->setBy($by);
        if(null !== $mountpointTraversed)
        {
            $this->setMountpointTraversed($mountpointTraversed);
        }
        if(null !== $value)
        {
            $this->setValue($value);
        }
    }

    /**
     * Gets account by
     *
     * @return string
     */
    public function getBy()
    {
        return $this->_by;
    }

    /**
     * Sets account by enum
     *
     * @param  string $by
     * @return self
     */
    public function setBy($by)
    {
        if (AccountBy::has(trim($by))) {
            $this->_by = trim($by);
        }
        return $this;
    }

    /**
     * Gets mountpoint traversed
     *
     * @return string
     */
    public function getMountpointTraversed()
    {
        return $this->_mountpointTraversed;
    }

    /**
     * Sets mountpoint traversed
     *
     * @param  bool $mountpointTraversed
     * @return self
     */
    public function setMountpointTraversed($mountpointTraversed)
    {
        $this->_mountpointTraversed = (bool) $mountpointTraversed;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }
}
