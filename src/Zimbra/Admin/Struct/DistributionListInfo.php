<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};

/**
 * DistributionListInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="dl")
 */
class DistributionListInfo extends AdminObjectInfo
{
    /**
     * Flags whether this is a dynamic distribution list or not
     * @Accessor(getter="isDynamic", setter="setDynamic")
     * @SerializedName("dynamic")
     * @Type("bool")
     * @XmlAttribute()
     */
    private $dynamic;

    /**
     * dl members
     * @Accessor(getter="getMembers", setter="setMembers")
     * @SerializedName("dlm")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "dlm")
     */
    private $members;

    /**
     * Owner information
     * @Accessor(getter="getOwners", setter="setOwners")
     * @SerializedName("owners")
     * @Type("array<Zimbra\Admin\Struct\GranteeInfo>")
     * @XmlList(inline = false, entry = "owner")
     */
    private $owners;

    /**
     * Constructor method for DistributionListInfo
     * @param string $name
     * @param string $id
     * @param array $members
     * @param array $attrs
     * @param array $owners
     * @param bool $dynamic
     * @return self
     */
    public function __construct($name, $id, array $members = [], array $attrs = [], array $owners = [], $dynamic = NULL)
    {
        parent::__construct($name, $id, $attrs);
        $this->setMembers($members)
             ->setOwners($owners);
        if (NULL !== $dynamic) {
            $this->setDynamic($dynamic);
        }
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
    public function setDynamic($dynamic): self
    {
        $this->dynamic = (bool) $dynamic;
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
        $this->members = [];
        foreach ($members as $member) {
            $this->addMember($member);
        }
        return $this;
    }

    /**
     * add member
     *
     * @param  string $member
     * @return self
     */
    public function addMember($member)
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
        $this->owners = [];
        foreach ($owners as $owner) {
            if ($owner instanceof GranteeInfo) {
                $this->owners[] = $owner;
            }
        }
        return $this;
    }

    /**
     * Add owner
     *
     * @param  GranteeInfo $owner
     * @return self
     */
    public function addOwner(GranteeInfo $owner)
    {
        $this->owners[] = $owner;
        return $this;
    }
}
