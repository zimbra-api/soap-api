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

use Zimbra\Soap\Enum\ContentType;
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
     * @var ContentType
     */
    private $_type;

    /**
     * Constructor method for signatureContent
     * @param string $value
     * @param ContentType $type
     * @return self
     */
    public function __construct($value = null, ContentType $type = null)
    {
        $this->_value = trim($value);
        if($type instanceof ContentType)
        {
            $this->_type = $type;
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
     * @param  ContentType $type
     * @return ContentType|self
     */
    public function type(ContentType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = $type;
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
        if($this->_type instanceof ContentType)
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
        if($this->_type instanceof ContentType)
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
