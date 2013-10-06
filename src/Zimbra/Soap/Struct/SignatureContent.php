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
 * SignatureContent class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SignatureContent
{
    /**
     * Content of the signature
     * @var string
     */
    private $_value;

    /**
     * Content Type - "text/plain" or "text/html"
     * @var string
     */
    private $_type;

    /**
     * Constructor method for signatureContent
     * @param string $value
     * @param string $type
     * @return self
     */
    public function __construct($value = null, $type = null)
    {
        $this->_value = trim($value);
        if(in_array(trim($type), array('text/plain', 'text/html')))
        {
            $this->_type = trim($type);
        }
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
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        if(in_array(trim($type), array('text/plain', 'text/html')))
        {
            $this->_type = trim($type);
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array();
        if(!empty($this->_type))
        {
            $arr['type'] = $this->_type;
        }
        if(!empty($this->_value))
        {
            $arr['_'] = $this->_value;
        }
        return array('content' => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<content>'.$this->_value.'</content>');
        if(!empty($this->_type))
        {
            $xml->addAttribute('type', (string) $this->_type);
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
