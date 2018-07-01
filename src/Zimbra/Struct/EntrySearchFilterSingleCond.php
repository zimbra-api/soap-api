<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\ConditionOperator as Op;

/**
 * EntrySearchFilterSingleCond struct class
 *
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="cond")
 */
class EntrySearchFilterSingleCond implements SearchFilterCondition
{
    /**
     * @Accessor(getter="getAttr", setter="setAttr")
     * @SerializedName("attr")
     * @Type("string")
     * @XmlAttribute
     */
    private $_attr;

    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     */
    private $_op;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     */
    private $_value;

    /**
     * @Accessor(getter="getNot", setter="setNot")
     * @SerializedName("not")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $_not;

    /**
     * Constructor method for EntrySearchFilterSingleCond
     * @param string $attr
     * @param string $op
     * @param string $value
     * @param bool $not
     * @return self
     */
    public function __construct(
        $attr,
        $op,
        $value,
        $not = NULL
    )
    {
        $this->setAttr($attr)
            ->setOp($op)
            ->setValue($value);
        if (NULL !== $not) {
            $this->setNot($not);
        }
    }

    /**
     * Gets attribute name
     *
     * @return string
     */
    public function getAttr()
    {
        return $this->_attr;
    }

    /**
     * Sets attribute name
     *
     * @param  string $attr
     * @return self
     */
    public function setAttr($attr)
    {
        $this->_attr = trim($attr);
        return $this;
    }

    /**
     * Gets operator
     *
     * @return string
     */
    public function getOp()
    {
        return $this->_op;
    }

    /**
     * Sets operator
     *
     * @param  string $op
     * @return self
     */
    public function setOp($op)
    {
        if (Op::has(trim($op))) {
            $this->_op = $op;
        }
        return $this;
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
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets not flag
     *
     * @return bool
     */
    public function getNot()
    {
        return $this->_not;
    }

    /**
     * Sets not flag
     *
     * @param  bool $not
     * @return self
     */
    public function setNot($not)
    {
        $this->_not = (bool) $not;
        return $this;
    }
}
