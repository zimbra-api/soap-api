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

use Psr\Http\Client\ClientInterface as HttpClient;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\{RequestFactoryInterface, RequestInterface, ResponseInterface, StreamFactoryInterface};

/**
 * Client is a class which provides a http client for SOAP servers
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
class Client implements ClientInterface
{
    /**
     * Soap end point
     * @var string
     */
    private $endpoint;

    /**
     * Http client
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Request factory
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * Stream factory
     * @var StreamFactoryInterface
     */
    private $streamFactory;

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
     * @param HttpClient $httpClient  The http client.
     * @param RequestFactoryInterface $requestFactory  The http request factory.
     * @param StreamFactoryInterface $streamFactory  The http stream factory.
     */
    public function __construct(
        string $endpoint,
        HttpClient $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    )
    {
        $this->endpoint = $endpoint;
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
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
        $request = $this->requestFactory->createRequest('POST', $this->endpoint);
        $request = $request->withBody($this->streamFactory->createStream($soapMessage));
        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }
        $this->request = $request;
        try {
            $this->response = $this->httpClient->sendRequest($this->request);
        }
        catch (ClientExceptionInterface $ex) {
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
