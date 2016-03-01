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

use PhpCollection\Sequence;

use Zimbra\Account\Struct\DistributionListSubscribeReq as Subscribe;
use Zimbra\Account\Struct\DistributionListGranteeSelector as Grantee;
use Zimbra\Account\Struct\DistributionListRightSpec as Right;
use Zimbra\Common\TypedSequence;
use Zimbra\Enum\Operation;
use Zimbra\Struct\Base;

/**
 * DistributionListAction struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListAction extends AccountKeyValuePairs
{
    /**
     * Group members
     * @var Sequence
     */
    private $_members;

    /**
     * The owner
     * Grantee sequence
     * @var TypedSequence
     */
    private $_owners;

    /**
     * The right
     * Right sequence
     * @var TypedSequence
     */
    private $_rights;

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
        $newName = null,
        Subscribe $subsReq = null,
        array $dlms = [],
        array $owners = [],
        array $rights = [],
        array $attrs = []
    )
    {
        parent::__construct($attrs);
        $this->setProperty('op', $op);
        $this->setChild('newName', trim($newName));

        if($subsReq instanceof Subscribe)
        {
			$this->setChild('subsReq', $subsReq);
        }
        $this->setMembers($dlms);
        $this->setOwners($owners);
        $this->setRights($rights);

        $this->on('before', function(Base $sender)
        {
            if($sender->getMembers()->count())
            {
                $sender->setChild('dlm', $sender->getMembers()->all());
            }
            if($sender->getOwners()->count())
            {
                $sender->setChild('owner', $sender->getOwners()->all());
            }
            if($sender->getRights()->count())
            {
                $sender->setChild('right', $sender->getRights()->all());
            }
        });
    }

    /**
     * Sets operation to perform
     *
     * @return Operation
     */
    public function getOp()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation to perform
     *
     * @param  Operation $op
     * @return self
     */
    public function setOp(Operation $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets new name
     *
     * @return string
     */
    public function getNewName()
    {
        return $this->getChild('newName');
    }

    /**
     * Sets new name
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName($newName)
    {
        return $this->setChild('newName', trim($newName));
    }

    /**
     * Gets subscription request
     *
     * @return Subscribe
     */
    public function getSubsReq()
    {
        return $this->getChild('subsReq');
    }

    /**
     * Sets subscription request
     *
     * @param  Subscribe $subsReq
     * @return self
     */
    public function setSubsReq(Subscribe $subsReq)
    {
        return $this->setChild('subsReq', $subsReq);
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
        if(!empty($member))
        {
            $this->_members->add($member);
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
        $this->_members = new Sequence($dlms);
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
        $this->_owners->add($owner);
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
        $this->_owners = new TypedSequence('Zimbra\Account\Struct\DistributionListGranteeSelector', $owners);
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
        $this->_rights->add($right);
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
        $this->_rights = new TypedSequence('Zimbra\Account\Struct\DistributionListRightSpec', $rights);
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

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
		return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
		return parent::toXml($name);
    }
}
