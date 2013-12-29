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
 * VCardInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VCardInfo
{
    /**
     * Inlined VCARD data
     * @var string
     */
    private $_value;

    /**
     * Message ID. Use in conjunction with {part-identifier}
     * @var string
     */
    private $_mid;

    /**
     * Part identifier. Use in conjunction with {message-id}
     * @var string
     */
    private $_part;

    /**
     * Uploaded attachment ID
     * @var string
     */
    private $_aid;

    /**
     * Constructor method for VCardInfo
     * @param string $value
     * @param string $mid
     * @param string $part
     * @param string $aid
     * @return self
     */
    public function __construct(
        $value,
        $mid = null,
        $part = null,
        $aid = null
    )
    {
        $this->_value = trim($value);
        $this->_mid = trim($mid);
        $this->_part = trim($part);
        $this->_aid = trim($aid);
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets or sets mid
     *
     * @param  string $mid
     * @return string|self
     */
    public function mid($mid = null)
    {
        if(null === $mid)
        {
            return $this->_mid;
        }
        $this->_mid = trim($mid);
        return $this;
    }

    /**
     * Gets or sets part
     *
     * @param  string $part
     * @return string|self
     */
    public function part($part = null)
    {
        if(null === $part)
        {
            return $this->_part;
        }
        $this->_part = trim($part);
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
    public function toArray($name = 'vcard')
    {
        $name = !empty($name) ? $name : 'vcard';
        $arr = array(
            '_' => $this->_value,
        );
        if(!empty($this->_mid))
        {
            $arr['mid'] = $this->_mid;
        }
        if(!empty($this->_part))
        {
            $arr['part'] = $this->_part;
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
    public function toXml($name = 'vcard')
    {
        $name = !empty($name) ? $name : 'vcard';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        if(!empty($this->_mid))
        {
            $xml->addAttribute('mid', $this->_mid);
        }
        if(!empty($this->_part))
        {
            $xml->addAttribute('part', $this->_part);
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
