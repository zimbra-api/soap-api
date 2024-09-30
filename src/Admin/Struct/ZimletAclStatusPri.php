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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Enum\ZimletStatus;

/**
 * ZimletAclStatusPri struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ZimletAclStatusPri
{
    /**
     * Name of Class Of Service (COS)
     *
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * Zimlet ACL
     *
     * @Accessor(getter="getAcl", setter="setAcl")
     * @SerializedName("acl")
     * @Type("Zimbra\Admin\Struct\ZimletAcl")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var ZimletAcl
     */
    #[Accessor(getter: "getAcl", setter: "setAcl")]
    #[SerializedName("acl")]
    #[Type(ZimletAcl::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?ZimletAcl $acl;

    /**
     * Status - valid values for valueattribute - enabled|disabled
     *
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Admin\Struct\ValueAttrib")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var ValueAttrib
     */
    #[Accessor(getter: "getStatus", setter: "setStatus")]
    #[SerializedName("status")]
    #[Type(ValueAttrib::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?ValueAttrib $status;

    /**
     * Priority
     *
     * @Accessor(getter="getPriority", setter="setPriority")
     * @SerializedName("priority")
     * @Type("Zimbra\Admin\Struct\IntegerValueAttrib")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var IntegerValueAttrib
     */
    #[Accessor(getter: "getPriority", setter: "setPriority")]
    #[SerializedName("priority")]
    #[Type(IntegerValueAttrib::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?IntegerValueAttrib $priority;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  ZimletAcl $acl
     * @param  ValueAttrib $status
     * @param  IntegerValueAttrib $priority
     * @return self
     */
    public function __construct(
        string $name = "",
        ?ZimletAcl $acl = null,
        ?ValueAttrib $status = null,
        ?IntegerValueAttrib $priority = null
    ) {
        $this->setName($name);
        $this->acl = $acl;
        $this->status = $status;
        $this->priority = $priority;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the acl
     *
     * @return ZimletAcl
     */
    public function getAcl(): ?ZimletAcl
    {
        return $this->acl;
    }

    /**
     * Set the acl
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
     * Get the status
     *
     * @return ValueAttrib
     */
    public function getStatus(): ?ValueAttrib
    {
        return $this->status;
    }

    /**
     * Set the status
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
     * Get the priority
     *
     * @return IntegerValueAttrib
     */
    public function getPriority(): ?IntegerValueAttrib
    {
        return $this->priority;
    }

    /**
     * Set the priority
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
