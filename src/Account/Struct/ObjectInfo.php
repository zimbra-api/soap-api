<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Struct\KeyValuePair;

/**
 * ObjectInfo struct class
 * Information for an Object - attributes are encoded as Key/Value pairs in JSON - i.e. using "_attrs"
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class ObjectInfo
{
    /**
     * Name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Attributes
     * 
     * @Accessor(getter="getAttrList", setter="setAttrList")
     * @Type("array<Zimbra\Common\Struct\KeyValuePair>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraAccount")
     */
    private $attrList = [];

    /**
     * Constructor
     * 
     * @param  string $name
     * @param  string $id
     * @param  array  $attrs
     * @return self
     */
    public function __construct(
        string $name = '', string $id = '', array $attrs = []
    )
    {
        $this->setName($name)
             ->setId($id)
             ->setAttrList($attrs);
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
        $this->attrList = array_filter($attrs, static fn ($attr) => $attr instanceof KeyValuePair);
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
