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
use Zimbra\Common\Enum\{RightClass, RightType};

/**
 * RightInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RightInfo
{
    /**
     * Right name
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
     * Right type.  Valid values : getAttrs | setAttrs | combo | preset
     *
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\RightType>")
     * @XmlAttribute
     * @var RightType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[Type("Enum<Zimbra\Common\Enum\RightType>")]
    #[XmlAttribute]
    private RightType $type;

    /**
     * Target type.
     *
     * @Accessor(getter="getTargetType", setter="setTargetType")
     * @SerializedName("targetType")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getTargetType", setter: "setTargetType")]
    #[SerializedName("targetType")]
    #[Type("string")]
    #[XmlAttribute]
    private $targetType;

    /**
     * Right class
     *
     * @Accessor(getter="getRightClass", setter="setRightClass")
     * @SerializedName("rightClass")
     * @Type("Enum<Zimbra\Common\Enum\RightClass>")
     * @XmlAttribute
     *
     * @var RightClass
     */
    #[Accessor(getter: "getRightClass", setter: "setRightClass")]
    #[SerializedName("rightClass")]
    #[Type("Enum<Zimbra\Common\Enum\RightClass>")]
    #[XmlAttribute]
    private RightClass $rightClass;

    /**
     * Right description
     *
     * @Accessor(getter="getDesc", setter="setDesc")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     *
     * @var string
     */
    #[Accessor(getter: "getDesc", setter: "setDesc")]
    #[SerializedName("desc")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $desc;

    /**
     * Attrs
     *
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("Zimbra\Admin\Struct\RightsAttrs")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var RightsAttrs
     */
    #[Accessor(getter: "getAttrs", setter: "setAttrs")]
    #[SerializedName("attrs")]
    #[Type(RightsAttrs::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?RightsAttrs $attrs;

    /**
     * Rights
     *
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("rights")
     * @Type("Zimbra\Admin\Struct\ComboRights")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var ComboRights
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[SerializedName("rights")]
    #[Type(ComboRights::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?ComboRights $rights;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  RightType $type
     * @param  RightClass $rightClass
     * @param  string $desc
     * @param  string $targetType
     * @param  RightsAttrs $attrs
     * @param  ComboRights $rights
     * @return self
     */
    public function __construct(
        string $name = "",
        ?RightType $type = null,
        ?RightClass $rightClass = null,
        string $desc = "",
        ?string $targetType = null,
        ?RightsAttrs $attrs = null,
        ?ComboRights $rights = null
    ) {
        $this->setName($name)
            ->setType($type ?? new RightType("preset"))
            ->setRightClass($rightClass ?? new RightClass("ALL"))
            ->setDesc($desc);
        $this->attrs = $attrs;
        $this->rights = $rights;
        if (null !== $targetType) {
            $this->setTargetType($targetType);
        }
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
     * Get targetType
     *
     * @return string
     */
    public function getTargetType(): ?string
    {
        return $this->targetType;
    }

    /**
     * Set targetType
     *
     * @param  string $targetType
     * @return self
     */
    public function setTargetType(string $targetType): self
    {
        $this->targetType = $targetType;
        return $this;
    }

    /**
     * Get type
     *
     * @return RightType
     */
    public function getType(): RightType
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param  RightType $type
     * @return self
     */
    public function setType(RightType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get rightClass
     *
     * @return RightClass
     */
    public function getRightClass(): RightClass
    {
        return $this->rightClass;
    }

    /**
     * Set rightClass
     *
     * @param  RightClass $rightClass
     * @return self
     */
    public function setRightClass(RightClass $rightClass): self
    {
        $this->rightClass = $rightClass;
        return $this;
    }

    /**
     * Get desc
     *
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * Set desc
     *
     * @param  string $desc
     * @return self
     */
    public function setDesc(string $desc): self
    {
        $this->desc = $desc;
        return $this;
    }

    /**
     * Get attrs
     *
     * @return RightsAttrs
     */
    public function getAttrs(): ?RightsAttrs
    {
        return $this->attrs;
    }

    /**
     * Set attrs
     *
     * @param  RightsAttrs $attrs
     * @return self
     */
    public function setAttrs(RightsAttrs $attrs): self
    {
        $this->attrs = $attrs;
        return $this;
    }

    /**
     * Get rights
     *
     * @return ComboRights
     */
    public function getRights(): ?ComboRights
    {
        return $this->rights;
    }

    /**
     * Set rights
     *
     * @param  ComboRights $rights
     * @return self
     */
    public function setRights(ComboRights $rights): self
    {
        $this->rights = $rights;
        return $this;
    }
}
