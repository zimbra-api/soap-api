<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AttributeName;
use Zimbra\Soap\Struct\Id;
use Zimbra\Utils\TypedSequence;

/**
 * GetContacts request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetContacts extends Request
{
    /**
     * Attrs - if present, return only the specified attribute(s).
     * @var TypedSequence<AttributeName>
     */
    private $_a;

    /**
     * If present, return only the specified attribute(s) for derefed members, applicable only when derefGroupMember is set.
     * @var TypedSequence<AttributeName>
     */
    private $_ma;

    /**
     * If present, only get the specified contact(s).
     * @var TypedSequence<Id>
     */
    private $_cn;

    /**
     * If set, return modified date (md) on contacts.
     * @var bool
     */
    private $_sync;

    /**
     * If is present, return only contacts in the specified folder.
     * @var string
     */
    private $_l;

    /**
     * Sort by
     * @var string
     */
    private $_sortBy;

    /**
     * If set, deref contact group members. 
     * @var bool
     */
    private $_derefGroupMember;

    /**
     * Whether to return contact hidden attrs defined in zimbraContactHiddenAttributes ignored if <a> is present.
     * @var bool
     */
    private $_returnHiddenAttrs;

    /**
     * Max members
     * @var int
     */
    private $_maxMembers;

    /**
     * Constructor method for GetContacts
     * @param  array $a
     * @param  array $ma
     * @param  array $cn
     * @return self
     */
    public function __construct(
        array $a = array(),
        array $ma = array(),
        array $cn = array(),
        $sync = null,
        $l = null,
        $sortBy = null,
        $derefGroupMember = null,
        $returnHiddenAttrs = null,
        $maxMembers = null
    )
    {
        parent::__construct();
        $this->_a = new TypedSequence('Zimbra\Soap\Struct\AttributeName', $a);
        $this->_ma = new TypedSequence('Zimbra\Soap\Struct\AttributeName', $ma);
        $this->_cn = new TypedSequence('Zimbra\Soap\Struct\Id', $cn);
        if(null !== $sync)
        {
            $this->_sync = (bool) $sync;
        }
        $this->_l = trim($l);
        $this->_sortBy = trim($sortBy);
        if(null !== $derefGroupMember)
        {
            $this->_derefGroupMember = (bool) $derefGroupMember;
        }
        if(null !== $returnHiddenAttrs)
        {
            $this->_returnHiddenAttrs = (bool) $returnHiddenAttrs;
        }
        if(null !== $maxMembers)
        {
            $this->_maxMembers = (int) $maxMembers;
        }
    }

    /**
     * Add an attribute
     *
     * @param  AttributeName $a
     * @return self
     */
    public function addA(AttributeName $a)
    {
        $this->_a->add($a);
        return $this;
    }

    /**
     * Gets attribute sequence
     *
     * @return Sequence
     */
    public function a()
    {
        return $this->_a;
    }

    /**
     * Add a member attribute
     *
     * @param  AttributeName $ma
     * @return self
     */
    public function addMa(AttributeName $ma)
    {
        $this->_ma->add($ma);
        return $this;
    }

    /**
     * Gets member attribute sequence
     *
     * @return Sequence
     */
    public function ma()
    {
        return $this->_ma;
    }

    /**
     * Add a contact
     *
     * @param  Id $cn
     * @return self
     */
    public function addCn(Id $cn)
    {
        $this->_cn->add($cn);
        return $this;
    }

    /**
     * Gets contact sequence
     *
     * @return Sequence
     */
    public function cn()
    {
        return $this->_cn;
    }

    /**
     * Get or set sync
     *
     * @param  bool $sync
     * @return bool|self
     */
    public function sync($sync = null)
    {
        if(null === $sync)
        {
            return $this->_sync;
        }
        $this->_sync = (bool) $sync;
        return $this;
    }

    /**
     * Get or set l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->_l;
        }
        $this->_l = trim($l);
        return $this;
    }

    /**
     * Get or set sortBy
     *
     * @param  string $sortBy
     * @return string|self
     */
    public function sortBy($sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->_sortBy;
        }
        $this->_sortBy = trim($sortBy);
        return $this;
    }

    /**
     * Get or set derefGroupMember
     *
     * @param  bool $derefGroupMember
     * @return bool|self
     */
    public function derefGroupMember($derefGroupMember = null)
    {
        if(null === $derefGroupMember)
        {
            return $this->_derefGroupMember;
        }
        $this->_derefGroupMember = (bool) $derefGroupMember;
        return $this;
    }

    /**
     * Get or set returnHiddenAttrs
     *
     * @param  bool $returnHiddenAttrs
     * @return bool|self
     */
    public function returnHiddenAttrs($returnHiddenAttrs = null)
    {
        if(null === $returnHiddenAttrs)
        {
            return $this->_returnHiddenAttrs;
        }
        $this->_returnHiddenAttrs = (bool) $returnHiddenAttrs;
        return $this;
    }

    /**
     * Get or set maxMembers
     *
     * @param  int $maxMembers
     * @return int|self
     */
    public function maxMembers($maxMembers = null)
    {
        if(null === $maxMembers)
        {
            return $this->_maxMembers;
        }
        $this->_maxMembers = (int) $maxMembers;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_sync))
        {
            $this->array['sync'] = $this->_sync ? 1 : 0;
        }
        if(!empty($this->_l))
        {
            $this->array['l'] = $this->_l;
        }
        if(!empty($this->_sortBy))
        {
            $this->array['sortBy'] = $this->_sortBy;
        }
        if(is_bool($this->_derefGroupMember))
        {
            $this->array['derefGroupMember'] = $this->_derefGroupMember ? 1 : 0;
        }
        if(is_bool($this->_returnHiddenAttrs))
        {
            $this->array['returnHiddenAttrs'] = $this->_returnHiddenAttrs ? 1 : 0;
        }
        if(is_int($this->_maxMembers))
        {
            $this->array['maxMembers'] = $this->_maxMembers;
        }
        if(count($this->_a))
        {
            $this->array['a'] = array();
            foreach ($this->_a as $a)
            {
                $aArr = $a->toArray('a');
                $this->array['a'][] = $aArr['a'];
            }
        }
        if(count($this->_ma))
        {
            $this->array['ma'] = array();
            foreach ($this->_ma as $ma)
            {
                $maArr = $ma->toArray('ma');
                $this->array['ma'][] = $maArr['ma'];
            }
        }
        if(count($this->_cn))
        {
            $this->array['cn'] = array();
            foreach ($this->_cn as $cn)
            {
                $cnArr = $cn->toArray('cn');
                $this->array['cn'][] = $cnArr['cn'];
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(is_bool($this->_sync))
        {
            $this->xml->addAttribute('sync', $this->_sync ? 1 : 0);
        }
        if(!empty($this->_l))
        {
            $this->xml->addAttribute('l', $this->_l);
        }
        if(!empty($this->_sortBy))
        {
            $this->xml->addAttribute('sortBy', $this->_sortBy);
        }
        if(is_bool($this->_derefGroupMember))
        {
            $this->xml->addAttribute('derefGroupMember', $this->_derefGroupMember ? 1 : 0);
        }
        if(is_bool($this->_returnHiddenAttrs))
        {
            $this->xml->addAttribute('returnHiddenAttrs', $this->_returnHiddenAttrs ? 1 : 0);
        }
        if(is_int($this->_maxMembers))
        {
            $this->xml->addAttribute('maxMembers', $this->_maxMembers);
        }
        foreach ($this->_a as $a)
        {
            $this->xml->append($a->toXml('a'));
        }
        foreach ($this->_ma as $ma)
        {
            $this->xml->append($ma->toXml('ma'));
        }
        foreach ($this->_cn as $cn)
        {
            $this->xml->append($cn->toXml('cn'));
        }
        return parent::toXml();
    }
}
