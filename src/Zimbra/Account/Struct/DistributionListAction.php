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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};
use Zimbra\Account\Struct\DistributionListSubscribeReq as Subscribe;
use Zimbra\Account\Struct\DistributionListGranteeSelector as Grantee;
use Zimbra\Account\Struct\DistributionListRightSpec as Right;
use Zimbra\Enum\Operation;

/**
 * DistributionListAction class
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="action")
 */
class DistributionListAction extends AccountKeyValuePairs
{
    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Zimbra\Enum\Operation")
     * @XmlAttribute
     */
    private $op;

    /**
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("newName")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $newName;

    /**
     * @Accessor(getter="getSubsReq", setter="setSubsReq")
     * @SerializedName("subsReq")
     * @Type("Zimbra\Account\Struct\DistributionListSubscribeReq")
     * @XmlElement
     */
    private $subsReq;

    /**
     * @Accessor(getter="getMembers", setter="setMembers")
     * @SerializedName("dlm")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "dlm")
     * @XmlElement(cdata = false)
     */
    private $members;

    /**
     * @Accessor(getter="getOwners", setter="setOwners")
     * @SerializedName("owner")
     * @Type("array<Zimbra\Account\Struct\DistributionListGranteeSelector>")
     * @XmlList(inline = true, entry = "owner")
     */
    private $owners;

    /**
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("right")
     * @Type("array<Zimbra\Account\Struct\DistributionListRightSpec>")
     * @XmlList(inline = true, entry = "right")
     */
    private $rights;

    /**
     * Constructor method for DistributionListAction
     * @param Operation $op
     * @param string $newName
     * @param Subscribe $subsReq
     * @param array $dlms
     * @param array $owners
     * @param array $rights
     * @param array $attrs
     * @return self
     */
    public function __construct(
        Operation $op,
        ?string $newName = NULL,
        ?Subscribe $subsReq = NULL,
        array $dlms = [],
        array $owners = [],
        array $rights = [],
        array $attrs = []
    )
    {
        parent::__construct($attrs);
        $this->setOp($op);
        if (NULL !== $newName) {
            $this->setNewName($newName);
        }
        if ($subsReq instanceof Subscribe) {
            $this->setSubsReq($subsReq);
        }
        $this->setMembers($dlms);
        $this->setOwners($owners);
        $this->setRights($rights);
    }

    /**
     * Sets operation to perform
     *
     * @return Operation
     */
    public function getOp(): Operation
    {
        return $this->op;
    }

    /**
     * Sets operation to perform
     *
     * @param  Operation $op
     * @return self
     */
    public function setOp(Operation $op): self
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Gets new name
     *
     * @return string
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * Sets new name
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName(string $newName): self
    {
        $this->newName = $newName;
        return $this;
    }

    /**
     * Gets subscription request
     *
     * @return Subscribe
     */
    public function getSubsReq(): ?Subscribe
    {
        return $this->subsReq;
    }

    /**
     * Sets subscription request
     *
     * @param  Subscribe $subsReq
     * @return self
     */
    public function setSubsReq(Subscribe $subsReq): self
    {
        $this->subsReq = $subsReq;
        return $this;
    }

    /**
     * Add a member
     *
     * @param  string $member
     * @return self
     */
    public function addMember($member): self
    {
        $member = trim($member);
        if (!empty($member)) {
            $this->members[] = $member;
        }
        return $this;
    }

    /**
     * Sets members
     *
     * @param array $dlms
     * @return self
     */
    public function setMembers(array $dlms): self
    {
        $this->members = [];
        foreach ($dlms as $dlm) {
            $this->addMember($dlm);
        }
        return $this;
    }

    /**
     * Gets members
     *
     * @return array
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * Add a owner
     *
     * @param  Grantee $owner
     * @return self
     */
    public function addOwner(Grantee $owner): self
    {
        $this->owners[] = $owner;
        return $this;
    }

    /**
     * Sets owners
     *
     * @param array $owners
     * @return self
     */
    public function setOwners(array $owners): self
    {
        $this->owners = [];
        foreach ($owners as $owner) {
            if ($owner instanceof Grantee) {
                $this->owners[] = $owner;
            }
        }
        return $this;
    }

    /**
     * Gets owners
     *
     * @return array
     */
    public function getOwners(): array
    {
        return $this->owners;
    }

    /**
     * Add a right
     *
     * @param  Right $right
     * @return self
     */
    public function addRight(Right $right): self
    {
        $this->rights[] = $right;
        return $this;
    }

    /**
     * Sets rights
     *
     * @param array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = [];
        foreach ($rights as $right) {
            if ($right instanceof Right) {
                $this->rights[] = $right;
            }
        }
        return $this;
    }

    /**
     * Gets rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }
}
