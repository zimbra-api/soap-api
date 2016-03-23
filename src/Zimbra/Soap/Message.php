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
    private $_headers = [];

    /**
     * Soap request
     * @var Request
     */
    private $_request;

    /**
     * Soap request body
     * @var SimpleXML
     */
    private $_body;

    /**
     * The xml namespaces
     * @var array
     */
    private $_namespaces = ['urn:zimbra'];

    /**
     * The soap version
     * @var string
     */
    private $_version;

    /**
     * Content types for SOAP versions.
     * @var array
     */
    static protected $contentTypeMap = [
        '1.1' => 'text/xml; charset=utf-8',
        '1.2' => 'application/soap+xml; charset=utf-8'
    ];

    /**
     * Message constructor
     *
     * @param string $version The soap version.
     * @return self
     */
    public function __construct($version = self::SOAP_1_2)
    {
        $this->_version = in_array($version, [self::SOAP_1_2, self::SOAP_1_1]) ? $version : self::SOAP_1_2;
    }

    /**
     * Gets soap request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Set soap request
     *
     * @param  Request $request
     * @return self
     */
    public function setRequest(Request $request)
    {
        $this->_request = $request;
        $this->addNamespace($this->_request->getXmlNamespace());
        $this->_body = $request->toXml();
        $namespaces = array_values($this->_body->getDocNamespaces(true));
        $this->addNamespace($namespaces);
        return $this;
    }

    /**
     * Add namespace.
     *
     * @param  string|array $namespace
     * @return self
     */
    public function addNamespace($namespace)
    {
        if(is_array($namespace))
        {
            foreach ($namespace as $ns)
            {
                $this->addNamespace($ns);
            }
        }
        else
        {
            if(!in_array($namespace, $this->_namespaces) && !empty($namespace))
            {
                $this->_namespaces[] = (string) $namespace;
            }
        }
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
    public function getHeader($name = null)
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
     * Get all soap headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * Gets content type
     *
     * @param  string $version Soap version
     * @return string
     */
    public function getContentType($version = null)
    {
        $version = in_array($version, [self::SOAP_1_2, self::SOAP_1_1]) ? $version : $this->_version;
        return self::$contentTypeMap[$version];
    }

    /**
     * Gets soap version
     *
     * @param  string $version
     * @return string
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * Returns the json encoded string representation of this class 
     *
     * @return string
     */
    public function toJson()
    {
        $array = [];
        if(count($this->_headers))
        {
            $array['Header'] = [
                'context' => [
                    '_jsns' => 'urn:zimbra',
                ],
            ];
            foreach ($this->_headers as $name => $value)
            {
                $array['Header']['context'][$name] = array('_content' => $value);
            }
        }
        if($this->_request instanceof Request)
        {
            $reqArray = $this->_request->toArray();
            $reqName = $this->_request->requestName();
            $array['Body'][$reqName] = $reqArray[$reqName];
        }
        return json_encode((object) $array);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $soapNamespace = ($this->_version === self::SOAP_1_2) ? self::NS_SOAP_1_2 : self::NS_SOAP_1_1;
        $nsString = 'xmlns:env="'.$soapNamespace.'"';
        foreach ($this->_namespaces as $key => $ns)
        {
            if($key > 0)
            {
                $nsString .= sprintf(' xmlns:urn%d="%s"', $key, $ns);
            }
            else
            {
                $nsString .= sprintf(' xmlns:urn="%s"', $ns);
            }
        }
        $message = sprintf('<env:Envelope %s></env:Envelope>', $nsString);
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
        $body->append($this->_body, $this->_request->getXmlNamespace());
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
