<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};

/**
 * Session struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
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
    private $type;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for Session
     * @param  string $id
     *   Session ID
     * @param  string   $type
     *   Session type - currently only set if value is "admin"
     * @return self
     */
    public function __construct($id, $type = NULL)
    {
        $this->setValue($id)->setId($id);
        if (NULL !== $type) {
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
        return $this->value;
    }

    /**
     * Sets session id
     *
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = trim($value);
        return $this;
    }

    /**
     * Gets session type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets session type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = trim($type) ;
        return $this;
    }

    /**
     * Gets session id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets session id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = trim($id) ;
        return $this;
    }
}
