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
use Zimbra\Struct\KeyValuePair;

/**
 * ObjectInfo struct class
 * Information for an Object - attributes are encoded as Key/Value pairs in JSON - i.e. using "_attrs"
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
abstract class ObjectInfo
{
    /**
     * Name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Attributes
     * @Accessor(getter="getAttrList", setter="setAttrList")
     * @SerializedName("a")
     * @Type("array<Zimbra\Struct\KeyValuePair>")
     * @XmlList(inline = true, entry = "a", skipWhenEmpty = true)
     */
    private $attrList = [];

    /**
     * Constructor method for ObjectInfo
     * 
     * @param  string $name
     * @param  string $id
     * @param  array  $attrs
     * @return self
     */
    public function __construct(string $name, string $id, array $attrs = [])
    {
        $this->setName($name)
             ->setId($id)
             ->setAttrList($attrs);
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
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
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
     * Add an attr
     *
     * @param  KeyValuePair $attr
     * @return self
     */
    public function addAttr(KeyValuePair $attr): self
    {
        $this->attrList[] = $attr;
        return $this;
    }

    /**
     * Sets attribute sequence
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrList(array $attrs): self
    {
        $this->attrList = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof KeyValuePair) {
                $this->attrList[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Gets attribute sequence
     *
     * @return array
     */
    public function getAttrList(): array
    {
        return $this->attrList;
    }
}