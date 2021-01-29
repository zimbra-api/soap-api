<?php declare(strict_types=1);
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
use GuzzleHttp\Psr7\Request as HttpRequest;
use GuzzleHttp\Exception\BadResponseException;
// use Psr\Http\Client\ClientInterface as HttpClient;
// use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\{RequestInterface, ResponseInterface};

/**
 * Client is a class which provides a http client for SOAP servers
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
class Client extends EventEmitter implements ClientInterface
{
    /**
     * Http client
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Soap end point
     * @var string
     */
    private $endpoint;

    /**
     * Last request message
     * @var RequestInterface
     */
    private $request;

    /**
     * Last response message
     * @var ResponseInterface
     */
    private $response;

    /**
     * Http constructor
     *
     * @param string $endpoint  The URL to request.
     */
    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
        $this->httpClient = new HttpClient([
            'cookies' => true,
            'verify' => false,
        ]);
    }

    /**
     * Performs a SOAP request
     *
     * @param  string $soapMessage Soap message
     * @param  array $headers Request headers
     * @return ResponseInterface
     */
    public function sendRequest(string $soapMessage, array $headers = []): ?ResponseInterface
    {
        $this->request = new HttpRequest('POST', $this->endpoint, $headers, $soapMessage);
        try {
            $this->emit('before.request', [$this->getLastRequest()]);
            $this->response = $this->httpClient->sendRequest($this->request);
            $this->emit('after.request', [$this->getLastResponse()]);
        }
        catch (BadResponseException $ex) {
            if ($ex->hasResponse()) {
                $this->response = $ex->getResponse();
                $this->emit('after.request', [$this->getLastResponse()]);
            }
            throw $ex;
        }
        return $this->response;
    }

    /**
     * Returns last request.
     *
     * @return RequestInterface
     */
    public function getLastRequest(): ?RequestInterface
    {
        return $this->request;
    }

    /**
     * Returns last SOAP response.
     *
     * @return ResponseInterface.
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
