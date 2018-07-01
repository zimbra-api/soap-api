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

use Evenement\EventEmitter;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Response as HttpResponse;
use Zimbra\Enum\RequestFormat;
use Zimbra\Soap\Request as SoapRequest;
use Zimbra\Soap\Response as SoapResponse;

/**
 * Client is a class which provides a http client for SOAP servers
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Client extends EventEmitter implements ClientInterface
{
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
     * Performs a SOAP request
     *
     * @param  string $request
     * @return string Soap response
     */
    public function doRequest($request)
    {
        $this->request = (string) $request;
        $this->headers = [
            'Content-Type' => 'application/soap+xml; charset=utf-8',
            'Method'       => 'POST',
            'User-Agent'   => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'PHP-Zimbra-Soap-API',
        ];

        $options = [
            'headers' => $this->headers,
            'body' => $this->request,
        ];

        try
        {
            $this->emit('before.request', [$this->request, $this->headers]);
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
