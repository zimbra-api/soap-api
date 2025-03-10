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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ActionGrantSelector
{
    /**
     * Rights - Some combination of (r)ead, (w)rite, (i)nsert, (d)elete, (a)dminister, workflow action (x), view (p)rivate, view (f)reebusy, (c)reate subfolder
     *
     * @var string
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[SerializedName("perm")]
    #[Type("string")]
    #[XmlAttribute]
    private string $rights;

    /**
     * Grantee Type - usr | grp | cos | dom | all | pub | guest | key
     *
     * @var GranteeType
     */
    #[Accessor(getter: "getGrantType", setter: "setGrantType")]
    #[SerializedName("gt")]
    #[XmlAttribute]
    private GranteeType $grantType;

    /**
     * Zimbra ID
     *
     * @var string
     */
    #[Accessor(getter: "getZimbraId", setter: "setZimbraId")]
    #[SerializedName("zid")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $zimbraId = null;

    /**
     * Name or email address of the grantee. Not present if granteeType is all or pub
     *
     * @var string
     */
    #[Accessor(getter: "getDisplayName", setter: "setDisplayName")]
    #[SerializedName("d")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $displayName = null;

    /**
     * Retained for backwards compatibility.  Old way of specifying password
     *
     * @var string
     */
    #[Accessor(getter: "getArgs", setter: "setArgs")]
    #[SerializedName("args")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $args = null;

    /**
     * Password when granteeType is gst
     *
     * @var string
     */
    #[Accessor(getter: "getPassword", setter: "setPassword")]
    #[SerializedName("pw")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $password = null;

    /**
     * Optional argument.  Access key when granteeType is "key"
     *
     * @var string
     */
    #[Accessor(getter: "getAccessKey", setter: "setAccessKey")]
    #[SerializedName("key")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $accessKey = null;

    /**
     * Constructor
     *
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
        string $rights = "",
        ?GranteeType $grantType = null,
        ?string $zimbraId = null,
        ?string $displayName = null,
        ?string $args = null,
        ?string $password = null,
        ?string $accessKey = null
    ) {
        $this->setRights($rights)->setGrantType($grantType ?? GranteeType::ALL);
        if (null !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if (null !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (null !== $args) {
            $this->setArgs($args);
        }
        if (null !== $password) {
            $this->setPassword($password);
        }
        if (null !== $accessKey) {
            $this->setAccessKey($accessKey);
        }
    }

    /**
     * Get rights
     *
     * @return string
     */
    public function getRights(): string
    {
        return $this->rights;
    }

    /**
     * Set rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(string $rights): self
    {
        $validRights = [];
        foreach (str_split($rights) as $right) {
            if (
                ActionGrantRight::tryFrom($right) &&
                !in_array($right, $validRights)
            ) {
                $validRights[] = $right;
            }
        }
        $this->rights = implode($validRights);
        return $this;
    }

    /**
     * Get the type of grantee
     *
     * @return GranteeType
     */
    public function getGrantType(): GranteeType
    {
        return $this->grantType;
    }

    /**
     * Set the type of grantee
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
     * @return self
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
     * Get args
     *
     * @return string
     */
    public function getArgs(): ?string
    {
        return $this->args;
    }

    /**
     * Set args
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
