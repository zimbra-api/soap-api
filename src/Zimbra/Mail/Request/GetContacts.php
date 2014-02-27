<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\AttributeName;
use Zimbra\Struct\Id;

/**
 * GetContacts request class
 * Get contacts 
 * Contact group members are returned as <m> elements. 
 * If derefGroupMember is not set, group members are returned in the order they were inserted in the group. 
 * If derefGroupMember is set, group members are returned ordered by the "key" of member. 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetContacts extends Base
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
     * Constructor method for GetContacts
     * @param  array  $a
     * @param  array  $ma
     * @param  array  $cn
     * @param  bool   $sync
     * @param  string $l
     * @param  string $sortBy
     * @param  bool   $derefGroupMember
     * @param  bool   $returnHiddenAttrs
     * @param  int    $max 
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
        $this->_a = new TypedSequence('Zimbra\Struct\AttributeName', $a);
        $this->_ma = new TypedSequence('Zimbra\Struct\AttributeName', $ma);
        $this->_cn = new TypedSequence('Zimbra\Struct\Id', $cn);
        if(null !== $sync)
        {
            $this->property('sync', (bool) $sync);
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $sortBy)
        {
            $this->property('sortBy', trim($sortBy));
        }
        if(null !== $derefGroupMember)
        {
            $this->property('derefGroupMember', (bool) $derefGroupMember);
        }
        if(null !== $returnHiddenAttrs)
        {
            $this->property('returnHiddenAttrs', (bool) $returnHiddenAttrs);
        }
        if(null !== $maxMembers)
        {
            $this->property('maxMembers', (int) $maxMembers);
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->a()->count())
            {
                $sender->child('a', $sender->a()->all());
            }
            if($sender->ma()->count())
            {
                $sender->child('ma', $sender->ma()->all());
            }
            if($sender->cn()->count())
            {
                $sender->child('cn', $sender->cn()->all());
            }
        });
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
     * If set, return modified date (md) on contacts.
     *
     * @param  bool $sync
     * @return bool|self
     */
    public function sync($sync = null)
    {
        if(null === $sync)
        {
            return $this->property('sync');
        }
        return $this->property('sync', (bool) $sync);
    }

    /**
     * Get or set l
     * If is present, return only contacts in the specified folder.
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
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
            return $this->property('sortBy');
        }
        return $this->property('sortBy', trim($sortBy));
    }

    /**
     * Get or set derefGroupMember
     * If set, deref contact group members.
     * Contact members can be:
     *   for contact ref (type="C"): the fileAs field of the Contact
     *   for GAL ref (type="G"): email address of the GAL entry
     *   for inlined member (type="I"): the value
     *
     * @param  bool $derefGroupMember
     * @return bool|self
     */
    public function derefGroupMember($derefGroupMember = null)
    {
        if(null === $derefGroupMember)
        {
            return $this->property('derefGroupMember');
        }
        return $this->property('derefGroupMember', (bool) $derefGroupMember);
    }

    /**
     * Get or set returnHiddenAttrs
     * Whether to return contact hidden attrs defined in zimbraContactHiddenAttributes ignored if <a> is present.
     *
     * @param  bool $returnHiddenAttrs
     * @return bool|self
     */
    public function returnHiddenAttrs($returnHiddenAttrs = null)
    {
        if(null === $returnHiddenAttrs)
        {
            return $this->property('returnHiddenAttrs');
        }
        return $this->property('returnHiddenAttrs', (bool) $returnHiddenAttrs);
    }

    /**
     * Get or set maxMembers
     * Max members
     *
     * @param  int $maxMembers
     * @return int|self
     */
    public function maxMembers($maxMembers = null)
    {
        if(null === $maxMembers)
        {
            return $this->property('maxMembers');
        }
        return $this->property('maxMembers', (int) $maxMembers);
    }
}
