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
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\ZimletStatus;

/**
 * ZimletAclStatusPri struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="zimlet")
 */
class ZimletAclStatusPri
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * @Accessor(getter="getAcl", setter="setAcl")
     * @SerializedName("acl")
     * @Type("Zimbra\Admin\Struct\ZimletAcl")
     * @XmlElement
     */
    private $_acl;

    /**
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Admin\Struct\ValueAttrib")
     * @XmlElement
     */
    private $_status;

    /**
     * @Accessor(getter="getPriority", setter="setPriority")
     * @SerializedName("priority")
     * @Type("Zimbra\Admin\Struct\IntegerValueAttrib")
     * @XmlElement
     */
    private $_priority;

    /**
     * Constructor method for ZimletAclStatusPri
     * @param  string $name Name of Class Of Service (COS)
     * @param  ZimletAcl $acl Zimlet ACL
     * @param  ValueAttrib $status Status - valid values for valueattribute - enabled|disabled
     * @param  IntegerValueAttrib $priority Priority
     * @return self
     */
    public function __construct(
        $name,
        ZimletAcl $acl = NULL,
        ValueAttrib $status = NULL,
        IntegerValueAttrib $priority = NULL
    )
    {
        $this->setName($name);
        if ($acl instanceof ZimletAcl) {
            $this->setAcl($acl);
        }
        if ($status instanceof ValueAttrib) {
            $this->setStatus($status);
        }
        if ($priority instanceof IntegerValueAttrib) {
            $this->setPriority($priority);
        }
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets the acl
     *
     * @return ZimletAcl
     */
    public function getAcl()
    {
        return $this->_acl;
    }

    /**
     * Sets the acl
     *
     * @param  ZimletAcl $acl
     * @return self
     */
    public function setAcl(ZimletAcl $acl)
    {
        $this->_acl = $acl;
        return $this;
    }

    /**
     * Gets the status
     *
     * @return ValueAttrib
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * Sets the status
     *
     * @param  ValueAttrib $status
     * @return self
     */
    public function setStatus(ValueAttrib $status)
    {
        if (ZimletStatus::has($status->getValue())) {
            $this->_status = $status;
        }
        return $this;
    }

    /**
     * Gets the priority
     *
     * @return IntegerValueAttrib
     */
    public function getPriority()
    {
        return $this->_priority;
    }

    /**
     * Sets the priority
     *
     * @param  IntegerValueAttrib $priority
     * @return self
     */
    public function setPriority(IntegerValueAttrib $priority)
    {
        $this->_priority = $priority;
        return $this;
    }
}
