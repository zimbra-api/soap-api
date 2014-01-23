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
 * Message class
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
     * @var SimpleXML
     */
    private $_xml;

    /**
     * @var SimpleXML
     */
    private $_header;

    /**
     * @var string The xml namespace
     */
    private $_namespace;

    /**
     * @var string The soap version
     */
    private $_version;

    /**
     * Content types for SOAP versions.
     *
     * @var array(string=>string)
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
        $this->_xml = new SimpleXML($message);
        $this->_header = $this->_xml->addChild('Header')
                              ->addChild('context', null, 'urn:zimbra');
        $this->_body = $this->_xml->addChild('Body');
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
            return $this->_xml->children('env', true)->Body->children($this->_namespace);
        }
        unset($this->_xml->children('env', true)->Body);
        $child = $this->_xml->addChild('Body');
        $child->append($body, $this->_namespace);
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
            if(isset($this->_header->$name))
            {
                $this->_header->$name = $value;
            }
            else
            {
                $this->_header->addChild($name, $value);
            }
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
        $headers = array();
        foreach ($this->_header->children('urn', true) as $child)
        {
            $headers[$child->getName()] = (string) $child;
        }
        if(null === $name)
        {
            return $headers;
        }
        else
        {
            return isset($headers[$name]) ? $headers[$name] : null;
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
     * Return a well-formed XML string.
     *
     * @return string Xml string
     */
    public function __toString()
    {
        return trim($this->_xml->asXml());
    }
}
