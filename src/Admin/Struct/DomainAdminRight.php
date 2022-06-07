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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Enum\RightType;

/**
 * DomainAdminRight struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DomainAdminRight
{
    /**
     * Domain admin right name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Right type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\RightType")
     * @XmlAttribute
     */
    private RightType $type;

    /**
     * Description
     * @Accessor(getter="getDesc", setter="setDesc")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $desc;

    /**
     * Rights
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("rights")
     * @Type("array<Zimbra\Admin\Struct\RightWithName>")
     * @XmlList(inline = false, entry = "r")
     */
    private $rights = [];

    /**
     * Constructor method for DomainAdminRight
     *
     * @param string $name
     * @param RightType $type
     * @param string $desc
     * @param array  $rights
     * @return self
     */
    public function __construct(
        string $name,
        RightType $type,
        string $desc,
        array $rights = []
    )
    {
        $this->setName($name)
             ->setType($type)
             ->setDesc($desc)
             ->setRights($rights);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
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
     * Gets type
     *
     * @return RightType
     */
    public function getType(): RightType
    {
        return $this->type;
    }

    /**
     * Sets type
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
     * Gets desc
     *
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * Sets desc
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
     * Gets rights
     *
     * @return array
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * Sets rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights)
    {
        $this->rights = array_filter($rights, static fn($right) => $right instanceof RightWithName);
        return $this;
    }

    /**
     * Add right
     *
     * @param  RightWithName $right
     * @return self
     */
    public function addRight(RightWithName $right)
    {
        $this->rights[] = $right;
        return $this;
    }
}
