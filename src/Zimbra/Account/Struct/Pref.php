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

/**
 * Preference struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="pref")
 */
class Pref
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * @Accessor(getter="getModified", setter="setModified")
     * @SerializedName("modified")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_modified;

    /**
     * Constructor method for preference
     * @param  string $name
     * @param  string $value
     * @param  int   $modified
     * @return self
     */
    public function __construct($name, $value = null, $modified = null)
    {
        $this->setName($name);
        if (null !== $value) {
            $this->setValue($value);
        }
        if (null !== $modified) {
            $this->setModified($modified);
        }
    }

    /**
     * Gets preference name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets preference name
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

    /**
     * Get preference modified time
     *
     * @return int
     */
    public function getModified()
    {
        return $this->_modified;
    }

    /**
     * Sets preference modified time
     *
     * @param  int $modified
     * @return self
     */
    public function setModified($modified)
    {
        $this->_modified = (int) $modified;
        return $this;
    }
}
