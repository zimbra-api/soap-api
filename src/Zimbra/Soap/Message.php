<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

use Zimbra\Common\SimpleXML;

/**
 * Soap message class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Message
{
    /**
     * Soap 1.1 const.
     */
    const SOAP_1_1 = '1.1';

    /**
     * Soap 1.2 const.
     */
    const SOAP_1_2 = '1.2';

    /**
     * Soap 1.1 namespace.
     */
    const NS_SOAP_1_1 = 'http://schemas.xmlsoap.org/soap/envelope';

    /**
     * Soap 1.2 namespace.
     */
    const NS_SOAP_1_2 = 'http://www.w3.org/2003/05/soap-envelope';

    /**
     * Soap headers
     * @var array
     */
    private $_headers = array();

    /**
     * The xml namespace
     * @var string
     */
    private $_namespace;

    /**
     * The soap version
     * @var string
     */
    private $_version;

    /**
     * Content types for SOAP versions.
     * @var array
     */
    static protected $contentTypeMap = array(
        '1.1' => 'text/xml; charset=utf-8',
        '1.2' => 'application/soap+xml; charset=utf-8'
    );

    /**
     * Message constructor
     *
     * @param string $namespace The xml namespace.
     * @return self
     */
    public function __construct($namespace = 'urn:zimbra', $version = self::SOAP_1_2)
    {
        $this->_namespace = empty($namespace) ? 'urn:zimbra' : $namespace;
        $this->_version = in_array($version, array(self::SOAP_1_2, self::SOAP_1_1)) ? $version : self::SOAP_1_2;
    }

    /**
     * Get or set body
     *
     * @param  SimpleXML $body
     * @return SimpleXML|self
     */
    public function body(SimpleXML $body = null)
    {
        if(null === $body)
        {
            return $this->_body;
        }
        $this->_body = $body;
        return $this;
    }

    /**
     * Add header.
     *
     * @param  string|array $name
     * @param  string $value
     * @return self
     */
    public function addHeader($name, $value = null)
    {
        if(is_array($name))
        {
            foreach ($name as $n => $v)
            {
                $this->addHeader($n, $v);
            }
        }
        else
        {
            $this->_headers[$name] = $value;
        }
        return $this;
    }

    /**
     * Get soap header.
     *
     * @param  string $name
     * @return string|array
     */
    public function header($name = null)
    {
        if(null === $name)
        {
            return $this->_headers;
        }
        else
        {
            return isset($this->_headers[$name]) ? $this->_headers[$name] : null;
        }
    }

    /**
     * Gets content type
     *
     * @param  string $version Soap version
     * @return string
     */
    public function contentType($version = null)
    {
        $version = in_array($version, array(self::SOAP_1_2, self::SOAP_1_1)) ? $version : $this->_version;
        return self::$contentTypeMap[$version];
    }

    /**
     * Gets soap version
     *
     * @param  string $version
     * @return string
     */
    public function version()
    {
        return $this->_version;
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $soapNamespace = ($this->_version === self::SOAP_1_2) ? self::NS_SOAP_1_2 : self::NS_SOAP_1_1;
        if($this->_namespace === 'urn:zimbra')
        {
            $message = 
                '<env:Envelope xmlns:env="'.$soapNamespace.'" '
                             .'xmlns:urn="urn:zimbra">'
                .'</env:Envelope>';
        }
        else
        {
            $message = 
                '<env:Envelope xmlns:env="'.$soapNamespace.'" '
                             .'xmlns:urn="urn:zimbra" '
                             .'xmlns:urn1="'.$this->_namespace.'">'
                .'</env:Envelope>';
        }
        $xml = new SimpleXML($message);
        if(count($this->_headers))
        {
            $header = $xml->addChild('Header')
                          ->addChild('context', null, 'urn:zimbra');
            foreach ($this->_headers as $name => $value)
            {
                $header->addChild($name, $value);
            }
        }
        $body = $xml->addChild('Body');
        $body->append($this->_body, $this->_namespace);
        return $xml;
    }

    /**
     * Return a well-formed XML string.
     *
     * @return string Xml string
     */
    public function __toString()
    {
        return trim($this->toXml()->asXml());
    }
}
