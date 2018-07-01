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
use JMS\Serializer\Annotation\XmlList;

/**
 * AdminObjectInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class AdminObjectInfo implements AdminObjectInterface
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $_id;

    /**
     * @Accessor(getter="getAttrList", setter="setAttrList")
     * @Type("array<Zimbra\Admin\Struct\Attr>")
     * @XmlList(inline = true, entry = "a")
     */
    private $_attrList;

    /**
     * Constructor method for AdminObjectInfo
     * 
     * @param  string $name Name
     * @param  string $id ID
     * @param  array  $attrs Attributes
     * @return self
     */
    public function __construct($name, $id, array $attrs = [])
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
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets name
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
     * Gets ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Add an attr
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->_attrList[] = $attr;
        return $this;
    }

    /**
     * Sets attribute sequence
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrList(array $attrs)
    {
        $this->_attrList = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof Attr) {
                $this->_attrList[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Gets attribute sequence
     *
     * @return array
     */
    public function getAttrList()
    {
        return $this->_attrList;
    }
}
