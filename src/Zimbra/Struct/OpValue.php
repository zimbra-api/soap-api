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
use JMS\Serializer\Annotation\XmlValue;

/**
 * OpValue struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="addr")
 */
class OpValue
{
    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     */
    private $_op;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * Constructor method for OpValue
     * @param  string $op
     * @param  string $value
     * @return self
     */
    public function __construct($op = '+', $value = NULL)
    {
        if (NULL !== $op) {
            $this->setOp($op);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets operation
     *
     * @return string
     */
    public function getOp()
    {
        return $this->_op;
    }

    /**
     * sets operation
     *
     * @param  string $op
     * @return self
     */
    public function setOp($op = '+')
    {
        if (in_array(trim($op), ['+', '-'])) {
            $this->_op = trim($op);
        }
        else {
            $this->_op = '+';
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
     * @param  string $name
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }
}
