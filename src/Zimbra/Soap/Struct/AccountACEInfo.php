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

use Zimbra\Soap\Enum\AceRightType;
use Zimbra\Soap\Enum\GranteeType;
use Zimbra\Utils\SimpleXML;

/**
 * AccountACEInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AccountACEInfo
{
    /**
     * The type of grantee
     * @var GranteeType
     */
    private $_gt;

    /**
     * The right
     * @var AceRightType
     */
    private $_right;

    /**
     * Zimbra ID of the grantee
     * @var string
     */
    private $_zid;

    /**
     * Name or email address of the grantee.
     * @var string
     */
    private $_d;

    /**
     * Optional access key when {grantee-type} is "key"
     * @var string
     */
    private $_key;

    /**
     * Password when {grantee-type} is "gst" (not yet supported)
     * @var string
     */
    private $_pw;

    /**
     * "1" if a right is specifically denied or "0" (default)
     * @var boolean
     */
    private $_deny;

    /**
     * "1 (true)" if check grantee type or "0 (false)" (default)
     * @var boolean
     */
    private $_chkgt;

    /**
     * Constructor method for AccountACEInfo
     * @param GranteeType $gt
     * @param AceRightType $right
     * @param string $zid
     * @param string $d
     * @param string $key
     * @param string $pw
     * @param bool $deny
     * @param bool $chkgt
     * @return self
     */
    public function __construct(
        GranteeType $gt,
        AceRightType $right,
        $zid = null,
        $d = null,
        $key = null,
        $pw = null,
        $deny = null,
        $chkgt = null
    )
    {
        $this->_gt = $gt;
        $this->_right = $right;

        $this->_zid = trim($zid);
        $this->_d = trim($d);
        $this->_key = trim($key);
        $this->_pw = trim($pw);
        if(null !== $deny)
        {
            $this->_deny = (bool) $deny;
        }
        if(null !== $chkgt)
        {
            $this->_chkgt = (bool) $chkgt;
        }
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
     * Gets or sets right
     *
     * @param  AceRightType $right
     * @return AceRightType|self
     */
    public function right(AceRightType $right = null)
    {
        if(null === $right)
        {
            return $this->_right;
        }
        $this->_right = $right;
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
     * Gets or sets pw
     *
     * @param  bool $pw
     * @return bool|self
     */
    public function deny($deny = null)
    {
        if(null === $deny)
        {
            return $this->_deny;
        }
        $this->_deny = (bool) $deny;
        return $this;
    }

    /**
     * Gets or sets chkgt
     *
     * @param  bool $chkgt
     * @return bool|self
     */
    public function chkgt($chkgt = null)
    {
        if(null === $chkgt)
        {
            return $this->_chkgt;
        }
        $this->_chkgt = (bool) $chkgt;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'ace')
    {
        $name = !empty($name) ? $name : 'ace';
        $arr = array(
            'gt' => (string) $this->_gt,
            'right' => (string) $this->_right,
        );
        if(!empty($this->_zid))
        {
            $arr['zid'] = $this->_zid;
        }
        if(!empty($this->_d))
        {
            $arr['d'] = $this->_d;
        }
        if(!empty($this->_key))
        {
            $arr['key'] = $this->_key;
        }
        if(!empty($this->_pw))
        {
            $arr['pw'] = $this->_pw;
        }
        if(is_bool($this->_deny))
        {
            $arr['deny'] = $this->_deny ? 1 : 0;
        }
        if(is_bool($this->_chkgt))
        {
            $arr['chkgt'] = $this->_chkgt ? 1 : 0;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'ace')
    {
        $name = !empty($name) ? $name : 'ace';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('gt', (string) $this->_gt)
            ->addAttribute('right', (string) $this->_right);
        if(!empty($this->_zid))
        {
            $xml->addAttribute('zid', $this->_zid);
        }
        if(!empty($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        if(!empty($this->_key))
        {
            $xml->addAttribute('key', $this->_key);
        }
        if(!empty($this->_pw))
        {
            $xml->addAttribute('pw', $this->_pw);
        }
        if(is_bool($this->_deny))
        {
            $xml->addAttribute('deny', $this->_deny ? 1 : 0);
        }
        if(is_bool($this->_chkgt))
        {
            $xml->addAttribute('chkgt', $this->_chkgt ? 1 : 0);
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
