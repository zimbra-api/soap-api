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
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;

/**
 * CheckRightsTargetSpec struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="target")
 */
class CheckRightsTargetSpec
{
    /**
     * @Accessor(getter="getTargetType", setter="setTargetType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $_targetType;

    /**
     * @Accessor(getter="getTargetBy", setter="setTargetBy")
     * @SerializedName("by")
     * @Type("string")
     * @XmlAttribute
     */
    private $_targetBy;

    /**
     * @Accessor(getter="getTargetKey", setter="setTargetKey")
     * @SerializedName("key")
     * @Type("string")
     * @XmlAttribute
     */
    private $_targetKey;

    /**
     * @Accessor(getter="getRights", setter="setRights")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "right")
     */
    private $_rights;

    /**
     * Constructor method for CheckRightsTargetSpec
     * @param  string $type
     * @param  string $by
     * @param  string $key
     * @param  string $rights
     * @return self
     */
    public function __construct($type, $by, $key, array $rights = [])
    {
        $this->setTargetType($type)
            ->setTargetBy($by)
            ->setTargetKey($key)
            ->setRights($rights);
    }

    /**
     * Gets target type
     *
     * @return TargetType
     */
    public function getTargetType()
    {
        return $this->_targetType;
    }

    /**
     * Sets target type
     *
     * @param  string $type
     * @return self
     */
    public function setTargetType($type)
    {
        if (TargetType::has(trim($type))) {
            $this->_targetType = $type;
        }
        return $this;
    }

    /**
     * Gets target by
     *
     * @return string
     */
    public function getTargetBy()
    {
        return $this->_targetBy;
    }

    /**
     * Sets target by
     *
     * @param  string $by
     * @return self
     */
    public function setTargetBy($by)
    {
        if (TargetBy::has(trim($by))) {
            $this->_targetBy = $by;
        }
        return $this;
    }

    /**
     * Gets target key
     *
     * @return string
     */
    public function getTargetKey()
    {
        return $this->_targetKey;
    }

    /**
     * Sets target key
     *
     * @param  string $key
     * @return self
     */
    public function setTargetKey($key = null)
    {
        $this->_targetKey = trim($key);
        return $this;
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return CheckRightsTargetSpec
     */
    public function addRight($right)
    {
        $right = trim($right);
        if (!empty($right)) {
            $this->_rights[] = $right;
        }
        return $this;
    }

    /**
     * Sets rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(array $rights)
    {
        $this->_rights = [];
        foreach ($rights as $right) {
            $this->addRight($right);
        }
        return $this;
    }

    /**
     * Gets rights
     *
     * @return Sequence
     */
    public function getRights()
    {
        return $this->_rights;
    }
}
