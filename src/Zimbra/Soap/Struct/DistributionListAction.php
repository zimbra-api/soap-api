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
     * @var string
     */
    private $_dlms;

    /**
     * New name
     * @var string
     */
    private $_newName;

    /**
     * The owner
     * Grantee array
     * @var array
     */
    private $_owners;

    /**
     * The right
     * Right array
     * @var array
     */
    private $_rights;

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
        $this->_dlms = new Sequence;
        $this->_dlms->addAll($dlms);

        $this->_owners = new TypedSequence('Zimbra\Soap\Struct\DistributionListGranteeSelector');
        $this->_owners->addAll($owners);

        $this->_rights = new TypedSequence('Zimbra\Soap\Struct\DistributionListRightSpec');
        $this->_rights->addAll($rights);
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
            $this->_dlms->add($dlm);
        }
        return $this;
    }

    /**
     * Gets member sequence
     *
     * @return Sequence
     */
    public function dlms()
    {
        return $this->_dlms;
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
     * Gets owner sequence
     *
     * @return Sequence
     */
    public function owners()
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
     * Gets right sequence
     *
     * @return Sequence
     */
    public function rights()
    {
        return $this->_rights;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
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
        if(count($this->_dlms))
        {
            $this->array['dlm'] = $this->_dlms->all();
        }
        if(count($this->_owners))
        {
            $this->array['owner'] = array();
            foreach ($this->_owners as $owner)
            {
                $ownerArr = $owner->toArray('owner');
                $this->array['owner'][] = $ownerArr['owner'];
            }
        }
        if(count($this->_rights))
        {
            $this->array['right'] = array();
            foreach ($this->_rights as $right)
            {
                $rightArr = $right->toArray();
                $this->array['right'][] = $rightArr['right'];
            }
        }
        return array('action' => parent::toArray());
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<action />');
        $xml->addAttribute('op', (string) $this->_op);
        if(!empty($this->_newName))
        {
            $xml->addChild('newName', $this->_newName);
        }
        if($this->_subsReq instanceof Subscribe)
        {
            $xml->append($this->_subsReq->toXml());
        }
        foreach ($this->_dlms as $dlm)
        {
            $xml->addChild('dlm', $dlm);
        }
        foreach ($this->_owners as $owner)
        {
            $xml->append($owner->toXml('owner'));
        }
        foreach ($this->_rights as $right)
        {
            $xml->append($right->toXml());
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
