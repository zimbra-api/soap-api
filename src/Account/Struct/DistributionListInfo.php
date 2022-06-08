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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * DistributionListInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DistributionListInfo extends ObjectInfo
{
    /**
     * Flags whether user is the owner of the group.
     * Only returned if ownerOf on the request is 1 (true)
     * @Accessor(getter="isOwner", setter="setIsOwner")
     * @SerializedName("isOwner")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isOwner;

    /**
     * Flags whether user is a member of the group.
     * Only returned if memberOf on the request is 1 (true)
     * @Accessor(getter="isMember", setter="setIsMember")
     * @SerializedName("isMember")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isMember;

    /**
     * Flags whether the group is dynamic or not
     * @Accessor(getter="isDynamic", setter="setDynamic")
     * @SerializedName("dynamic")
     * @Type("bool")
     * @XmlAttribute
     */
    private $dynamic;

    /**
     * Group members
     * @Accessor(getter="getMembers", setter="setMembers")
     * @SerializedName("dlm")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "dlm")
     */
    private $members = [];

    /**
     * Group owners
     * @Accessor(getter="getOwners", setter="setOwners")
     * @SerializedName("owners")
     * @Type("array<Zimbra\Account\Struct\DistributionListGranteeInfo>")
     * @XmlList(inline = false, entry = "owner")
     */
    private $owners = [];

    /**
     * Rights
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("rights")
     * @Type("array<Zimbra\Account\Struct\DistributionListRightInfo>")
     * @XmlList(inline = false, entry = "right")
     */
    private $rights = [];

    /**
     * Constructor method for DistributionListInfo
     * @param string $name
     * @param string $id
     * @param array  $attrs
     * @param array  $members
     * @param array  $owners
     * @param array  $rights
     * @param bool   $isOwner
     * @param bool   $isMember
     * @param bool   $dynamic
     * @return self
     */
    public function __construct(
        string $name,
        string $id,
        array $attrs = [],
        array $members = [],
        array $owners = [],
        array $rights = [],
        ?bool $isOwner = NULL,
        ?bool $isMember = NULL,
        ?bool $dynamic = NULL
    )
    {
        parent::__construct($name, $id, $attrs);
        $this->setMembers($members)
             ->setOwners($owners)
             ->setRights($rights);
        if (NULL !== $isOwner) {
            $this->setIsOwner($isOwner);
        }
        if (NULL !== $isMember) {
            $this->setIsMember($isMember);
        }
        if (NULL !== $dynamic) {
            $this->setDynamic($dynamic);
        }
    }

    /**
     * Gets isOwner
     *
     * @return bool
     */
    public function isOwner(): ?bool
    {
        return $this->isOwner;
    }

    /**
     * Sets isOwner
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
     * Gets isMember
     *
     * @return bool
     */
    public function isMember(): ?bool
    {
        return $this->isMember;
    }

    /**
     * Sets isMember
     *
     * @param  bool $isMember
     * @return self
     */
    public function setIsMember(bool $isMember): self
    {
        $this->isMember = $isMember;
        return $this;
    }

    /**
     * Gets is dynamic
     *
     * @return bool
     */
    public function isDynamic(): ?bool
    {
        return $this->dynamic;
    }

    /**
     * Sets is dynamic
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
     * Gets members
     *
     * @return array
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Sets members
     *
     * @param  array $members
     * @return self
     */
    public function setMembers(array $members)
    {
        $this->members = array_unique(array_map(static fn ($member) => trim($member), $members));
        return $this;
    }

    /**
     * add member
     *
     * @param  string $member
     * @return self
     */
    public function addMember(string $member)
    {
        $member = trim($member);
        if (!in_array($member, $this->members)) {
            $this->members[] = $member;
        }
        return $this;
    }

    /**
     * Gets owners
     *
     * @return array
     */
    public function getOwners()
    {
        return $this->owners;
    }

    /**
     * Sets owners
     *
     * @param  array $owners
     * @return self
     */
    public function setOwners(array $owners)
    {
        $this->owners = array_filter($owners, static fn($owner) => $owner instanceof DistributionListGranteeInfo);
        return $this;
    }

    /**
     * Add owner
     *
     * @param  DistributionListGranteeInfo $owner
     * @return self
     */
    public function addOwner(DistributionListGranteeInfo $owner)
    {
        $this->owners[] = $owner;
        return $this;
    }

    /**
     * Gets rights
     *
     * @return array
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * Sets rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights)
    {
        $this->rights = array_filter($rights, static fn($right) => $right instanceof DistributionListRightInfo);
        return $this;
    }

    /**
     * Add right
     *
     * @param  DistributionListRightInfo $right
     * @return self
     */
    public function addRight(DistributionListRightInfo $right)
    {
        $this->rights[] = $right;
        return $this;
    }
}
