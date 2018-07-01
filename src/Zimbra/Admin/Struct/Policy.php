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

use Zimbra\Enum\Type as EnumType;

/**
 * Policy struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="policy")
 */
class Policy
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
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("string")
     * @XmlAttribute
     */
    private $_lifetime;

    /**
     * Constructor method for policy
     * @param string $type Retention policy type
     * @param string $id The id
     * @param string $name The name
     * @param string $lifetime The duration
     * @return self
     */
    public function __construct($type = NULL, $id = NULL, $name = NULL, $lifetime = NULL)
    {
        if (NULL !== $type) {
            $this->setType($type);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $lifetime) {
            $this->setLifetime($lifetime);
        }
    }

    public static function newUserPolicy($lifetime = NULL)
    {
        return new self(EnumType::USER()->value(), NULL, NULL, $lifetime);
    }

    public static function newSystemPolicy($id = NULL, $name = NULL, $lifetime = NULL)
    {
        return new self(EnumType::SYSTEM()->value(), NULL, NULL, $lifetime);
    }

    /**
     * Gets type enum
     *
     * @return string
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
        if (EnumType::has(trim($type))) {
            $this->_type = trim($type);
        }
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
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets the name
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
     * Gets the lifetime
     *
     * @return string
     */
    public function getLifetime()
    {
        return $this->_lifetime;
    }

    /**
     * Sets the lifetime
     *
     * @param  string $lifetime
     * @return self
     */
    public function setLifetime($lifetime)
    {
        $this->_lifetime = trim($lifetime);
        return $this;
    }
}
