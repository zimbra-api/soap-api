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

use Zimbra\Soap\Message;
use Zimbra\Soap\Request as SoapRequest;
use Guzzle\Http\Client as HttpClient;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Cookie\CookiePlugin;
use Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar;

/**
 * Http is a class which provides a http client for SOAP servers
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Http implements ClientInterface
{
    /**
     * @var string Authentication token
     */
    protected $authToken;

    /**
     * @var string Authentication identify
     */
    protected $sessionId;

    /**
     * @var string Soap namespace
     */
    protected $namespace = 'urn:zimbra';

    /**
     * @var Message
     */
    protected $soapMessage;

    /**
     * @var HttpClient Http client
     */
    protected $httpClient;

    /**
     * @var array Request headers
     */
    protected $headers = array();

    /**
     * @var string Server location
     */
    protected $location;

    /**
     * @var string Last response message
     */
    protected $response;

    /**
     * Base constructor
     *
     * @param string $location  The URL to request.
     * @param string $namespace The SOAP namespace.
     */
    public function __construct($location, $namespace = 'urn:zimbra')
    {
        $this->location = $location;
        $this->namespace = !empty($namespace) ? $namespace : 'urn:zimbra';
        $this->httpClient = new HttpClient;
        $this->httpClient
             ->setSslVerification(false)
             ->addSubscriber(new CookiePlugin(new ArrayCookieJar));
    }

    public function __doRequest($request, array $headers = array())
    {
        $httpRequest = $this->httpClient->post(
            $this->location,
            $headers,
            (string) $request
        );

        $this->headers = $httpRequest->getHeaders()->toArray();
        try
        {
            $this->response = $httpRequest->send();
        }
        catch (\Guzzle\Http\Exception\BadResponseException $ex)
        {
            $this->response = $ex->getResponse();
            throw $ex;
        }
        return $this->response->getBody(true);

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
        $requestXml = $request->toXml();
        $this->soapMessage = new Message($this->namespace);
        if(!empty($this->authToken))
        {
            $this->soapMessage->addHeader('authToken', $this->authToken);
        }
        if(!empty($this->sessionId))
        {
            $this->soapMessage->addHeader('sessionId', $this->sessionId);
        }
        $this->soapMessage->body($requestXml);
        $response = $this->__doRequest($this->soapMessage->__toString(), array(
                'Content-Type' => $this->soapMessage->contentType(),
                'Method'       => 'POST',
                'User-Agent'   => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'PHP-Zimbra-Soap-API',
                'SoapAction' => $this->namespace.'#'.$requestXml->getName()
            )
        );
        return $request->processResponse($response);
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
        return null;
    }
}
