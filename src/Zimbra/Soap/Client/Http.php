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
use Guzzle\Http\Client as HttpClient;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Cookie\CookiePlugin;
use Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar;
use Zimbra\Soap\Message;
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
    protected $authToken;

    /**
     * Authentication session identify
     * @var string
     */
    protected $sessionId;

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
    protected $headers = array();

    /**
     * Server location
     * @var string
     */
    protected $location;

    /**
     * Last response message
     * @var string
     */
    protected $response;

    /**
     * @var array
     */
    private static $_instances = array();

    /**
     * Base constructor
     *
     * @param string $location  The URL to request.
     */
    public function __construct($location)
    {
        $this->location = $location;
        $this->httpClient = new HttpClient;
        $this->httpClient
             ->setSslVerification(false)
             ->addSubscriber(new CookiePlugin(new ArrayCookieJar));
    }

    /**
     * Creates a singleton of a ClientInterface base on location.
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
     *
     * @param  string $request The XML SOAP request.
     * @param  string $headers The HTTP request header.
     * @return mixed
     */
    public function __doRequest($request, array $headers = array())
    {
        $this->emit('before.request', array(&$request, &$headers));
        $httpRequest = $this->httpClient->post(
            $this->location,
            $headers,
            (string) $request
        );

        $this->headers = $httpRequest->getHeaders()->toArray();
        try
        {
            $this->response = $httpRequest->send();
            $this->emit('after.request', array($this->lastResponse(), $this->lastResponseHeaders()));
        }
        catch (\Guzzle\Http\Exception\BadResponseException $ex)
        {
            $this->response = $ex->getResponse();
            $this->emit('after.request', array($this->lastResponse(), $this->lastResponseHeaders()));
            throw $ex;
        }
        return $this->response;

    }

    /**
     * Set or get authentication token.
     *
     * @param  string $authToken Authentication token
     * @return string|self
     */
    public function authToken($authToken = null)
    {
        if(null === $authToken)
        {
            return $this->authToken;
        }
        $this->authToken = trim($authToken);
        return $this;
    }

    /**
     * Set or get authentication session identify.
     *
     * @param  string $sessionId Authentication session identify
     * @return string|self
     */
    public function sessionId($sessionId = null)
    {
        if(null === $sessionId)
        {
            return $this->sessionId;
        }
        $this->sessionId = trim($sessionId);
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
        $this->soapMessage = new Message;
        if(!empty($this->authToken))
        {
            $this->soapMessage->addHeader('authToken', $this->authToken);
        }
        if(!empty($this->sessionId))
        {
            $this->soapMessage->addHeader('sessionId', $this->sessionId);
        }
        $this->soapMessage->request($request);
        $response = $this->__doRequest($this->soapMessage->__toString(), array(
                'Content-Type' => $this->soapMessage->contentType(),
                'Method'       => 'POST',
                'User-Agent'   => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'PHP-Zimbra-Soap-API',
                'SoapAction' => $request->xmlNamespace() . '#' . $request->requestName()
            )
        );
        return new SoapResponse($response);
    }

    /**
     * Returns last SOAP request.
     *
     * @return mix The last SOAP request, as an XML string.
     */
    public function lastRequest()
    {
        return (string) $this->soapMessage;
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
        if($this->response instanceof Response)
        {
            return $this->response->getBody(true);
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
        if($this->response instanceof Response)
        {
            return $this->response->getHeaders()->toArray();                
        }
        return array();
    }
}
