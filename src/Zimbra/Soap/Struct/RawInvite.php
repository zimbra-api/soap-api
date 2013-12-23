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
 * RawInvite struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RawInvite
{
    /**
     * UID
     * @var string
     */
    private $_uid;

    /**
     * summary
     * @var string
     */
    private $_summary;

    /**
     * Raw iCalendar data
     * @var string
     */
    private $_value;

    /**
     * Constructor method for RawInvite
     * @param  string $uid
     * @param  string $value
     * @param  string $summary
     * @return self
     */
    public function __construct($uid = null, $value = null, $summary = null)
    {
        $this->_uid = trim($uid);
        $this->_value = trim($value);
        $this->_summary = trim($summary);
    }

    /**
     * Gets or sets uid
     *
     * @param  string $uid
     * @return string|self
     */
    public function uid($uid = null)
    {
        if(null === $uid)
        {
            return $this->_uid;
        }
        $this->_uid = trim($uid);
        return $this;
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
     * Gets or sets summary
     *
     * @param  string $summary
     * @return string|self
     */
    public function summary($summary = null)
    {
        if(null === $summary)
        {
            return $this->_summary;
        }
        $this->_summary = trim($summary);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'content')
    {
        $name = !empty($name) ? $name : 'content';
        $arr = array(
            '_' => $this->_value,
        );
        if(!empty($this->_uid))
        {
            $arr['uid'] = $this->_uid;
        }
        if(!empty($this->_summary))
        {
            $arr['summary'] = $this->_summary;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $uid
     * @return SimpleXML
     */
    public function toXml($name = 'content')
    {
        $name = !empty($name) ? $name : 'content';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        if(!empty($this->_uid))
        {
            $xml->addAttribute('uid', $this->_uid);
        }
        if(!empty($this->_summary))
        {
            $xml->addAttribute('summary', $this->_summary);
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
