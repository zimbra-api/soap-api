<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Client;

use Zimbra\Soap\Request as SoapRequest;
use Zimbra\Common\Text;

/**
 * Wsdl is a class which provides a client for SOAP 1.2 servers.
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Wsdl extends \SoapClient implements ClientInterface
{
    /**
     * Soap headers
     * @var array
     */
    private $_headers = array();

    /**
     * Filter callbacks
     * @var array
     */
    private $_filters = array();

    /**
     * @var array
     */
    private static $_instances = array();

    /**
     * Wsdl constructor
     *
     * @param string $location  The URL to request.
     */
    public function __construct($location)
    {
        $options = array(
            'trace' => 1,
            'exceptions' => 1,
            'soap_version' => SOAP_1_2,
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'PHP-Zimbra-Soap-API',
            'cache_wsdl' => WSDL_CACHE_DISK,
        );
        parent::__construct($location, $options);
    }

    /**
     * Creates a singleton of a ClientInterface base on parameters.
     *
     * @param  string $location The Zimbra api soap location.
     * @return ClientInterface
     */
    public static function instance($location = 'https://localhost/service/soap')
    {
        $key = sha1($location);
        if (isset(self::$_instances[$key]) and (self::$_instances[$key] instanceof ClientInterface))
        {
            return self::$_instances[$key];
        }
        else
        {
            self::$_instances[$key] = new self($location);
            return self::$_instances[$key];
        }
    }

    /**
     * Performs SOAP request over HTTP.
     * This method can be overridden in subclasses to implement different transport layers, perform additional XML processing or other purpose.
     *
     * @param  string $request  The XML SOAP request.
     * @param  string $location The URL to request.
     * @param  string $action   The SOAP action.
     * @param  int    $version  The SOAP version.
     * @param  int    $one_way  If one_way is set to 1, this method returns nothing. Use this where a response is not expected.
     * @return mixed
     */
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        if ($this->_filters)
        {
            foreach ($this->_filters as $callback)
            {
                $request = call_user_func($callback, $request, $location, $action, $version, $one_way);
            }
        }

        $this->__last_request = $request;
        return parent::__doRequest($request, $location, $action, $version, $one_way);
    }

    /**
     * Gets soap header.
     *
     * @return SoapHeader
     */
    public function soapHeader()
    {
        $soapHeader = null;
        if(count($this->_headers))
        {
            $soapVar = new \SoapVar((object) $this->_headers, SOAP_ENC_OBJECT);
            $soapHeader = new \SoapHeader('urn:zimbra', 'context', $soapVar);
        }
        return $soapHeader;
    }

    /**
     * Filters to be run before request are sent.
     *
     * @param  Closure $callback
     * @return self
     */
    public function addFilter(\Closure $callback)
    {
        $this->_filters[] = $callback;
        return $this;
    }

    /**
     * Sets or gets authentication token.
     *
     * @param  string $authToken Authentication token
     * @return self
     */
    public function authToken($authToken = null)
    {
        if(null === $authToken)
        {
            return isset($this->_headers['authToken']) ? $this->_headers['authToken'] : null;
        }
        $this->_headers['authToken'] = (string) $authToken;
        return $this;
    }

    /**
     * Sets or getg authentication session identify.
     *
     * @param  string $sessionId Authentication session identify
     * @return self
     */
    public function sessionId($sessionId = null)
    {
        if(null === $sessionId)
        {
            return isset($this->_headers['sessionId']) ? $this->_headers['sessionId'] : null;
        }
        $this->_headers['sessionId'] = (string) $sessionId;
        return $this;
    }

    /**
     * Performs a SOAP request
     *
     * @param  Zimbra\Soap\Request $request
     * @return object Soap response
     */
    public function doRequest(SoapRequest $request)
    {
        $soapHeader = $this->soapHeader();
        $requestArr = $request->toArray();
        $parameters = array('parameters' => $requestArr[$request->requestName()]);
        if($soapHeader instanceof \SoapHeader)
        {
            return $this->__soapCall($request->requestName(), $parameters, null, $soapHeader);
        }
        else
        {
            return $this->__soapCall($request->requestName(), $parameters);
        }
    }

    /**
     * Returns last SOAP request.
     *
     * @return string The last SOAP request, as an XML string.
     */
    public function lastRequest()
    {
        return $this->__getLastRequest();
    }

    /**
     * Returns the SOAP headers from the last request.
     *
     * @return array The last SOAP request headers.
     */
    public function lastRequestHeaders()
    {
        return Text::extractHeaders($this->__getLastRequestHeaders());
    }

    /**
     * Returns last SOAP response.
     *
     * @return string The last SOAP response, as an XML string.
     */
    public function lastResponse()
    {
        return $this->__getLastResponse();
    }

    /**
     * Returns the SOAP headers from the last response.
     *
     * @return array The last SOAP response headers.
     */
    public function lastResponseHeaders()
    {
        return Text::extractHeaders($this->__getLastResponseHeaders());
    }
}
