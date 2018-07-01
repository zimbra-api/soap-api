<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\GranteeType;
use Zimbra\Enum\DistributionListGranteeBy as GranteeBy;

/**
 * DistributionListGranteeSelector struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="grantee")
 */
class DistributionListGranteeSelector
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
     * Constructor method for DistributionListGranteeSelector
     * @param string $type
     * @param string $by
     * @param string $value
     * @return self
     */
    public function __construct($type, $by, $value = null)
    {
        $this->setType($type)
            ->setBy($by);
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets grantee type
     *
     * @return GranteeType
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets grantee type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        if (GranteeType::has(trim($type))) {
            $this->_type = $type;
        }
        return $this;
    }

    /**
     * Gets grantee by
     *
     * @return GranteeBy
     */
    public function getBy()
    {
        return $this->_by;
    }

    /**
     * Sets grantee by
     *
     * @param  string $by
     * @return self
     */
    public function setBy($by = null)
    {
        if (GranteeBy::has(trim($by))) {
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
