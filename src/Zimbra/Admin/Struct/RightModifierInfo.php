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
use JMS\Serializer\Annotation\XmlValue;

/**
 * RightModifierInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="right")
 */
class RightModifierInfo
{
    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * @Accessor(getter="getDeny", setter="setDeny")
     * @SerializedName("deny")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_deny;

    /**
     * @Accessor(getter="getCanDelegate", setter="setCanDelegate")
     * @SerializedName("canDelegate")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_canDelegate;

    /**
     * @Accessor(getter="getDisinheritSubGroups", setter="setDisinheritSubGroups")
     * @SerializedName("disinheritSubGroups")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_disinheritSubGroups;

    /**
     * @Accessor(getter="getSubDomain", setter="setSubDomain")
     * @SerializedName("subDomain")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_subDomain;

    /**
     * Constructor method for RightModifierInfo
     * @param string $value Value is of the form
     * @param bool $deny Deny flag - default is 0 (false)
     * @param bool $canDelegate Flag whether can delegate - default is 0 (false)
     * @param bool $disinheritSubGroups disinheritSubGroups flag - default is 0 (false)
     * @param bool $subDomain subDomain flag - default is 0 (false)
     * @return self
     */
    public function __construct(
        $value = NULL,
        $deny = NULL,
        $canDelegate = NULL,
        $disinheritSubGroups = NULL,
        $subDomain = NULL
    )
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $deny) {
            $this->setDeny($deny);
        }
        if (NULL !== $canDelegate) {
            $this->setCanDelegate($canDelegate);
        }
        if (NULL !== $disinheritSubGroups) {
            $this->setDisinheritSubGroups($disinheritSubGroups);
        }
        if (NULL !== $subDomain) {
            $this->setSubDomain($subDomain);
        }
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

    /**
     * Gets the deny flag
     *
     * @return bool
     */
    public function getDeny()
    {
        return $this->_deny;
    }

    /**
     * Sets the deny flag
     *
     * @param  bool $deny
     * @return self
     */
    public function setDeny($deny)
    {
        $this->_deny = (bool) $deny;
        return $this;
    }

    /**
     * Gets the can delegate flag
     *
     * @return bool
     */
    public function getCanDelegate()
    {
        return $this->_canDelegate;
    }

    /**
     * Sets the can delegate flag
     *
     * @param  bool $canDelegate
     * @return self
     */
    public function setCanDelegate($canDelegate)
    {
        $this->_canDelegate = (bool) $canDelegate;
        return $this;
    }

    /**
     * Gets the disinheritSubGroups flag
     *
     * @return bool
     */
    public function getDisinheritSubGroups()
    {
        return $this->_disinheritSubGroups;
    }

    /**
     * Sets the disinheritSubGroups flag
     *
     * @param  bool $disinheritSubGroups
     * @return self
     */
    public function setDisinheritSubGroups($disinheritSubGroups)
    {
        $this->_disinheritSubGroups = (bool) $disinheritSubGroups;
        return $this;
    }

    /**
     * Gets the sub domain flag
     *
     * @return bool
     */
    public function getSubDomain()
    {
        return $this->_subDomain;
    }

    /**
     * Sets the sub domain flag
     *
     * @param  bool $subDomain
     * @return self
     */
    public function setSubDomain($subDomain)
    {
        $this->_subDomain = (bool) $subDomain;
        return $this;
    }
}
