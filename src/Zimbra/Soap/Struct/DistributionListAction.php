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
     * @var string
     */
    private $_op;

    /**
     * Group members
     * @var string
     */
    private $_dlms = array();

    /**
     * New name
     * @var string
     */
    private $_newName;

    /**
     * The owner
     * LDGranteeSelector array
     * @var array
     */
    private $_owners = array();

    /**
     * The right
     * DistributionListRightSpec array
     * @var array
     */
    private $_rights = array();

    /**
     * Subscription request 
     * @var DistributionListSubscribeReq
     */
    private $_subsReq;

    /**
     * Attributes
     * KeyValuePair array
     * @var array
     */
    private $_attrs = array();

    /**
     * Constructor method for DistributionListAction
     * @param string $op
     * @param string $newName
     * @param DistributionListSubscribeReq $subsReq
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
        array $dlms = array(),
        array $owners = array(),
        array $rights = array(),
        array $attrs = array()
    )
    {
        parent::__construct($attrs);
        if(Operation::isValid(trim($op)))
        {
            $this->_op = trim($op);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid operation');
        }
        $this->_newName = trim($newName);
        if($subsReq instanceof Subscribe)
        {
            $this->_subsReq = $subsReq;
        }
        $this->dlms($dlms);
        $this->owners($owners);
        $this->rights($rights);
    }

    /**
     * Gets or sets op
     *
     * @param  string $op
     * @return string|self
     */
    public function op($op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        if(Operation::isValid(trim($op)))
        {
            $this->_op = trim($op);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid operation');
        }
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
     * @param  DistributionListSubscribeReq $subsReq
     * @return DistributionListSubscribeReq|self
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
            $this->_dlms[] = $dlm;
        }
        return $this;
    }

    /**
     * Gets or sets member array
     *
     * @param  array $dlms
     * @return array|self
     */
    public function dlms(array $dlms = null)
    {
        if(null === $dlms)
        {
            return $this->_dlms;
        }
        $this->_dlms = array();
        foreach ($dlms as $dlm)
        {
            $dlm = trim($dlm);
            if(!empty($dlm))
            {
                $this->_dlms[] = $dlm;
            }
        }
        return $this;
    }

    /**
     * Add a owner
     *
     * @param  DistributionListGranteeSelector $owner
     * @return self
     */
    public function addOwner(Grantee $owner)
    {
        $this->_owners[] = $owner;
        return $this;
    }

    /**
     * Gets or sets owner array
     *
     * @param  array $owners
     * @return array|self
     */
    public function owners(array $owners = null)
    {
        if(null === $owners)
        {
            return $this->_owners;
        }
        $this->_owners = array();
        foreach ($owners as $owner)
        {
            if($owner instanceof Grantee)
            {
                $this->_owners[] = $owner;
            }
        }
        return $this;
    }

    /**
     * Add a right
     *
     * @param  DistributionListRightSpec $right
     * @return self
     */
    public function addRight(Right $right)
    {
        $this->_rights[] = $right;
        return $this;
    }

    /**
     * Gets or sets right array
     *
     * @param  array $rights
     * @return array|self
     */
    public function rights(array $rights = null)
    {
        if(null === $rights)
        {
            return $this->_rights;
        }
        $this->_rights = array();
        foreach ($rights as $right)
        {
            if($right instanceof Right)
            {
                $this->_rights[] = $right;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'op' => $this->_op,
        );
        if(!empty($this->_newName))
        {
            $this->array['newName'] = $this->_newName;
        }
        if($this->_subsReq instanceof DistributionListSubscribeReq)
        {
            $subsReqArr = $this->_subsReq->toArray();
            $this->array['subsReq'] = $subsReqArr['subsReq'];
        }
        if(count($this->_dlms))
        {
            $this->array['dlm'] = $this->_dlms;
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
        $xml->addAttribute('op', $this->_op);
        if(!empty($this->_newName))
        {
            $xml->addChild('newName', $this->_newName);
        }
        if($this->_subsReq instanceof DistributionListSubscribeReq)
        {
            $xml->append($this->_subsReq->toXml());
        }
        if(count($this->_dlms))
        {
            foreach ($this->_dlms as $dlm)
            {
                $xml->addChild('dlm', $dlm);
            }
        }
        if(count($this->_owners))
        {
            foreach ($this->_owners as $owner)
            {
                $xml->append($owner->toXml('owner'));
            }
        }
        if(count($this->_rights))
        {
            foreach ($this->_rights as $right)
            {
                $xml->append($right->toXml());
            }
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
