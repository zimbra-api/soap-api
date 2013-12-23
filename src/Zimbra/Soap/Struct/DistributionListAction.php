<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Struct\DistributionListSubscribeReq as Subscribe;
use Zimbra\Soap\Struct\DistributionListGranteeSelector as Grantee;
use Zimbra\Soap\Struct\DistributionListRightSpec as Right;
use Zimbra\Soap\Enum\Operation;
use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;
use PhpCollection\Sequence;

/**
 * DistributionListAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListAction extends AttrsImpl
{
    /**
     * Operation to perform.
     * @var Operation
     */
    private $_op;

    /**
     * Group members
     * @var Sequence
     */
    private $_dlm;

    /**
     * New name
     * @var string
     */
    private $_newName;

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
     * Subscription request 
     * @var Subscribe
     */
    private $_subsReq;

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
        $this->_op = $op;
        $this->_newName = trim($newName);
        if($subsReq instanceof Subscribe)
        {
            $this->_subsReq = $subsReq;
        }
        $this->_dlm = new Sequence;
        $this->_dlm->addAll($dlms);

        $this->_owner = new TypedSequence('Zimbra\Soap\Struct\DistributionListGranteeSelector');
        $this->_owner->addAll($owners);

        $this->_right = new TypedSequence('Zimbra\Soap\Struct\DistributionListRightSpec');
        $this->_right->addAll($rights);
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
            return $this->_op;
        }
        $this->_op = $op;
        return $this;
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
            return $this->_newName;
        }
        $this->_newName = trim($newName);
        return $this;
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
            return $this->_subsReq;
        }
        $this->_subsReq = $subsReq;
        return $this;
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
     * @return array
     */
    public function toArray($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $this->array = array(
            'op' => (string) $this->_op,
        );
        if(!empty($this->_newName))
        {
            $this->array['newName'] = $this->_newName;
        }
        if($this->_subsReq instanceof Subscribe)
        {
            $subsReqArr = $this->_subsReq->toArray();
            $this->array['subsReq'] = $subsReqArr['subsReq'];
        }
        if(count($this->_dlm))
        {
            $this->array['dlm'] = $this->_dlm->all();
        }
        if(count($this->_owner))
        {
            $this->array['owner'] = array();
            foreach ($this->_owner as $owner)
            {
                $ownerArr = $owner->toArray('owner');
                $this->array['owner'][] = $ownerArr['owner'];
            }
        }
        if(count($this->_right))
        {
            $this->array['right'] = array();
            foreach ($this->_right as $right)
            {
                $rightArr = $right->toArray();
                $this->array['right'][] = $rightArr['right'];
            }
        }
        return array($name => parent::toArray());
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('op', (string) $this->_op);
        if(!empty($this->_newName))
        {
            $xml->addChild('newName', $this->_newName);
        }
        if($this->_subsReq instanceof Subscribe)
        {
            $xml->append($this->_subsReq->toXml());
        }
        foreach ($this->_dlm as $dlm)
        {
            $xml->addChild('dlm', $dlm);
        }
        foreach ($this->_owner as $owner)
        {
            $xml->append($owner->toXml('owner'));
        }
        foreach ($this->_right as $right)
        {
            $xml->append($right->toXml('right'));
        }
        parent::appendAttrs($xml);
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
