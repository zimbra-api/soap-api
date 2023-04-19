<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap;

use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\{
    RequestFactoryInterface, RequestInterface, ResponseInterface, StreamFactoryInterface
};

/**
 * Client is a class which provides a client for Zimbra SOAP service
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Client implements ClientInterface
{
    const CONTENT_TYPE    = 'application/soap+xml; charset=utf-8';
    const HTTP_USER_AGENT = 'PHP-Zimbra-Soap-Client';
    const REQUEST_METHOD  = 'POST';

    /**
     * @var array
     */
    private static $originatingIpHeaders = [
        'Client-Ip',
        'Forwarded-For',
        'X-Client-Ip',
        'X-Forwarded-For',
    ];

    /**
     * @var array
     */
    private static $serverOriginatingIpHeaders = [
        'HTTP_CLIENT_IP',
        'HTTP_FORWARDED',
        'HTTP_FORWARDED_FOR',
        'HTTP_X_CLIENT_IP',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_X_FORWARDED',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR',
    ];

    /**
     * Http cookie
     * 
     * @var string
     */
    private ?string $cookie = NULL;

    /**
     * Http request message
     * 
     * @var RequestInterface
     */
    private ?RequestInterface $httpRequest = NULL;

    /**
     * Http response message
     * 
     * @var ResponseInterface
     */
    private ?ResponseInterface $httpResponse = NULL;

    /**
     * Constructor
     *
     * @param string $serviceUrl
     * @param HttpClientInterface $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     */
    public function __construct(
        private string $serviceUrl,
        private HttpClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        private StreamFactoryInterface $streamFactory
    )
    {
    }

    /**
     * {@inheritdoc}
     */
    public function sendRequest(string $soapMessage, array $headers = []): ?ResponseInterface
    {
        $httpRequest = $this->requestFactory
            ->createRequest(self::REQUEST_METHOD, $this->serviceUrl)
            ->withBody($this->streamFactory->createStream($soapMessage))
            ->withHeader('Content-Type', self::CONTENT_TYPE)
            ->withHeader('User-Agent', $_SERVER['HTTP_USER_AGENT'] ?? self::HTTP_USER_AGENT);
        foreach ($headers as $name => $value) {
            $httpRequest = $httpRequest->withHeader($name, $value);
        }
        if (!empty($this->cookie)) {
            $httpRequest = $httpRequest->withHeader('Cookie', $this->cookie);
        }
        if (!empty(self::getOriginatingIp())) {
            foreach (self::$originatingIpHeaders as $header) {
                $httpRequest = $httpRequest->withHeader($header, self::getOriginatingIp());
            }
        }
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $this->httpClient->sendRequest($this->httpRequest);
        if ($this->httpResponse->hasHeader('Set-Cookie')) {
            $this->cookie = implode(', ', $this->httpResponse->getHeader('Set-Cookie'));
        }
        return $this->httpResponse;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpRequest(): ?RequestInterface
    {
        return $this->httpRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpResponse(): ?ResponseInterface
    {
        return $this->httpResponse;
    }

    private static function getOriginatingIp(): ?string
    {
        static $ip = NULL;
        if (empty($ip) && !empty($_SERVER)) {
            foreach(self::$serverOriginatingIpHeaders as $header) {
                if (!empty($_SERVER[$header])) {
                    $ip = $_SERVER[$header];

                    // Some proxies typically list the whole chain of IP
                    // addresses through which the client has reached us.
                    // e.g. client_ip, proxy_ip1, proxy_ip2, etc.
                    sscanf($ip, '%[^,]', $ip);
                    break;
                }
            }
        }
        return $ip;
    }
}
