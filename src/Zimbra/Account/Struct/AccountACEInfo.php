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
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;

/**
 * AccountACEInfo struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="ace")
 */
class AccountACEInfo
{
    /**
     * @Accessor(getter="getGranteeType", setter="setGranteeType")
     * @SerializedName("gt")
     * @Type("string")
     * @XmlAttribute
     */
    private $_granteeType;

    /**
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("string")
     * @XmlAttribute
     */
    private $_right;

    /**
     * @Accessor(getter="getZimbraId", setter="setZimbraId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     */
    private $_zimbraId;

    /**
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $_displayName;

    /**
     * @Accessor(getter="getAccessKey", setter="setAccessKey")
     * @SerializedName("key")
     * @Type("string")
     * @XmlAttribute
     */
    private $_accessKey;

    /**
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("pw")
     * @Type("string")
     * @XmlAttribute
     */
    private $_password;

    /**
     * @Accessor(getter="getDeny", setter="setDeny")
     * @SerializedName("deny")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_deny;

    /**
     * @Accessor(getter="getCheckGranteeType", setter="setCheckGranteeType")
     * @SerializedName("chkgt")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_checkGranteeType;

    /**
     * Constructor method for AccountACEInfo
     * @param string $granteeType
     * @param string $right
     * @param string $zimbraId
     * @param string $displayName
     * @param string $accessKey
     * @param string $password
     * @param bool $deny
     * @param bool $checkGranteeType
     * @return self
     */
    public function __construct(
        $granteeType,
        $right,
        $zimbraId = null,
        $displayName = null,
        $accessKey = null,
        $password = null,
        $deny = null,
        $checkGranteeType = null
    )
    {
        $this->setGranteeType($granteeType)
            ->setRight($right);
        if (null !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if (null !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (null !== $accessKey) {
            $this->setAccessKey($accessKey);
        }
        if (null !== $password) {
            $this->setPassword($password);
        }
        if (null !== $deny) {
            $this->setDeny($deny);
        }
        if (null !== $checkGranteeType) {
            $this->setCheckGranteeType($checkGranteeType);
        }
    }

    /**
     * Gets the type of grantee
     *
     * @return string
     */
    public function getGranteeType()
    {
        return $this->_granteeType;
    }

    /**
     * Sets the type of grantee
     *
     * @param  string $granteeType
     * @return self
     */
    public function setGranteeType($granteeType)
    {
        if (GranteeType::has(trim($granteeType))) {
            $this->_granteeType = $granteeType;
        }
        return $this;
    }

    /**
     * Gets the right enum
     *
     * @param  AceRightType $right
     * @return AceRightType
     */
    public function getRight()
    {
        return $this->_right;
    }

    /**
     * Sets the right enum
     *
     * @param  string $right
     * @return self
     */
    public function setRight($right)
    {
        if (AceRightType::has(trim($right))) {
            $this->_right = $right;
        }
        return $this;
    }

    /**
     * Gets Zimbra Id
     *
     * @return string
     */
    public function getZimbraId()
    {
        return $this->_zimbraId;
    }

    /**
     * Sets Zimbra Id
     *
     * @param  string $zimbraId
     * @return self
     */
    public function setZimbraId($zimbraId)
    {
        $this->_zimbraId = trim($zimbraId);
        return $this;
    }

    /**
     * Gets display name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->_displayName;
    }

    /**
     * Sets display name
     *
     * @param  string $displayName
     * @return string|self
     */
    public function setDisplayName($displayName)
    {
        $this->_displayName = trim($displayName);
        return $this;
    }

    /**
     * Gets access key
     *
     * @return string
     */
    public function getAccessKey()
    {
        return $this->_accessKey;
    }

    /**
     * Sets access key
     *
     * @param  string $accessKey
     * @return self
     */
    public function setAccessKey($accessKey)
    {
        $this->_accessKey = trim($accessKey);
        return $this;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->_password = trim($password);
        return $this;
    }

    /**
     * Gets deny specifically of right
     *
     * @return bool
     */
    public function getDeny()
    {
        return $this->_deny;
    }

    /**
     * Sets deny specifically of right
     *
     * @param  bool $deny
     * @return self
     */
    public function setDeny($deny)
    {
        $this->_deny = (bool) $deny;
        return $this;
    }

    /**
     * Gets check grantee type status
     *
     * @return bool
     */
    public function getCheckGranteeType()
    {
        return $this->_checkGranteeType;
    }

    /**
     * Sets check grantee type status
     *
     * @param  bool $checkGranteeType
     * @return self
     */
    public function setCheckGranteeType($checkGranteeType)
    {
        $this->_checkGranteeType = (bool) $checkGranteeType;
        return $this;
    }
}
