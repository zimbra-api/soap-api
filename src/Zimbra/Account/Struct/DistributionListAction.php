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
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Account\Struct\DistributionListSubscribeReq as Subscribe;
use Zimbra\Account\Struct\DistributionListGranteeSelector as Grantee;
use Zimbra\Account\Struct\DistributionListRightSpec as Right;
use Zimbra\Enum\Operation;

/**
 * DistributionListAction struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="action")
 */
class DistributionListAction extends AccountKeyValuePairs
{
    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     */
    private $_op;

    /**
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("newName")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $_newName;

    /**
     * @Accessor(getter="getSubsReq", setter="setSubsReq")
     * @SerializedName("subsReq")
     * @Type("Zimbra\Account\Struct\DistributionListSubscribeReq")
     * @XmlElement(cdata = false)
     */
    private $_subsReq;

    /**
     * @Accessor(getter="getMembers", setter="setMembers")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "dlm")
     * @XmlElement(cdata = false)
     */
    private $_members;

    /**
     * @Accessor(getter="getOwners", setter="setOwners")
     * @Type("array<Zimbra\Account\Struct\DistributionListGranteeSelector>")
     * @XmlList(inline = true, entry = "owner")
     */
    private $_owners;

    /**
     * @Accessor(getter="getRights", setter="setRights")
     * @Type("array<Zimbra\Account\Struct\DistributionListRightSpec>")
     * @XmlList(inline = true, entry = "right")
     */
    private $_rights;

    /**
     * Constructor method for DistributionListAction
     * @param string $op
     * @param string $newName
     * @param Subscribe $subsReq
     * @param array $dlms
     * @param array $owners
     * @param array $rights
     * @param array $attrs
     * @return self
     */
    public function __construct(
        $op,
        $newName = null,
        Subscribe $subsReq = null,
        array $dlms = [],
        array $owners = [],
        array $rights = [],
        array $attrs = []
    )
    {
        $this->setOp($op);

        if (null !== $newName) {
            $this->setNewName($newName);
        }
        if ($subsReq instanceof Subscribe) {
            $this->setSubsReq($subsReq);
        }
        $this->setMembers($dlms);
        $this->setOwners($owners);
        $this->setRights($rights);
        $this->setAttrs($attrs);
    }

    /**
     * Sets operation to perform
     *
     * @return string
     */
    public function getOp()
    {
        return $this->_op;
    }

    /**
     * Sets operation to perform
     *
     * @param  string $op
     * @return self
     */
    public function setOp($op)
    {
        if (Operation::has(trim($op))) {
            $this->_op = $op;
        }
        return $this;
    }

    /**
     * Gets new name
     *
     * @return string
     */
    public function getNewName()
    {
        return $this->_newName;
    }

    /**
     * Sets new name
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName($newName)
    {
        $this->_newName = trim($newName);
        return $this;
    }

    /**
     * Gets subscription request
     *
     * @return Subscribe
     */
    public function getSubsReq()
    {
        return $this->_subsReq;
    }

    /**
     * Sets subscription request
     *
     * @param  Subscribe $subsReq
     * @return self
     */
    public function setSubsReq(Subscribe $subsReq)
    {
        $this->_subsReq = $subsReq;
        return $this;
    }

    /**
     * Add a member
     *
     * @param  string $member
     * @return self
     */
    public function addMember($member)
    {
        $member = trim($member);
        if (!empty($member)) {
            $this->_members[] = $member;
        }
        return $this;
    }

    /**
     * Gets member sequence
     *
     * @param array $dlms
     * @return self
     */
    public function setMembers(array $dlms)
    {
        $this->_members = [];
        foreach ($dlms as $dlm) {
            $this->addMember($dlm);
        }
        return $this;
    }

    /**
     * Gets member sequence
     *
     * @return Sequence
     */
    public function getMembers()
    {
        return $this->_members;
    }

    /**
     * Add a owner
     *
     * @param  Grantee $owner
     * @return self
     */
    public function addOwner(Grantee $owner)
    {
        $this->_owners[] = $owner;
        return $this;
    }

    /**
     * Sets owner sequence
     *
     * @param array $owners
     * @return Sequence
     */
    public function setOwners(array $owners)
    {
        $this->_owners = [];
        foreach ($owners as $owner) {
            if ($owner instanceof Grantee) {
                $this->_owners[] = $owner;
            }
        }
        return $this;
    }

    /**
     * Gets owner sequence
     *
     * @return Sequence
     */
    public function getOwners()
    {
        return $this->_owners;
    }

    /**
     * Add a right
     *
     * @param  Right $right
     * @return self
     */
    public function addRight(Right $right)
    {
        $this->_rights[] = $right;
        return $this;
    }

    /**
     * Sets right sequence
     *
     * @param array $rights
     * @return Sequence
     */
    public function setRights(array $rights)
    {
        $this->_rights = [];
        foreach ($rights as $right) {
            if ($right instanceof Right) {
                $this->_rights[] = $right;
            }
        }
        return $this;
    }

    /**
     * Gets right sequence
     *
     * @return Sequence
     */
    public function getRights()
    {
        return $this->_rights;
    }
}
