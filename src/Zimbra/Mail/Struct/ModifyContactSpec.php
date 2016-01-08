<?php
/**
 * This file is part of the Zimbra API in PHP library.
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
 * ModifyContactAttr struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyContactSpec extends Base
{
    /**
     * Contact attributes. Cannot specify <vcard> as well as these
     * @var TypedSequence<ModifyContactAttr>
     */
    private $_attrs;

    /**
     * Contact group members.
     * Valid only if the contact being created is a contact group (has attribute type="group")
     * @var TypedSequence<ModifyContactGroupMember>
     */
    private $_members;

    /**
     * Constructor method for ModifyContactSpec
     * @param int $id ID - specified when modifying a contact
     * @param string $tn Comma-separated list of tag names
     * @param array $attrs Contact attributes. Cannot specify <vcard> as well as these
     * @param array $members Contact group members.
     * @return self
     */
    public function __construct(
        $id = null,
        $tn = null,
        array $attrs = [],
        array $members = []
    )
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', (int) $id);
        }
        if(null !== $tn)
        {
            $this->setProperty('tn', trim($tn));
        }

        $this->setAttrs($attrs)
            ->setMembers($members);
        $this->on('before', function(Base $sender)
        {
            if($sender->getAttrs()->count())
            {
                $sender->setChild('a', $sender->getAttrs()->all());
            }
            if($sender->getMembers()->count())
            {
                $sender->setChild('m', $sender->getMembers()->all());
            }
        });
    }

    /**
     * Add contact attribute
     *
     * @param  ModifyContactAttr $attr
     * @return self
     */
    public function addAttr(ModifyContactAttr $attr)
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
    public function setAttrs(array $attrs)
    {
        $this->_attrs = new TypedSequence('Zimbra\Mail\Struct\ModifyContactAttr', $attrs);
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
     * Add contact group member
     *
     * @param  ModifyContactGroupMember $member
     * @return self
     */
    public function addMember(ModifyContactGroupMember $member)
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
    public function setMembers(array $members)
    {
        $this->_members = new TypedSequence('Zimbra\Mail\Struct\ModifyContactGroupMember', $members);
        return $this;
    }

    /**
     * Gets contact group member sequence
     *
     * @return Sequence
     */
    public function getMembers()
    {
        return $this->_members;
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
     * Gets list of tag names
     *
     * @return string
     */
    public function getTagNames()
    {
        return $this->getProperty('tn');
    }

    /**
     * Sets list of tag names
     *
     * @param  string $tn
     * @return self
     */
    public function setTagNames($tn)
    {
        return $this->setProperty('tn', trim($tn));
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
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'cn')
    {
        return parent::toXml($name);
    }
}
