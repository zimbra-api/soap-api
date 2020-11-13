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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\{AceRightType, GranteeType};

/**
 * AccountACEInfo struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ace")
 */
class AccountACEInfo
{
    /**
     * @Accessor(getter="getGranteeType", setter="setGranteeType")
     * @SerializedName("gt")
     * @Type("Zimbra\Enum\GranteeType")
     * @XmlAttribute
     */
    private $granteeType;

    /**
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Enum\AceRightType")
     * @XmlAttribute
     */
    private $right;

    /**
     * @Accessor(getter="getZimbraId", setter="setZimbraId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     */
    private $zimbraId;

    /**
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $displayName;

    /**
     * @Accessor(getter="getAccessKey", setter="setAccessKey")
     * @SerializedName("key")
     * @Type("string")
     * @XmlAttribute
     */
    private $accessKey;

    /**
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("pw")
     * @Type("string")
     * @XmlAttribute
     */
    private $password;

    /**
     * @Accessor(getter="getDeny", setter="setDeny")
     * @SerializedName("deny")
     * @Type("bool")
     * @XmlAttribute
     */
    private $deny;

    /**
     * @Accessor(getter="getCheckGranteeType", setter="setCheckGranteeType")
     * @SerializedName("chkgt")
     * @Type("bool")
     * @XmlAttribute
     */
    private $checkGranteeType;

    /**
     * Constructor method for AccountACEInfo
     * @param GranteeType $granteeType
     * @param AceRightType $right
     * @param string $zimbraId
     * @param string $displayName
     * @param string $accessKey
     * @param string $password
     * @param bool $deny
     * @param bool $checkGranteeType
     * @return self
     */
    public function __construct(
        GranteeType $granteeType,
        AceRightType $right,
        $zimbraId = NULL,
        $displayName = NULL,
        $accessKey = NULL,
        $password = NULL,
        $deny = NULL,
        $checkGranteeType = NULL
    )
    {
        $this->setGranteeType($granteeType)
            ->setRight($right);
        if (NULL !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if (NULL !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (NULL !== $accessKey) {
            $this->setAccessKey($accessKey);
        }
        if (NULL !== $password) {
            $this->setPassword($password);
        }
        if (NULL !== $deny) {
            $this->setDeny($deny);
        }
        if (NULL !== $checkGranteeType) {
            $this->setCheckGranteeType($checkGranteeType);
        }
    }

    /**
     * Gets the type of grantee
     *
     * @return GranteeType
     */
    public function getGranteeType(): GranteeType
    {
        return $this->granteeType;
    }

    /**
     * Sets the type of grantee
     *
     * @param  GranteeType $granteeType
     * @return self
     */
    public function setGranteeType(GranteeType $granteeType)
    {
        $this->granteeType = $granteeType;
        return $this;
    }

    /**
     * Gets the right enum
     *
     * @return AceRightType
     */
    public function getRight(): AceRightType
    {
        return $this->right;
    }

    /**
     * Sets the right enum
     *
     * @param  AceRightType $right
     * @return self
     */
    public function setRight(AceRightType $right)
    {
        $this->right = $right;
        return $this;
    }

    /**
     * Gets Zimbra Id
     *
     * @return string
     */
    public function getZimbraId()
    {
        return $this->zimbraId;
    }

    /**
     * Sets Zimbra Id
     *
     * @param  string $zimbraId
     * @return self
     */
    public function setZimbraId($zimbraId)
    {
        $this->zimbraId = trim($zimbraId);
        return $this;
    }

    /**
     * Gets display name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Sets display name
     *
     * @param  string $displayName
     * @return string|self
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = trim($displayName);
        return $this;
    }

    /**
     * Gets access key
     *
     * @return string
     */
    public function getAccessKey()
    {
        return $this->accessKey;
    }

    /**
     * Sets access key
     *
     * @param  string $accessKey
     * @return self
     */
    public function setAccessKey($accessKey)
    {
        $this->accessKey = trim($accessKey);
        return $this;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = trim($password);
        return $this;
    }

    /**
     * Gets deny specifically of right
     *
     * @return bool
     */
    public function getDeny()
    {
        return $this->deny;
    }

    /**
     * Sets deny specifically of right
     *
     * @param  bool $deny
     * @return self
     */
    public function setDeny($deny)
    {
        $this->deny = (bool) $deny;
        return $this;
    }

    /**
     * Gets check grantee type status
     *
     * @return bool
     */
    public function getCheckGranteeType()
    {
        return $this->checkGranteeType;
    }

    /**
     * Sets check grantee type status
     *
     * @param  bool $checkGranteeType
     * @return self
     */
    public function setCheckGranteeType($checkGranteeType)
    {
        $this->checkGranteeType = (bool) $checkGranteeType;
        return $this;
    }
}
