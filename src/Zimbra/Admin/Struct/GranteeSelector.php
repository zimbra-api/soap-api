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

use Zimbra\Enum\GranteeType;
use Zimbra\Enum\GranteeBy;

/**
 * GranteeSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="grantee")
 */
class GranteeSelector
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
     * Password for guest grantee or the access key for key grantee
     * @Accessor(getter="getSecret", setter="setSecret")
     * @SerializedName("secret")
     * @Type("string")
     * @XmlAttribute
     */
    private $_secret;

    /**
     * For GetGrantsRequest, selects whether to include grants granted to groups
     * @Accessor(getter="getAll", setter="setAll")
     * @SerializedName("all")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_all;

    /**
     * Constructor method for GranteeSelector
     * @param string $value The key used to secretentify the grantee
     * @param string $type Grantee type
     * @param string $by Grantee by
     * @param string $secret Password for guest grantee or the access key for key grantee For user right only
     * @param bool   $all For GetGrantsRequest, selects whether to include grants granted to groups the specified grantee belongs to. Default is 1 (true)
     * @return self
     */
    public function __construct(
        $value = null,
        $type = null,
        $by = null,
        $secret = null,
        $all = null
    )
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $type) {
            $this->setType($type);
        }
        if (NULL !== $by) {
            $this->setBy($by);
        }
        if (NULL !== $secret) {
            $this->setSecret($secret);
        }
        if (NULL !== $all) {
            $this->setAll($all);
        }
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
        if (GranteeType::has(trim($type))) {
            $this->_type = $type;
        }
        return $this;
    }

    /**
     * Gets by enum
     *
     * @return string
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
        if (GranteeBy::has(trim($by))) {
            $this->_by = $by;
        }
        return $this;
    }

    /**
     * Gets password for guest grantee or the access key for key grantee
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->_secret;
    }

    /**
     * Sets password for guest grantee or the access key for key grantee
     *
     * @param  string $secret
     * @return self
     */
    public function setSecret($secret)
    {
        $this->_secret = trim($secret);
        return $this;
    }

    /**
     * Gets all flag
     *
     * @return bool
     */
    public function getAll()
    {
        return $this->_all;
    }

    /**
     * Sets all flag
     *
     * @param  bool $all
     * @return self
     */
    public function setAll($all)
    {
        $this->_all = (bool) $all;
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
