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
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\HandlerCallback;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\XmlDeserializationVisitor;

use Zimbra\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Struct\EntrySearchFilterSingleCond as SingleCond;

/**
 * EntrySearchFilterMultiCond struct class
 *
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="conds")
 */
class EntrySearchFilterMultiCond implements SearchFilterCondition
{

    /**
     * @Accessor(getter="getNot", setter="setNot")
     * @SerializedName("not")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $_not;

    /**
     * @Accessor(getter="getOr", setter="setOr")
     * @SerializedName("or")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $_or;

    /**
     * The array of condition
     * @var array
     * @Exclude
     */
    private $_conditions = [];

    /**
     * Constructor method for entrySearchFilterMultiCond
     * @param bool $not
     * @param bool $or
     * @param array $conditions
     * @return self
     */
    public function __construct(
        $not = NULL,
        $or = NULL,
        array $conditions = []
    )
    {
        if (NULL !== $not) {
            $this->setNot($not);
        }
        if (NULL !== $or) {
            $this->setOr($or);
        }
        $this->setConditions($conditions);
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

    /**
     * Gets or flag
     *
     * @return bool
     */
    public function getOr()
    {
        return $this->_or;
    }

    /**
     * Sets or flag
     *
     * @param  bool $or
     * @return self
     */
    public function setOr($or)
    {
        $this->_or = (bool) $or;
        return $this;
    }

    /**
     * Add a condition
     *
     * @param  SearchFilterCondition $condition
     * @return self
     */
    public function addCondition(SearchFilterCondition $condition)
    {
        $this->_conditions[] = $condition;
        return $this;
    }

    /**
     * Sets condition sequence
     *
     * @return self
     */
    public function setConditions(array $conditions)
    {
        $this->_conditions = [];
        foreach ($conditions as $condition) {
            if ($condition instanceof SearchFilterCondition) {
                $this->_conditions[] = $condition;
            }
        }
        return $this;
    }

    /**
     * Gets condition sequence
     *
     * @return Sequence
     */
    public function getConditions()
    {
        return $this->_conditions;
    }

    /**
     * @VirtualProperty
     * @Type("array<Zimbra\Struct\EntrySearchFilterMultiCond>")
     * @SerializedName("conds")
     * @XmlList(inline = true, entry = "conds")
     *
     * @return array
     */
    public function getMultiCond()
    {
        $conds = [];
        foreach ($this->_conditions as $condition) {
            if ($condition instanceof MultiCond) {
                $conds[] = $condition;
            }
        }
        return $conds;
    }

    /**
     * @VirtualProperty
     * @Type("array<Zimbra\Struct\EntrySearchFilterSingleCond>")
     * @SerializedName("cond")
     * @XmlList(inline = true, entry = "cond")
     *
     * @return array
     */
    public function getSingleCond()
    {
        $conds = [];
        foreach ($this->_conditions as $condition) {
            if ($condition instanceof SingleCond) {
                $conds[] = $condition;
            }
        }
        return $conds;
    }

    /** @HandlerCallback("xml", direction = "deserialization") */
    public function deserializeFromXml(XmlDeserializationVisitor $visitor, \SimpleXMLElement $data, DeserializationContext $context)
    {
        $attributes = $data->attributes();
        foreach ($attributes as $key => $value) {
            if ($key == 'not') {
                $this->setNot(self::stringToBoolean($value));
            }
            if ($key == 'or') {
                $this->setOr(self::stringToBoolean($value));
            }
        }

        $serializer = SerializerBuilder::create()->build();
        $children = $data->children();
        foreach ($children as $value) {
            $name = $value->getName();
            if ($name == 'conds') {
                $conds = $serializer->deserialize($value->asXml(), 'Zimbra\Struct\EntrySearchFilterMultiCond', 'xml');
                $this->addCondition($conds);
            }
            if ($name == 'cond') {
                $cond = $serializer->deserialize($value->asXml(), 'Zimbra\Struct\EntrySearchFilterSingleCond', 'xml');
                $this->addCondition($cond);
            }
        }
    }

    public static function stringToBoolean($value)
    {
        $value = (string) $value;
        if ('true' === $value || '1' === $value) {
            $value = TRUE;
        }
        elseif ('false' === $value || '0' === $value) {
            $value = FALSE;
        }
        else {
            throw new \RuntimeException(
                sprintf('Could not convert data to boolean. Expected "true", "false", "1" or "0", but got %s.', json_encode($data))
            );
        }
        return $value;
    }
}
