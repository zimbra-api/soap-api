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
use Zimbra\Common\Enum\{ActionGrantRight, GranteeType};

/**
 * ActionGrantSelector struct class
 * Input for grants
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ActionGrantSelector
{
    /**
     * Rights - Some combination of (r)ead, (w)rite, (i)nsert, (d)elete, (a)dminister, workflow action (x), view (p)rivate, view (f)reebusy, (c)reate subfolder
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("perm")
     * @Type("string")
     * @XmlAttribute
     */
    private $rights;

    /**
     * Grantee Type - usr | grp | cos | dom | all | pub | guest | key
     * @Accessor(getter="getGrantType", setter="setGrantType")
     * @SerializedName("gt")
     * @Type("Zimbra\Common\Enum\GranteeType")
     * @XmlAttribute
     */
    private GranteeType $grantType;

    /**
     * Zimbra ID
     * @Accessor(getter="getZimbraId", setter="setZimbraId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     */
    private $zimbraId;

    /**
     * Name or email address of the grantee. Not present if granteeType is all or pub
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $displayName;

    /**
     * Retained for backwards compatibility.  Old way of specifying password
     * @Accessor(getter="getArgs", setter="setArgs")
     * @SerializedName("args")
     * @Type("string")
     * @XmlAttribute
     */
    private $args;

    /**
     * Password when granteeType is gst
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("pw")
     * @Type("string")
     * @XmlAttribute
     */
    private $password;

    /**
     * Optional argument.  Access key when granteeType is "key"
     * @Accessor(getter="getAccessKey", setter="setAccessKey")
     * @SerializedName("key")
     * @Type("string")
     * @XmlAttribute
     */
    private $accessKey;

    /**
     * Constructor method for ActionGrantSelector
     * @param string $rights
     * @param GranteeType $grantType
     * @param string $zimbraId
     * @param string $displayName
     * @param string $args
     * @param string $password
     * @param string $accessKey
     * @return self
     */
    public function __construct(
        string $rights = '',
        ?GranteeType $grantType = NULL,
        ?string $zimbraId = NULL,
        ?string $displayName = NULL,
        ?string $args = NULL,
        ?string $password = NULL,
        ?string $accessKey = NULL
    )
    {
        $this->setRights($rights)
             ->setGrantType($grantType ?? GranteeType::ALL());
        if (NULL !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if (NULL !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (NULL !== $args) {
            $this->setArgs($args);
        }
        if (NULL !== $password) {
            $this->setPassword($password);
        }
        if (NULL !== $accessKey) {
            $this->setAccessKey($accessKey);
        }
    }

    /**
     * Gets rights
     *
     * @return string
     */
    public function getRights(): string
    {
        return $this->rights;
    }

    /**
     * Sets rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(string $rights): self
    {
        $validRights = [];
        foreach (explode(',', $rights) as $right) {
            if (ActionGrantRight::isValid($right) && !in_array($right, $validRights)) {
                $validRights[] = $right;
            }
        }
        $this->rights = implode(',', $validRights);
        return $this;
    }

    /**
     * Gets the type of grantee
     *
     * @return GranteeType
     */
    public function getGrantType(): GranteeType
    {
        return $this->grantType;
    }

    /**
     * Sets the type of grantee
     *
     * @param  GranteeType $grantType
     * @return self
     */
    public function setGrantType(GranteeType $grantType): self
    {
        $this->grantType = $grantType;
        return $this;
    }

    /**
     * Gets Zimbra Id
     *
     * @return string
     */
    public function getZimbraId(): ?string
    {
        return $this->zimbraId;
    }

    /**
     * Sets Zimbra Id
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
     * Gets display name
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Sets display name
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
     * Gets access key
     *
     * @return string
     */
    public function getAccessKey(): ?string
    {
        return $this->accessKey;
    }

    /**
     * Sets access key
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
     * Gets password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets password
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
     * Gets args
     *
     * @return string
     */
    public function getArgs(): ?string
    {
        return $this->args;
    }

    /**
     * Sets args
     *
     * @param  string $args
     * @return self
     */
    public function setArgs(string $args): self
    {
        $this->args = $args;
        return $this;
    }
}