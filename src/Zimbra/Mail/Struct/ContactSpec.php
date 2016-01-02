<?php
/**
 * This file is part of the Zimbra API} in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * ContactSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ContactSpec extends Base
{
    /**
     * Contact attributes. Cannot specify <vcard> as well as these
     * @var TypedSequence<NewContactAttr>
     */
    private $_attrs;

    /**
     * Contact group members. Valid only if the contact being created is a contact group (has attribute type="group")
     * @var TypedSequence<NewContactGroupMember>
     */
    private $_members;

    /**
     * Constructor method for ContactSpec
     * @param  int $id ID - specified when modifying a contact
     * @param  string $folder ID of folder to create contact in. Un-specified means use the default Contacts folder.
     * @param  string $tags Tags - Comma separated list of integers. DEPRECATED - use "tn" instead
     * @param  string $tagNames Comma-separated list of id names
     * @param  VCardInfo $vcard Either a vcard or attributes can be specified but not both.
     * @param  array $attrs Contact attributes. Cannot specify <vcard> as well as these
     * @param  array $members Contact group members. Valid only if the contact being created is a contact group (has attribute type="group")
     * @return self
     */
    public function __construct(
        $id = null,
        $folder = null,
        $tags = null,
        $tagNames = null,
        VCardInfo $vcard = null,
        array $attrs = [],
        array $members = []
    )
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', (int) $id);
        }
        if(null !== $folder)
        {
            $this->setProperty('l', trim($folder));
        }
        if(null !== $tags)
        {
            $this->setProperty('t', trim($tags));
        }
        if(null !== $tagNames)
        {
            $this->setProperty('tn', trim($tagNames));
        }
        if($vcard instanceof VCardInfo)
        {
            $this->setChild('vcard', $vcard);
        }

        $this->setAttrs($attrs)
            ->setGroupMembers($members);
        $this->on('before', function(Base $sender)
        {
            if($sender->getAttrs()->count())
            {
                $sender->setChild('a', $sender->getAttrs()->all());
            }
            if($sender->getGroupMembers()->count())
            {
                $sender->setChild('m', $sender->getGroupMembers()->all());
            }
        });
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', (int) $id);
    }

    /**
     * Gets folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder($folder)
    {
        return $this->setProperty('l', trim($folder));
    }

    /**
     * Gets tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->getProperty('t');
    }

    /**
     * Sets tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags($tags)
    {
        return $this->setProperty('t', trim($tags));
    }

    /**
     * Gets tag names
     *
     * @return string
     */
    public function getTagNames()
    {
        return $this->getProperty('tn');
    }

    /**
     * Sets tag names
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames($tagNames)
    {
        return $this->setProperty('tn', trim($tagNames));
    }

    /**
     * Gets vcard
     *
     * @return VCardInfo
     */
    public function getVCard()
    {
        return $this->getChild('vcard');
    }

    /**
     * Sets vcard
     *
     * @param  VCardInfo $vcard
     * @return self
     */
    public function setVCard(VCardInfo $vcard)
    {
        return $this->setChild('vcard', $vcard);
    }

    /**
     * Add a contact attribute
     *
     * @param  NewContactAttr $attr
     * @return self
     */
    public function addAttr(NewContactAttr $attr)
    {
        $this->_attrs->add($attr);
        return $this;
    }

    /**
     * Sets contact attribute sequence
     *
     * @param  array $attrs
     * @return self
     */
    function setAttrs(array $attrs)
    {
        $this->_attrs = new TypedSequence('Zimbra\Mail\Struct\NewContactAttr', $attrs);
        return $this;
    }

    /**
     * Gets contact attribute sequence
     *
     * @return Sequence
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }

    /**
     * Add a contact group member
     *
     * @param  NewContactGroupMember $member
     * @return self
     */
    public function addGroupMember(NewContactGroupMember $member)
    {
        $this->_members->add($member);
        return $this;
    }

    /**
     * Sets contact group member sequence
     *
     * @param  array $members
     * @return self
     */
    function setGroupMembers(array $members)
    {
        $this->_members = new TypedSequence('Zimbra\Mail\Struct\NewContactGroupMember', $members);
        return $this;
    }

    /**
     * Gets contact group member sequence
     *
     * @return Sequence
     */
    public function getGroupMembers()
    {
        return $this->_members;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'cn')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'cn')
    {
        return parent::toXml($name);
    }
}
