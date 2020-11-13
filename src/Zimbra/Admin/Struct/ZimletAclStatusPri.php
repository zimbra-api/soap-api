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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Enum\ZimletStatus;

/**
 * ZimletAclStatusPri struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
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
    private $name;

    /**
     * @Accessor(getter="getAcl", setter="setAcl")
     * @SerializedName("acl")
     * @Type("Zimbra\Admin\Struct\ZimletAcl")
     * @XmlElement
     */
    private $acl;

    /**
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Admin\Struct\ValueAttrib")
     * @XmlElement
     */
    private $status;

    /**
     * @Accessor(getter="getPriority", setter="setPriority")
     * @SerializedName("priority")
     * @Type("Zimbra\Admin\Struct\IntegerValueAttrib")
     * @XmlElement
     */
    private $priority;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets the acl
     *
     * @return ZimletAcl
     */
    public function getAcl(): ZimletAcl
    {
        return $this->acl;
    }

    /**
     * Sets the acl
     *
     * @param  ZimletAcl $acl
     * @return self
     */
    public function setAcl(ZimletAcl $acl): self
    {
        $this->acl = $acl;
        return $this;
    }

    /**
     * Gets the status
     *
     * @return ValueAttrib
     */
    public function getStatus(): ValueAttrib
    {
        return $this->status;
    }

    /**
     * Sets the status
     *
     * @param  ValueAttrib $status
     * @return self
     */
    public function setStatus(ValueAttrib $status): self
    {
        if (ZimletStatus::isValid($status->getValue())) {
            $this->status = $status;
        }
        return $this;
    }

    /**
     * Gets the priority
     *
     * @return IntegerValueAttrib
     */
    public function getPriority(): IntegerValueAttrib
    {
        return $this->priority;
    }

    /**
     * Sets the priority
     *
     * @param  IntegerValueAttrib $priority
     * @return self
     */
    public function setPriority(IntegerValueAttrib $priority): self
    {
        $this->priority = $priority;
        return $this;
    }
}
