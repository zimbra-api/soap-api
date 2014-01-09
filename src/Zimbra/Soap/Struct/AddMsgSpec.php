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

/**
 * AddMsgSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddMsgSpec
{
    /**
     * The entire message's content. (Omit if you specify an "aid" attribute.)
     * No <mp> elements should be provided within <m>.
     * @var string
     */
    private $_content;

    /**
     * Flags - (u)nread, (f)lagged, has (a)ttachment, (r)eplied, (s)ent by me, for(w)arded, (d)raft, deleted (x), (n)otification sent
     * @var string
     */
    private $_f;

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
     * Folder pathname (starts with '/') or folder ID
     * @var string
     */
    private $_l;

    /**
     * If set, then don't process iCal attachments. Default is unset.
     * @var bool
     */
    private $_noICal;

    /**
     * Time the message was originally received, in MILLISECONDS since the epoch
     * @var string
     */
    private $_d;

    /**
     * Uploaded MIME body ID - ID of message uploaded via FileUploadServlet
     * @var string
     */
    private $_aid;

    /**
     * Constructor method for AddMsgSpec
     * @param string $content
     * @param string $f
     * @param string $t
     * @param string $tn
     * @param string $l
     * @param bool   $noICal
     * @param string $d
     * @param string $aid
     * @return self
     */
    public function __construct(
        $content = null,
        $f = null,
        $t = null,
        $tn = null,
        $l = null,
        $noICal = null,
        $d = null,
        $aid = null
    )
    {
        $this->_content = trim($content);
        $this->_f = trim($f);
        $this->_t = trim($t);
        $this->_tn = trim($tn);
        $this->_l = trim($l);
        if(null !== $noICal)
        {
            $this->_noICal = (bool) $noICal;
        }
        $this->_d = trim($d);
        $this->_aid = trim($aid);
    }

    /**
     * Gets or sets content
     *
     * @param  string $content
     * @return string|self
     */
    public function content($content = null)
    {
        if(null === $content)
        {
            return $this->_content;
        }
        $this->_content = trim($content);
        return $this;
    }

    /**
     * Gets or sets f
     *
     * @param  string $f
     * @return string|self
     */
    public function f($f = null)
    {
        if(null === $f)
        {
            return $this->_f;
        }
        $this->_f = trim($f);
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
     * Gets or sets noICal
     *
     * @param  bool $noICal
     * @return bool|self
     */
    public function noICal($noICal = null)
    {
        if(null === $noICal)
        {
            return $this->_noICal;
        }
        $this->_noICal = (bool) $noICal;
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
     * Gets or sets aid
     *
     * @param  string $aid
     * @return string|self
     */
    public function aid($aid = null)
    {
        if(null === $aid)
        {
            return $this->_aid;
        }
        $this->_aid = trim($aid);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $arr = array();
        if(!empty($this->_content))
        {
            $arr['content'] = $this->_content;
        }
        if(!empty($this->_f))
        {
            $arr['f'] = $this->_f;
        }
        if(!empty($this->_t))
        {
            $arr['t'] = $this->_t;
        }
        if(!empty($this->_tn))
        {
            $arr['tn'] = $this->_tn;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(is_bool($this->_noICal))
        {
            $arr['noICal'] = $this->_noICal ? 1 : 0;
        }
        if(!empty($this->_d))
        {
            $arr['d'] = $this->_d;
        }
        if(!empty($this->_aid))
        {
            $arr['aid'] = $this->_aid;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_content))
        {
            $xml->addChild('content', $this->_content);
        }
        if(!empty($this->_f))
        {
            $xml->addAttribute('f', $this->_f);
        }
        if(!empty($this->_t))
        {
            $xml->addAttribute('t', $this->_t);
        }
        if(!empty($this->_tn))
        {
            $xml->addAttribute('tn', $this->_tn);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
        }
        if(is_bool($this->_noICal))
        {
            $xml->addAttribute('noICal', $this->_noICal ? 1 : 0);
        }
        if(!empty($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        if(!empty($this->_aid))
        {
            $xml->addAttribute('aid', $this->_aid);
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
