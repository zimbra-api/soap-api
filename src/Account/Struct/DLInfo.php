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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * DLInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present name Nguyen Van Nguyen.
 */
class DLInfo extends ObjectInfo
{
    /**
     * ldap dn of the DL.
     *
     * @Accessor(getter="getRef", setter="setRef")
     * @SerializedName("ref")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getRef", setter: "setRef")]
    #[SerializedName("ref")]
    #[Type("string")]
    #[XmlAttribute]
    private $ref;

    /**
     * Display name of group
     *
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getDisplayName", setter: "setDisplayName")]
    #[SerializedName("d")]
    #[Type("string")]
    #[XmlAttribute]
    private $displayName;

    /**
     * Flags whether the group is dynamic or not
     *
     * @Accessor(getter="isDynamic", setter="setDynamic")
     * @SerializedName("dynamic")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isDynamic", setter: "setDynamic")]
    #[SerializedName("dynamic")]
    #[Type("bool")]
    #[XmlAttribute]
    private $dynamic;

    /**
     * Via
     * Present if the account is a member of the returned list because they are either a
     * direct or indirect member of another list that is a member of the returned list.
     *
     * @Accessor(getter="getVia", setter="setVia")
     * @SerializedName("via")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getVia", setter: "setVia")]
    #[SerializedName("via")]
    #[Type("string")]
    #[XmlAttribute]
    private $via;

    /**
     * Flags whether user is the owner of the group.
     * Only returned if ownerOf on the request is 1 (true)
     *
     * @Accessor(getter="isOwner", setter="setIsOwner")
     * @SerializedName("isOwner")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isOwner", setter: "setIsOwner")]
    #[SerializedName("isOwner")]
    #[Type("bool")]
    #[XmlAttribute]
    private $isOwner;

    /**
     * Flags whether user is a member of the group.
     * Only returned if memberOf on the request is 1 (true)
     *
     * @Accessor(getter="isMember", setter="setIsMember")
     * @SerializedName("isMember")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isMember", setter: "setIsMember")]
    #[SerializedName("isMember")]
    #[Type("bool")]
    #[XmlAttribute]
    private $isMember;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $ref
     * @param  string $name
     * @param  string $displayName
     * @param  bool   $dynamic
     * @param  string $via
     * @param  bool   $isOwner
     * @param  bool   $isMember
     * @param  array  $attrs
     * @return self
     */
    public function __construct(
        string $id = "",
        string $ref = "",
        string $name = "",
        ?string $displayName = null,
        ?bool $dynamic = null,
        ?string $via = null,
        ?bool $isOwner = null,
        ?bool $isMember = null,
        array $attrs = []
    ) {
        parent::__construct($name, $id, $attrs);
        $this->setRef($ref);
        if (null !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (null !== $dynamic) {
            $this->setDynamic($dynamic);
        }
        if (null !== $via) {
            $this->setVia($via);
        }
        if (null !== $isOwner) {
            $this->setIsOwner($isOwner);
        }
        if (null !== $isMember) {
            $this->setIsMember($isMember);
        }
    }

    /**
     * Get the ref
     *
     * @return string
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * Set the ref
     *
     * @param  string $ref
     * @return self
     */
    public function setRef(string $ref): self
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * Get the displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Set the displayName
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
     * Get is dynamic
     *
     * @return bool
     */
    public function isDynamic(): ?bool
    {
        return $this->dynamic;
    }

    /**
     * Set is dynamic
     *
     * @param  bool $dynamic
     * @return self
     */
    public function setDynamic(bool $dynamic): self
    {
        $this->dynamic = $dynamic;
        return $this;
    }

    /**
     * Get the via
     *
     * @return string
     */
    public function getVia(): string
    {
        return $this->via;
    }

    /**
     * Set the via
     *
     * @param  string $via
     * @return self
     */
    public function setVia(string $via): self
    {
        $this->via = $via;
        return $this;
    }

    /**
     * Get isOwner
     *
     * @return bool
     */
    public function isOwner(): ?bool
    {
        return $this->isOwner;
    }

    /**
     * Set isOwner
     *
     * @param  bool $isOwner
     * @return self
     */
    public function setIsOwner(bool $isOwner): self
    {
        $this->isOwner = $isOwner;
        return $this;
    }

    /**
     * Get isMember
     *
     * @return bool
     */
    public function isMember(): ?bool
    {
        return $this->isMember;
    }

    /**
     * Set isMember
     *
     * @param  bool $isMember
     * @return self
     */
    public function setIsMember(bool $isMember): self
    {
        $this->isMember = $isMember;
        return $this;
    }
}
