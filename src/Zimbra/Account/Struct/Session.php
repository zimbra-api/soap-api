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
 * Session struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="session")
 */
class Session
{
    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $_type;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $_id;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * Constructor method for Session
     * @param  string $id
     *   Session ID
     * @param  string   $type
     *   Session type - currently only set if value is "admin"
     * @return self
     */
    public function __construct($id, $type = null)
    {
        $this->setValue($id)->setId($id);
        if (null !== $type) {
            $this->setType($type);
        }
    }

    /**
     * Gets session id
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets session id
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
     * Gets session type
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets session type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->_type = trim($type) ;
        return $this;
    }

    /**
     * Gets session id
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets session id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        $this->_id = trim($id) ;
        return $this;
    }
}
