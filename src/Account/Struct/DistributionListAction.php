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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Account\Struct\DistributionListSubscribeReq as Subscribe;
use Zimbra\Account\Struct\DistributionListGranteeSelector as Grantee;
use Zimbra\Account\Struct\DistributionListRightSpec as Right;
use Zimbra\Common\Enum\Operation;

/**
 * DistributionListAction class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListAction extends AccountKeyValuePairs
{
    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Enum<Zimbra\Common\Enum\Operation>")
     * @XmlAttribute
     *
     * @var Operation
     */
    #[Accessor(getter: "getOp", setter: "setOp")]
    #[SerializedName("op")]
    #[Type("Enum<Zimbra\Common\Enum\Operation>")]
    #[XmlAttribute]
    private Operation $op;

    /**
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("newName")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getNewName", setter: "setNewName")]
    #[SerializedName("newName")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $newName;

    /**
     * @Accessor(getter="getSubsReq", setter="setSubsReq")
     * @SerializedName("subsReq")
     * @Type("Zimbra\Account\Struct\DistributionListSubscribeReq")
     * @XmlElement(namespace="urn:zimbraAccount")
     *
     * @var Subscribe
     */
    #[Accessor(getter: "getSubsReq", setter: "setSubsReq")]
    #[SerializedName("subsReq")]
    #[Type(DistributionListSubscribeReq::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?Subscribe $subsReq;

    /**
     * @Accessor(getter="getMembers", setter="setMembers")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="dlm", namespace="urn:zimbraAccount")
     *
     * @var array
     */
    #[Accessor(getter: "getMembers", setter: "setMembers")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "dlm", namespace: "urn:zimbraAccount")]
    private $members = [];

    /**
     * @Accessor(getter="getOwners", setter="setOwners")
     * @Type("array<Zimbra\Account\Struct\DistributionListGranteeSelector>")
     * @XmlList(inline=true, entry="owner", namespace="urn:zimbraAccount")
     *
     * @var array
     */
    #[Accessor(getter: "getOwners", setter: "setOwners")]
    #[Type("array<Zimbra\Account\Struct\DistributionListGranteeSelector>")]
    #[XmlList(inline: true, entry: "owner", namespace: "urn:zimbraAccount")]
    private $owners = [];

    /**
     * @Accessor(getter="getRights", setter="setRights")
     * @Type("array<Zimbra\Account\Struct\DistributionListRightSpec>")
     * @XmlList(inline=true, entry="right", namespace="urn:zimbraAccount")
     *
     * @var array
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[Type("array<Zimbra\Account\Struct\DistributionListRightSpec>")]
    #[XmlList(inline: true, entry: "right", namespace: "urn:zimbraAccount")]
    private $rights = [];

    /**
     * Constructor
     *
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
        ?Operation $op = null,
        ?string $newName = null,
        ?Subscribe $subsReq = null,
        array $dlms = [],
        array $owners = [],
        array $rights = [],
        array $attrs = []
    ) {
        parent::__construct($attrs);
        $this->setOp($op ?? new Operation("grantRights"))
            ->setMembers($dlms)
            ->setOwners($owners)
            ->setRights($rights);
        $this->subsReq = $subsReq;
        if (null !== $newName) {
            $this->setNewName($newName);
        }
    }

    /**
     * Set operation to perform
     *
     * @return Operation
     */
    public function getOp(): Operation
    {
        return $this->op;
    }

    /**
     * Set operation to perform
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
     * Get new name
     *
     * @return string
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * Set new name
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
     * Get subscription request
     *
     * @return Subscribe
     */
    public function getSubsReq(): ?Subscribe
    {
        return $this->subsReq;
    }

    /**
     * Set subscription request
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
        if (!empty($member) && !in_array($member, $this->members)) {
            $this->members[] = $member;
        }
        return $this;
    }

    /**
     * Set members
     *
     * @param array $dlms
     * @return self
     */
    public function setMembers(array $dlms): self
    {
        $this->members = array_unique(
            array_map(static fn($dlm) => trim($dlm), $dlms)
        );
        return $this;
    }

    /**
     * Get members
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
     * Set owners
     *
     * @param array $owners
     * @return self
     */
    public function setOwners(array $owners): self
    {
        $this->owners = array_filter(
            $owners,
            static fn($owner) => $owner instanceof Grantee
        );
        return $this;
    }

    /**
     * Get owners
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
     * Set rights
     *
     * @param array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = array_filter(
            $rights,
            static fn($right) => $right instanceof Right
        );
        return $this;
    }

    /**
     * Get rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }
}
