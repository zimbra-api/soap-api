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
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

use Zimbra\Enum\TargetType;
use Zimbra\Enum\TargetBy;

/**
 * EffectiveRightsTargetSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="target")
 */
class EffectiveRightsTargetSelector
{
    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $_type;

    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("string")
     * @XmlAttribute
     */
    private $_by;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * Constructor method for EffectiveRightsTargetSelector
     * @param string $type Target type
     * @param string $by Target by
     * @param string $value The value
     * @return self
     */
    public function __construct($type, $by = NULL, $value = NULL)
    {
        $this->setType($type);
        if (NULL !== $by) {
            $this->setBy($by);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets type enum
     *
     * @return Zimbra\Enum\TargetType
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets type enum
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        if (TargetType::has(trim($type))) {
            $this->_type = $type;
        }
        return $this;
    }

    /**
     * Gets by enum
     *
     * @return Zimbra\Enum\TargetBy
     */
    public function getBy()
    {
        return $this->_by;
    }

    /**
     * Sets by enum
     *
     * @param  string $by
     * @return self
     */
    public function setBy($by)
    {
        if (TargetBy::has(trim($by))) {
            $this->_by = $by;
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
