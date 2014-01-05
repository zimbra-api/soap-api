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

use Zimbra\Soap\Enum\GranteeType;
use Zimbra\Utils\SimpleXML;

/**
 * ActionGrantSelector struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ActionGrantSelector
{
    /**
     * Rights
     * @var string
     */
    private $_perm;

    /**
     * Grantee Type - usr | grp | cos | dom | all | pub | guest | key
     * @var GranteeType
     */
    private $_gt;

    /**
     * Zimbra ID
     * @var string
     */
    private $_zid;

    /**
     * Name or email address of the grantee.
     * Not present if {grantee-type} is "all" or "pub"
     * @var string
     */
    private $_d;

    /**
     * Retained for backwards compatibility.
     * Old way of specifying password
     * @var string
     */
    private $_args;

    /**
     * Optional argument.
     * Password when {grantee-type} is "gst" (not yet supported)
     * @var string
     */
    private $_pw;

    /**
     * Optional argument.
     * Access key when {grantee-type} is "key"
     * @var string
     */
    private $_key;

    /**
     * Constructor method for ActionGrantSelector
     * @param string $perm
     * @param GranteeType $gt
     * @param string $zid
     * @param string $d
     * @param string $args
     * @param string $pw
     * @param string $key
     * @return self
     */
    public function __construct(
        $perm,
        GranteeType $gt,
        $zid = null,
        $d = null,
        $args = null,
        $pw = null,
        $key = null
    )
    {
        $this->_perm = trim($perm);
        $this->_gt = $gt;
        $this->_zid = trim($zid);
        $this->_d = trim($d);
        $this->_args = trim($args);
        $this->_pw = trim($pw);
        $this->_key = trim($key);
    }

    /**
     * Gets or sets perm
     *
     * @param  string $perm
     * @return string|self
     */
    public function perm($perm = null)
    {
        if(null === $perm)
        {
            return $this->_perm;
        }
        $this->_perm = trim($perm);
        return $this;
    }

    /**
     * Gets or sets gt
     *
     * @param  GranteeType $gt
     * @return GranteeType|self
     */
    public function gt(GranteeType $gt = null)
    {
        if(null === $gt)
        {
            return $this->_gt;
        }
        $this->_gt = $gt;
        return $this;
    }

    /**
     * Gets or sets zid
     *
     * @param  string $zid
     * @return string|self
     */
    public function zid($zid = null)
    {
        if(null === $zid)
        {
            return $this->_zid;
        }
        $this->_zid = trim($zid);
        return $this;
    }

    /**
     * Gets or sets d
     *
     * @param  string $d
     * @return string|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->_d;
        }
        $this->_d = trim($d);
        return $this;
    }

    /**
     * Gets or sets args
     *
     * @param  string $args
     * @return string|self
     */
    public function args($args = null)
    {
        if(null === $args)
        {
            return $this->_args;
        }
        $this->_args = trim($args);
        return $this;
    }

    /**
     * Gets or sets pw
     *
     * @param  string $pw
     * @return string|self
     */
    public function pw($pw = null)
    {
        if(null === $pw)
        {
            return $this->_pw;
        }
        $this->_pw = trim($pw);
        return $this;
    }

    /**
     * Gets or sets key
     *
     * @param  string $key
     * @return string|self
     */
    public function key($key = null)
    {
        if(null === $key)
        {
            return $this->_key;
        }
        $this->_key = trim($key);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'grant')
    {
        $name = !empty($name) ? $name : 'grant';
        $arr = array(
            'perm' => $this->_perm,
            'gt' => (string) $this->_gt,
        );
        if(!empty($this->_zid))
        {
            $arr['zid'] = $this->_zid;
        }
        if(!empty($this->_d))
        {
            $arr['d'] = $this->_d;
        }
        if(!empty($this->_args))
        {
            $arr['args'] = $this->_args;
        }
        if(!empty($this->_pw))
        {
            $arr['pw'] = $this->_pw;
        }
        if(!empty($this->_key))
        {
            $arr['key'] = $this->_key;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'grant')
    {
        $name = !empty($name) ? $name : 'grant';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('perm', $this->_perm)
            ->addAttribute('gt', (string) $this->_gt);
        if(!empty($this->_zid))
        {
            $xml->addAttribute('zid', $this->_zid);
        }
        if(!empty($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        if(!empty($this->_args))
        {
            $xml->addAttribute('args', $this->_args);
        }
        if(!empty($this->_pw))
        {
            $xml->addAttribute('pw', $this->_pw);
        }
        if(!empty($this->_key))
        {
            $xml->addAttribute('key', $this->_key);
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
