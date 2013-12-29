<?php
/**
 * This file is part of the Zimbra API} in PHP library.
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
 * ContactSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ContactSpec
{
    /**
     * Either a vcard or attributes can be specified but not both.
     * @var VCardInfo
     */
    private $_vcard;

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
     * ID - specified when modifying a contact
     * @var int
     */
    private $_id;

    /**
     * ID of folder to create contact in. Un-specified means use the default Contacts folder.
     * @var string
     */
    private $_l;

    /**
     * Tags - Comma separated list of integers. DEPRECATED - use "tn" instead
     * @var string
     */
    private $_t;

    /**
     * Comma-separated list of tag names
     * @var string
     */
    private $_tn;

    /**
     * Constructor method for ContactSpec
     * @param  VCardInfo $vcard
     * @param  array $a
     * @param  array $m
     * @param  int $id
     * @param  string $l
     * @param  string $t
     * @param  string $tn
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
        if($vcard instanceof VCardInfo)
        {
            $this->_vcard = $vcard;
        }
        $this->_a = new TypedSequence('Zimbra\Soap\Struct\NewContactAttr', $a);
        $this->_m = new TypedSequence('Zimbra\Soap\Struct\NewContactGroupMember', $m);
        if(null !== $id)
        {
            $this->_id = (int) $id;
        }
        $this->_l = trim($l);
        $this->_t = trim($t);
        $this->_tn = trim($tn);
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
            return $this->_vcard;
        }
        $this->_vcard = $vcard;
        return $this;
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
            return $this->_id;
        }
        $this->_id = (int) $id;
        return $this;
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
            return $this->_l;
        }
        $this->_l = trim($l);
        return $this;
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
            return $this->_t;
        }
        $this->_t = trim($t);
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
        if(is_int($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(!empty($this->_t))
        {
            $arr['t'] = $this->_t;
        }
        if(!empty($this->_tn))
        {
            $arr['tn'] = $this->_tn;
        }
        if($this->_vcard instanceof VCardInfo)
        {
            $arr += $this->_vcard->toArray('vcard');
        }
        if(count($this->_a))
        {
            $arr['a'] = array();
            foreach ($this->_a as $a)
            {
                $aArr = $a->toArray('a');
                $arr['a'][] = $aArr['a'];
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
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'cn')
    {
        $name = !empty($name) ? $name : 'cn';
        $xml = new SimpleXML('<'.$name.' />');
        if(is_int($this->_id))
        {
            $xml->addAttribute('id', (string) $this->_id);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', (string) $this->_l);
        }
        if(!empty($this->_t))
        {
            $xml->addAttribute('t', (string) $this->_t);
        }
        if(!empty($this->_tn))
        {
            $xml->addAttribute('tn', (string) $this->_tn);
        }
        if($this->_vcard instanceof VCardInfo)
        {
            $xml->append($this->_vcard->toXml('vcard'));
        }
        foreach ($this->_a as $a)
        {
            $xml->append($a->toXml('a'));
        }
        foreach ($this->_m as $m)
        {
            $xml->append($m->toXml('m'));
        }
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
