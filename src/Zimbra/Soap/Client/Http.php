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

use Evenement\EventEmitter;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Response as HttpResponse;
use Zimbra\Enum\RequestFormat;
use Zimbra\Soap\Message as SoapMessage;
use Zimbra\Soap\Request as SoapRequest;
use Zimbra\Soap\Response as SoapResponse;

/**
 * Http is a class which provides a http client for SOAP servers
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Http extends EventEmitter implements ClientInterface
{
    /**
     * Authentication token
     * @var string
     */
    private $_authToken;

    /**
     * Authentication session identify
     * @var string
     */
    private $_sessionId;

    /**
     * Request format
     * @var RequestFormat
     */
    private $_format;

    /**
     * @var Message
     */
    protected $soapMessage;

    /**
     * Http client
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * Request headers
     * @var array
     */
    protected $headers = [];

    /**
     * Server location
     * @var string
     */
    protected $location;

    /**
     * Last request message
     * @var string
     */
    protected $request;

    /**
     * Last response message
     * @var HttpResponse
     */
    protected $response;

    /**
     * @var array
     */
    private static $_instances = [];

    /**
     * Http constructor
     *
     * @param string $location  The URL to request.
     */
    public function __construct($location)
    {
        $this->location = $location;
        $this->httpClient = new HttpClient([
            'cookies' => true,
            'verify' => false,
        ]);
    }

    /**
     * Creates a singleton of a ClientInterface base on location.
     *
     * @param  string $location The Zimbra api soap location.
     * @return ClientInterface
     */
    public static function instance($location = null)
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
     *
     * @param  string $request The XML SOAP request.
     * @param  string $headers The HTTP request header.
     * @return mixed
     */
    public function __doRequest($request, array $headers = [])
    {
        $this->emit('before.request', [&$request, &$headers]);
        $this->headers = $headers;

        $options = [
            'headers' => $headers,
            'body' => (string) $request,
        ];

        try
        {
            $this->response = $this->httpClient->request('POST', $this->location, $options);
            $this->emit('after.request', [$this->lastResponse(), $this->lastResponseHeaders()]);
        }
        catch (BadResponseException $ex)
        {
            if ($ex->hasResponse())
            {
                $this->response = $ex->getResponse();
                $this->emit('after.request', [$this->lastResponse(), $this->lastResponseHeaders()]);
            }
            throw $ex;
        }
        return $this->response;
    }

    /**
     * Gets authentication token.
     *
     * @return string
     */
    function getAuthToken()
    {
        return $this->_authToken;
    }

    /**
     * Sets authentication token.
     *
     * @param  string|array $authToken Authentication token
     * @return self
     */
    function setAuthToken($authToken)
    {
        if(is_array($authToken))
        {
            $this->_authToken = !empty($authToken[0]->_content) ? $authToken[0]->_content : null;
        }
        else
        {
            $this->_authToken = trim($authToken);
        }
        return $this;
    }

    /**
     * Gets authentication session identify.
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->_sessionId;
    }

    /**
     * Sets authentication session identify.
     *
     * @param  string $sessionId Authentication session identify
     * @return self
     */
    public function setSessionId($sessionId)
    {
        $this->_sessionId = trim($sessionId);
        return $this;
    }

    /**
     * Gets request format
     *
     * @return RequestFormat
     */
    public function getFormat()
    {
        return $this->_format;
    }

    /**
     * Sets request format
     *
     * @param  RequestFormat $format
     * @return self
     */
    public function setFormat(RequestFormat $format)
    {
        $this->_format = $format;
        return $this;
    }

    /**
     * Performs a SOAP request
     *
     * @param  Zimbra\Soap\Reques $request
     * @return object Soap response
     */
    public function doRequest(SoapRequest $request)
    {
        $this->soapMessage = new SoapMessage;
        if(!empty($this->_authToken))
        {
            $this->soapMessage->addHeader('authToken', $this->_authToken);
        }
        if(!empty($this->_sessionId))
        {
            $this->soapMessage->addHeader('sessionId', $this->_sessionId);
        }
        $isJs = false;
        if($this->_format instanceof RequestFormat)
        {
            $this->soapMessage->addHeader('format', $this->_format->value());
            if($this->_format->is(RequestFormat::JS()))
            {
                $isJs = true;
            }
        }
        $this->soapMessage->setRequest($request);
        $this->request = ($isJs) ? $this->soapMessage->toJson() : (string) $this->soapMessage;

        $response = $this->__doRequest($this->request, [
            'Content-Type' => $this->soapMessage->getContentType(),
            'Method'       => 'POST',
            'User-Agent'   => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'PHP-Zimbra-Soap-API',
            'SoapAction' => $request->getXmlNamespace() . '#' . $request->requestName()
        ]);
        return new SoapResponse($response);
    }

    /**
     * Returns last SOAP request.
     *
     * @return mix The last SOAP request, as an XML string.
     */
    public function lastRequest()
    {
        return (string) $this->request;
    }

    /**
     * Returns the SOAP headers from the last request.
     *
     * @return mix The last SOAP request headers.
     */
    function lastRequestHeaders()
    {
        return $this->headers;
    }

    /**
     * Returns last SOAP response.
     *
     * @return mix The last SOAP response, as an XML string.
     */
    public function lastResponse()
    {
        if($this->response instanceof HttpResponse)
        {
            return $this->response->getBody();
        }
        return null;
    }

    /**
     * Returns the SOAP headers from the last response.
     *
     * @return mix The last SOAP response headers.
     */
    public function lastResponseHeaders()
    {
        if($this->response instanceof HttpResponse)
        {
            return $this->response->getHeaders();                
        }
        return [];
    }
}
