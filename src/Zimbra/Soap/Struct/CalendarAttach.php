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
 * CalendarAttach struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalendarAttach
{
    /**
     * URI
     * @var string
     */
    private $_uri;

    /**
     * Content Type
     * @var string
     */
    private $_ct;

    /**
     * Value. Base64 encoded binary alarrm attach data
     * @var string
     */
    private $_value;

    /**
     * Constructor method for CalendarAttach
     * @param  string $uri
     * @param  string $ct
     * @param  string $value
     * @return self
     */
    public function __construct($uri = null, $ct = null, $value = null)
    {
        $this->_uri = trim($uri);
        $this->_ct = trim($ct);
        $this->_value = trim($value);
    }

    /**
     * Gets or sets uri
     *
     * @param  string $uri
     * @return string|self
     */
    public function uri($uri = null)
    {
        if(null === $uri)
        {
            return $this->_uri;
        }
        $this->_uri = trim($uri);
        return $this;
    }

    /**
     * Gets or sets ct
     *
     * @param  string $ct
     * @return string|self
     */
    public function ct($ct = null)
    {
        if(null === $ct)
        {
            return $this->_ct;
        }
        $this->_ct = trim($ct);
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
     * Returns the array representation of this class 
     *
     * @param  string $uri
     * @return array
     */
    public function toArray($uri = 'attach')
    {
        $uri = !empty($uri) ? $uri : 'attach';
        $arr = array(
            '_' => $this->_value,
        );
        if(!empty($this->_uri))
        {
            $arr['uri'] = $this->_uri;
        }
        if(!empty($this->_ct))
        {
            $arr['ct'] = $this->_ct;
        }
        return array($uri => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $uri
     * @return SimpleXML
     */
    public function toXml($uri = 'attach')
    {
        $uri = !empty($uri) ? $uri : 'attach';
        $xml = new SimpleXML('<'.$uri.'>'.$this->_value.'</'.$uri.'>');
        if(!empty($this->_uri))
        {
            $xml->addAttribute('uri', $this->_uri);
        }
        if(!empty($this->_ct))
        {
            $xml->addAttribute('ct', $this->_ct);
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
