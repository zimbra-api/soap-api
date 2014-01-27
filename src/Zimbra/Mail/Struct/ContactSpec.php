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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class ContactSpec extends Base
{
    /**
     * Contact attributes. Cannot specify <vcard> as well as these
     * @var TypedSequence<NewContactAttr>
     */
    private $_a;

    /**
     * Contact group members. Valid only if the contact being created is a contact group (has attribute type="group")
     * @var TypedSequence<NewContactGroupMember>
     */
    private $_m;

    /**
     * Constructor method for ContactSpec
     * @param  VCardInfo $vcard Either a vcard or attributes can be specified but not both.
     * @param  array $a Contact attributes. Cannot specify <vcard> as well as these
     * @param  array $m Contact group members. Valid only if the contact being created is a contact group (has attribute type="group")
     * @param  int $id ID - specified when modifying a contact
     * @param  string $l ID of folder to create contact in. Un-specified means use the default Contacts folder.
     * @param  string $t Tags - Comma separated list of integers. DEPRECATED - use "tn" instead
     * @param  string $tn Comma-separated list of id names
     * @return self
     */
    public function __construct(
        VCardInfo $vcard = null,
        array $a = array(),
        array $m = array(),
        $id = null,
        $l = null,
        $t = null,
        $tn = null
    )
    {
        parent::__construct();
        if($vcard instanceof VCardInfo)
        {
            $this->child('vcard', $vcard);
        }
        $this->_a = new TypedSequence('Zimbra\Mail\Struct\NewContactAttr', $a);
        $this->_m = new TypedSequence('Zimbra\Mail\Struct\NewContactGroupMember', $m);
        if(null !== $id)
        {
            $this->property('id', (int) $id);
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $t)
        {
            $this->property('t', trim($t));
        }
        if(null !== $tn)
        {
            $this->property('tn', trim($tn));
        }

        $this->addHook(function($sender)
        {
            $sender->child('a', $sender->a()->all());
            $sender->child('m', $sender->m()->all());
        });
    }

    /**
     * Gets or sets vcard
     *
     * @param  VCardInfo $vcard
     * @return VCardInfo|self
     */
    public function vcard(VCardInfo $vcard = null)
    {
        if(null === $vcard)
        {
            return $this->child('vcard');
        }
        return $this->child('vcard', $vcard);
    }

    /**
     * Add a contact attribute
     *
     * @param  NewContactAttr $attr
     * @return self
     */
    public function addA(NewContactAttr $a)
    {
        $this->_a->add($a);
        return $this;
    }

    /**
     * Gets contact attribute sequence
     *
     * @return Sequence
     */
    public function a()
    {
        return $this->_a;
    }

    /**
     * Add a contact group member
     *
     * @param  NewContactGroupMember $m
     * @return self
     */
    public function addM(NewContactGroupMember $m)
    {
        $this->_m->add($m);
        return $this;
    }

    /**
     * Gets contact group member sequence
     *
     * @return Sequence
     */
    public function m()
    {
        return $this->_m;
    }

    /**
     * Gets or sets id
     *
     * @param  int $id
     * @return int|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', (int) $id);
    }

    /**
     * Gets or sets l
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
     * Gets or sets t
     *
     * @param  string $t
     * @return string|self
     */
    public function t($t = null)
    {
        if(null === $t)
        {
            return $this->property('t');
        }
        return $this->property('t', trim($t));
    }

    /**
     * Gets or sets tn
     *
     * @param  string $tn
     * @return string|self
     */
    public function tn($tn = null)
    {
        if(null === $tn)
        {
            return $this->property('tn');
        }
        return $this->property('tn', trim($tn));
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
