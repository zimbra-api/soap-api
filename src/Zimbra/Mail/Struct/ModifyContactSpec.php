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
    private $_a;

    /**
     * Contact group members.
     * Valid only if the contact being created is a contact group (has attribute type="group")
     * @var TypedSequence<ModifyContactGroupMember>
     */
    private $_m;

    /**
     * Constructor method for ModifyContactSpec
     * @param array $a Contact attributes. Cannot specify <vcard> as well as these
     * @param array $m Contact group members.
     * @param int $id ID - specified when modifying a contact
     * @param string $tn Comma-separated list of id names
     * @return self
     */
    public function __construct(
        array $a = array(),
        array $m = array(),
        $id = null,
        $tn = null
    )
    {
        parent::__construct();
        $this->_a = new TypedSequence('Zimbra\Mail\Struct\ModifyContactAttr', $a);
        $this->_m = new TypedSequence('Zimbra\Mail\Struct\ModifyContactGroupMember', $m);
        if(null !== $id)
        {
            $this->property('id', (int) $id);
        }
        if(null !== $tn)
        {
            $this->property('tn', trim($tn));
        }

        $this->addHook(function($sender)
        {
            if(count($sender->a()))
            {
                $sender->child('a', $sender->a()->all());
            }
            if(count($sender->m()))
            {
                $sender->child('m', $sender->m()->all());
            }
        });
    }

    /**
     * Add contact attribute
     *
     * @param  ModifyContactAttr $a
     * @return self
     */
    public function addA(ModifyContactAttr $a)
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
     * Add contact group member
     *
     * @param  ModifyContactGroupMember $m
     * @return self
     */
    public function addM(ModifyContactGroupMember $m)
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
