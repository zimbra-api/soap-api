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

use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;

/**
 * ModifyContactAttr struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyContactSpec
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
     * ID - specified when modifying a contact
     * @var int
     */
    private $_id;

    /**
     * Comma-separated list of tag names
     * @var string
     */
    private $_tn;

    /**
     * Constructor method for ModifyContactSpec
     * @param array $a
     * @param array $m
     * @param int $id
     * @param string $tn
     * @return self
     */
    public function __construct(
        array $a = array(),
        array $m = array(),
        $id = null,
        $tn = null
    )
    {
        $this->_a = new TypedSequence('Zimbra\Soap\Struct\ModifyContactAttr', $a);
        $this->_m = new TypedSequence('Zimbra\Soap\Struct\ModifyContactGroupMember', $m);
        if(null !== $id)
        {
            $this->_id = (int) $id;
        }
        $this->_tn = trim($tn);
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
            return $this->_id;
        }
        $this->_id = (int) $id;
        return $this;
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
            return $this->_tn;
        }
        $this->_tn = trim($tn);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'cn')
    {
        $name = !empty($name) ? $name : 'cn';
        $arr = array();
        if(count($this->_a))
        {
            $arr['a'] = array();
            foreach ($this->_a as $a)
            {
                $attrArr = $a->toArray('a');
                $arr['a'][] = $attrArr['a'];
            }
        }
        if(count($this->_m))
        {
            $arr['m'] = array();
            foreach ($this->_m as $m)
            {
                $mArr = $m->toArray('m');
                $arr['m'][] = $mArr['m'];
            }
        }
        if(is_int($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_tn))
        {
            $arr['tn'] = $this->_tn;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'cn')
    {
        $name = !empty($name) ? $name : 'cn';
        $xml = new SimpleXML('<'.$name.' />');
        foreach ($this->_a as $a)
        {
            $xml->append($a->toXml('a'));
        }
        foreach ($this->_m as $m)
        {
            $xml->append($m->toXml('m'));
        }
        if(is_int($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_tn))
        {
            $xml->addAttribute('tn', $this->_tn);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
