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
    XmlList
};

/**
 * AdminObjectInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class AdminObjectInfo implements AdminObjectInterface
{
    /**
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
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * @Accessor(getter="getAttrList", setter="setAttrList")
     * @Type("array<Zimbra\Admin\Struct\Attr>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getAttrList", setter: "setAttrList")]
    #[Type("array<Zimbra\Admin\Struct\Attr>")]
    #[XmlList(inline: true, entry: "a", namespace: "urn:zimbraAdmin")]
    private $attrList = [];

    /**
     * Constructor
     *
     * @param  string $name Name
     * @param  string $id ID
     * @param  array  $attrs Attributes
     * @return self
     */
    public function __construct(
        string $name = "",
        string $id = "",
        array $attrs = []
    ) {
        $this->setName($name)->setId($id)->setAttrList($attrs);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set attribute sequence
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrList(array $attrs): self
    {
        $this->attrList = array_filter(
            $attrs,
            static fn($attr) => $attr instanceof Attr
        );
        return $this;
    }

    /**
     * Get attribute sequence
     *
     * @return array
     */
    public function getAttrList(): array
    {
        return $this->attrList;
    }
}
