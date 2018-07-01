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
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * ConstraintInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="constraint")
 */
class ConstraintInfo
{

    /**
     * @Accessor(getter="getMin", setter="setMin")
     * @SerializedName("min")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $_min;

    /**
     * @Accessor(getter="getMax", setter="setMax")
     * @SerializedName("max")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $_max;


    /**
     * @Accessor(getter="getValues", setter="setValues")
     * @SerializedName("values")
     * @Type("Zimbra\Admin\Struct\ConstraintInfoValues")
     * @XmlElement
     */
    private $_values;

    /**
     * Constructor method for ConstraintInfo
     * @param  string $min Minimum value
     * @param  string $max Maximum value
     * @param  ConstraintInfoValues $values Acceptable values
     * @return self
     */
    public function __construct($min = NULL, $max = NULL, ConstraintInfoValues $values = NULL)
    {
        if (NULL !== $min) {
            $this->setMin($min);
        }
        if (NULL !== $max) {
            $this->setMax($max);
        }
        if ($values instanceof ConstraintInfoValues) {
            $this->setValues($values);
        }
    }

    /**
     * Gets minimum value
     *
     * @return string
     */
    public function getMin()
    {
        return $this->_min;
    }

    /**
     * Sets minimum value
     *
     * @param  string $min
     * @return string|self
     */
    public function setMin($min)
    {
        $this->_min = trim($min);
        return $this;
    }

    /**
     * Gets maximum value
     *
     * @return string
     */
    public function getMax()
    {
        return $this->_max;
    }

    /**
     * Sets maximum value
     *
     * @param  string $max
     * @return self
     */
    public function setMax($max)
    {
        $this->_max = trim($max);
        return $this;
    }

    /**
     * Gets acceptable values
     *
     * @return ConstraintInfoValues
     */
    public function getValues()
    {
        return $this->_values;
    }

    /**
     * Sets acceptable values
     *
     * @param  ConstraintInfoValues $values
     * @return self
     */
    public function setValues(ConstraintInfoValues $values)
    {
        $this->_values = $values;
        return $this;
    }

    public function addValue($value) {
        if (!($this->_values instanceof ConstraintInfoValues)) {
            $this->_values = new ConstraintInfoValues();
        }
        $this->_values->addValue($value);
        return $this;
    }
}