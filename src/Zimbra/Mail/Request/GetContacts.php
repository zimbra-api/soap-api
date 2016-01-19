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
    private $_attributes;

    /**
     * If present, return only the specified attribute(s) for derefed members, applicable only when derefGroupMember is set.
     * @var TypedSequence<AttributeName>
     */
    private $_memberAttributes;

    /**
     * If present, only get the specified contact(s).
     * @var TypedSequence<Id>
     */
    private $_contacts;

    /**
     * Constructor method for GetContacts
     * @param  bool   $sync
     * @param  string $folderId
     * @param  string $sortBy
     * @param  bool   $derefGroupMember
     * @param  bool   $returnHiddenAttrs
     * @param  int    $maxMembers 
     * @param  array  $attributes
     * @param  array  $memberAttributes
     * @param  array  $contacts
     * @return self
     */
    public function __construct(
        $sync = null,
        $folderId = null,
        $sortBy = null,
        $derefGroupMember = null,
        $returnHiddenAttrs = null,
        $maxMembers = null,
        array $attributes = array(),
        array $memberAttributes = array(),
        array $contacts = array()
    )
    {
        parent::__construct();
        if(null !== $sync)
        {
            $this->setProperty('sync', (bool) $sync);
        }
        if(null !== $folderId)
        {
            $this->setProperty('l', trim($folderId));
        }
        if(null !== $sortBy)
        {
            $this->setProperty('sortBy', trim($sortBy));
        }
        if(null !== $derefGroupMember)
        {
            $this->setProperty('derefGroupMember', (bool) $derefGroupMember);
        }
        if(null !== $returnHiddenAttrs)
        {
            $this->setProperty('returnHiddenAttrs', (bool) $returnHiddenAttrs);
        }
        if(null !== $maxMembers)
        {
            $this->setProperty('maxMembers', (int) $maxMembers);
        }
        $this->setAttributes($attributes);
        $this->setMemberAttributes($memberAttributes);
        $this->setContacts($contacts);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAttributes()->count())
            {
                $sender->setChild('a', $sender->getAttributes()->all());
            }
            if($sender->getMemberAttributes()->count())
            {
                $sender->setChild('ma', $sender->getMemberAttributes()->all());
            }
            if($sender->getContacts()->count())
            {
                $sender->setChild('cn', $sender->getContacts()->all());
            }
        });
    }

    /**
     * Gets sync
     *
     * @return bool
     */
    public function getSync()
    {
        return $this->getProperty('sync');
    }

    /**
     * Sets sync
     *
     * @param  bool $sync
     * @return self
     */
    public function setSync($sync)
    {
        return $this->setProperty('sync', (bool) $sync);
    }

    /**
     * Gets folder Id
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder Id
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId($folderId)
    {
        return $this->setProperty('l', trim($folderId));
    }

    /**
     * Gets sort by
     *
     * @return string
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Sets sort by
     *
     * @param  string $sortBy
     * @return self
     */
    public function setSortBy($sortBy)
    {
        return $this->setProperty('sortBy', trim($sortBy));
    }

    /**
     * Gets deref contact group members
     *
     * @return bool
     */
    public function getDerefGroupMember()
    {
        return $this->getProperty('derefGroupMember');
    }

    /**
     * Sets deref contact group members
     *
     * @param  bool $derefGroupMember
     * @return self
     */
    public function setDerefGroupMember($derefGroupMember)
    {
        return $this->setProperty('derefGroupMember', (bool) $derefGroupMember);
    }

    /**
     * Gets return hidden attrs
     *
     * @return bool
     */
    public function getReturnHiddenAttrs()
    {
        return $this->getProperty('returnHiddenAttrs');
    }

    /**
     * Sets return hidden attrs
     *
     * @param  bool $returnHiddenAttrs
     * @return self
     */
    public function setReturnHiddenAttrs($returnHiddenAttrs)
    {
        return $this->setProperty('returnHiddenAttrs', (bool) $returnHiddenAttrs);
    }

    /**
     * Gets max members
     *
     * @return int
     */
    public function getMaxMembers()
    {
        return $this->getProperty('maxMembers');
    }

    /**
     * Sets max members
     *
     * @param  int $maxMembers
     * @return self
     */
    public function setMaxMembers($maxMembers)
    {
        return $this->setProperty('maxMembers', (int) $maxMembers);
    }

    /**
     * Add an attribute
     *
     * @param  AttributeName $attribute
     * @return self
     */
    public function addAttribute(AttributeName $attribute)
    {
        $this->_attributes->add($attribute);
        return $this;
    }

    /**
     * Sets attribute sequence
     *
     * @param  array $attributes
     * @return self
     */
    public function setAttributes(array $attributes)
    {
        $this->_attributes = new TypedSequence('Zimbra\Struct\AttributeName', $attributes);
        return $this;
    }

    /**
     * Gets attribute sequence
     *
     * @return Sequence
     */
    public function getAttributes()
    {
        return $this->_attributes;
    }

    /**
     * Add a member attribute
     *
     * @param  AttributeName $attribute
     * @return self
     */
    public function addMemberAttribute(AttributeName $attribute)
    {
        $this->_memberAttributes->add($attribute);
        return $this;
    }

    /**
     * Gets member attribute sequence
     *
     * @param  array $memberAttributes
     * @return self
     */
    public function setMemberAttributes(array $memberAttributes)
    {
        $this->_memberAttributes = new TypedSequence('Zimbra\Struct\AttributeName', $memberAttributes);
        return $this;
    }

    /**
     * Gets member attribute sequence
     *
     * @return Sequence
     */
    public function getMemberAttributes()
    {
        return $this->_memberAttributes;
    }

    /**
     * Add a contact
     *
     * @param  Id $cn
     * @return self
     */
    public function addContact(Id $contact)
    {
        $this->_contacts->add($contact);
        return $this;
    }

    /**
     * Sets contact sequence
     *
     * @param  array $contacts
     * @return self
     */
    public function setContacts(array $contacts)
    {
        $this->_contacts = new TypedSequence('Zimbra\Struct\Id', $contacts);
        return $this;
    }

    /**
     * Gets contact sequence
     *
     * @return Sequence
     */
    public function getContacts()
    {
        return $this->_contacts;
    }
}
