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
 * CalOrganizer struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalOrganizer
{
    /**
     * Non-standard parameters (XPARAMs)
     * @var Sequence
     */
    private $_xparam;

    /**
     * Email address (without "MAILTO:")
     * @var string
     */
    private $_a;

    /**
     * URL - has same value as {email-address}. 
     * @var string
     */
    private $_url;

    /**
     * Friendly name - "CN" in iCalendar
     * @var string
     */
    private $_d;

    /**
     * iCalendar SENT-BY
     * @var string
     */
    private $_sentBy;

    /**
     * iCalendar DIR - Reference to a directory entry associated with the calendar user. the property.
     * @var string
     */
    private $_dir;

    /**
     * iCalendar LANGUAGE - As defined in RFC5646 * (e.g. "en-US")
     * @var string
     */
    private $_lang;

    /**
     * Constructor method for CalOrganizer
     * @param array $xparams
     * @param string $a
     * @param string $url
     * @param string $d
     * @param string $sentBy
     * @param string $dir
     * @param string $lang
     * @return self
     */
    public function __construct(
        array $xparams = array(),
        $a = null,
        $url = null,
        $d = null,
        $sentBy = null,
        $dir = null,
        $lang = null
    )
    {
        $this->_xparam = new TypedSequence('Zimbra\Soap\Struct\XParam', $xparams);

        $this->_a = trim($a);
        $this->_url = trim($url);
        $this->_d = trim($d);
        $this->_sentBy = trim($sentBy);
        $this->_dir = trim($dir);
        $this->_lang = trim($lang);
    }

    /**
     * Add xparam
     *
     * @param  XParam $xparam
     * @return self
     */
    public function addXParam(XParam $xparam)
    {
        $this->_xparam->add($xparam);
        return $this;
    }

    /**
     * Gets xparam sequence
     *
     * @return Sequence
     */
    public function xparam()
    {
        return $this->_xparam;
    }

    /**
     * Gets or sets email address
     *
     * @param  string $a email address
     * @return string|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->_a;
        }
        $this->_a = trim($a);
        return $this;
    }

    /**
     * Gets or sets url value
     *
     * @param  string $a url url value
     * @return string|self
     */
    public function url($url = null)
    {
        if(null === $url)
        {
            return $this->_url;
        }
        $this->_url = trim($url);
        return $this;
    }

    /**
     * Gets or sets friendly name
     *
     * @param  string $d friendly name
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
     * Gets or sets iCalendar SENT-BY
     *
     * @param  string $sentBy iCalendar SENT-BY
     * @return string|self
     */
    public function sentBy($sentBy = null)
    {
        if(null === $sentBy)
        {
            return $this->_sentBy;
        }
        $this->_sentBy = trim($sentBy);
        return $this;
    }

    /**
     * Gets or sets iCalendar DIR
     *
     * @param  string $dir iCalendar DIR
     * @return string|self
     */
    public function dir($dir = null)
    {
        if(null === $dir)
        {
            return $this->_dir;
        }
        $this->_dir = trim($dir);
        return $this;
    }

    /**
     * Gets or sets iCalendar LANGUAGE
     *
     * @param  string $lang iCalendar LANGUAGE
     * @return string|self
     */
    public function lang($lang = null)
    {
        if(null === $lang)
        {
            return $this->_lang;
        }
        $this->_lang = trim($lang);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'or')
    {
        $name = !empty($name) ? $name : 'or';
        $arr = array();
        if(!empty($this->_a))
        {
            $arr['a'] = $this->_a;
        }
        if(!empty($this->_url))
        {
            $arr['url'] = $this->_url;
        }
        if(!empty($this->_d))
        {
            $arr['d'] = $this->_d;
        }
        if(!empty($this->_sentBy))
        {
            $arr['sentBy'] = $this->_sentBy;
        }
        if(!empty($this->_dir))
        {
            $arr['dir'] = $this->_dir;
        }
        if(!empty($this->_lang))
        {
            $arr['lang'] = $this->_lang;
        }
        if(count($this->_xparam))
        {
            $arr['xparam'] = array();
            foreach ($this->_xparam as $xparam)
            {
                $xparamArr = $xparam->toArray();
                $arr['xparam'][] = $xparamArr['xparam'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'or')
    {
        $name = !empty($name) ? $name : 'or';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_a))
        {
            $xml->addAttribute('a', $this->_a);
        }
        if(!empty($this->_url))
        {
            $xml->addAttribute('url', $this->_url);
        }
        if(!empty($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        if(!empty($this->_sentBy))
        {
            $xml->addAttribute('sentBy', $this->_sentBy);
        }
        if(!empty($this->_dir))
        {
            $xml->addAttribute('dir', $this->_dir);
        }
        if(!empty($this->_lang))
        {
            $xml->addAttribute('lang', $this->_lang);
        }
        foreach ($this->_xparam as $xparam)
        {
            $xml->append($xparam->toXml());
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
