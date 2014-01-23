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
    private $_dlm;

    /**
     * The owner
     * Grantee sequence
     * @var TypedSequence
     */
    private $_owner;

    /**
     * The right
     * Right sequence
     * @var TypedSequence
     */
    private $_right;

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
        array $dlms = array(),
        array $owners = array(),
        array $rights = array(),
        array $attrs = array()
    )
    {
        parent::__construct($attrs);
        $this->property('op', $op);
        $this->child('newName', trim($newName));

        if($subsReq instanceof Subscribe)
        {
			$this->child('subsReq', $subsReq);
        }
        $this->_dlm = new Sequence($dlms);
        $this->_owner = new TypedSequence('Zimbra\Account\Struct\DistributionListGranteeSelector', $owners);
        $this->_right = new TypedSequence('Zimbra\Account\Struct\DistributionListRightSpec', $rights);

        $this->addHook(function($sender)
        {
            $sender->child('dlm', $sender->dlm()->all());
            $sender->child('owner', $sender->owner()->all());
            $sender->child('right', $sender->right()->all());
        });
    }

    /**
     * Gets or sets op
     *
     * @param  Operation $op
     * @return Operation|self
     */
    public function op(Operation $op = null)
    {
        if(null === $op)
        {
			return $this->property('op');
        }
        return $this->property('op', $op);
    }

    /**
     * Gets or sets newName
     *
     * @param  string $newName
     * @return string|self
     */
    public function newName($newName = null)
    {
        if(null === $newName)
        {
			return $this->child('newName');
        }
        return $this->child('newName', trim($newName));
    }

    /**
     * Gets or sets subsReq
     *
     * @param  Subscribe $subsReq
     * @return Subscribe|self
     */
    public function subsReq(Subscribe $subsReq = null)
    {
        if(null === $subsReq)
        {
			return $this->child('subsReq');
        }
        return $this->child('subsReq', $subsReq);
    }

    /**
     * Add a member
     *
     * @param  string $dlm
     * @return self
     */
    public function addDlm($dlm)
    {
        $dlm = trim($dlm);
        if(!empty($dlm))
        {
            $this->_dlm->add($dlm);
        }
        return $this;
    }

    /**
     * Gets member sequence
     *
     * @return Sequence
     */
    public function dlm()
    {
        return $this->_dlm;
    }

    /**
     * Add a owner
     *
     * @param  Grantee $owner
     * @return self
     */
    public function addOwner(Grantee $owner)
    {
        $this->_owner->add($owner);
        return $this;
    }

    /**
     * Gets owner sequence
     *
     * @return Sequence
     */
    public function owner()
    {
        return $this->_owner;
    }

    /**
     * Add a right
     *
     * @param  Right $right
     * @return self
     */
    public function addRight(Right $right)
    {
        $this->_right->add($right);
        return $this;
    }

    /**
     * Gets right sequence
     *
     * @return Sequence
     */
    public function right()
    {
        return $this->_right;
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
