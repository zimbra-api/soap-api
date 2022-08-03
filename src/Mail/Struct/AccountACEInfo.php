<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\GranteeType;

/**
 * AccountACEinfo struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountACEinfo
{
    /**
     * @Accessor(getter="getGranteeType", setter="setGranteeType")
     * @SerializedName("gt")
     * @Type("Zimbra\Common\Enum\GranteeType")
     * @XmlAttribute
     */
    private GranteeType $granteeType;

    /**
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("string")
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
     * Constructor method for AccountACEinfo
     * 
     * @param GranteeType $granteeType
     * @param string $right
     * @param string $zimbraId
     * @param string $displayName
     * @param string $accessKey
     * @param string $password
     * @param bool $deny
     * @return self
     */
    public function __construct(
        ?GranteeType $granteeType = NULL,
        string $right = '',
        ?string $zimbraId = NULL,
        ?string $displayName = NULL,
        ?string $accessKey = NULL,
        ?string $password = NULL,
        ?bool $deny = NULL
    )
    {
        $this->setGranteeType($granteeType ?? GranteeType::ALL())
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
    }

    /**
     * Get the type of grantee
     *
     * @return GranteeType
     */
    public function getGranteeType(): GranteeType
    {
        return $this->granteeType;
    }

    /**
     * Set the type of grantee
     *
     * @param  GranteeType $granteeType
     * @return self
     */
    public function setGranteeType(GranteeType $granteeType): self
    {
        $this->granteeType = $granteeType;
        return $this;
    }

    /**
     * Get the right
     *
     * @return string
     */
    public function getRight(): string
    {
        return $this->right;
    }

    /**
     * Set the right
     *
     * @param  string $right
     * @return self
     */
    public function setRight(string $right): self
    {
        $this->right = $right;
        return $this;
    }

    /**
     * Get Zimbra Id
     *
     * @return string
     */
    public function getZimbraId(): ?string
    {
        return $this->zimbraId;
    }

    /**
     * Set Zimbra Id
     *
     * @param  string $zimbraId
     * @return self
     */
    public function setZimbraId(string $zimbraId): self
    {
        $this->zimbraId = $zimbraId;
        return $this;
    }

    /**
     * Get display name
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Set display name
     *
     * @param  string $displayName
     * @return string|self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Get access key
     *
     * @return string
     */
    public function getAccessKey(): ?string
    {
        return $this->accessKey;
    }

    /**
     * Set access key
     *
     * @param  string $accessKey
     * @return self
     */
    public function setAccessKey(string $accessKey): self
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get deny specifically of right
     *
     * @return bool
     */
    public function getDeny(): ?bool
    {
        return $this->deny;
    }

    /**
     * Set deny specifically of right
     *
     * @param  bool $deny
     * @return self
     */
    public function setDeny(bool $deny): self
    {
        $this->deny = $deny;
        return $this;
    }
}
