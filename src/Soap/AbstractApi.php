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

use JMS\Serializer\SerializerInterface;
use Psr\Log\{LoggerAwareInterface, LoggerInterface, NullLogger};
use Zimbra\Common\SerializerFactory;
use Zimbra\Soap\Header\{AccountInfo, Context};

/**
 * API is a base class which allows to manage Zimbra api
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
abstract class AbstractApi implements ApiInterface, LoggerAwareInterface
{
    const SOAP_CONTENT_TYPE = 'application/soap+xml; charset=utf-8';
    const SERIALIZE_FORMAT  = 'xml';
    const HTTP_USER_AGENT   = 'PHP-Zimbra-Soap-API';

    /**
     * Zimbra api soap client
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * Instance serializer.
     *
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var LoggerInterface
     */
    private ?LoggerInterface $logger = NULL;

    /**
     * Zimbra api request soap header
     * @var Header
     */
    private ?Header $requestHeader = NULL;

    /**
     * Zimbra api response soap header
     * @var Header
     */
    private ?Header $responseHeader = NULL;

    public function __construct(string $serviceUrl = '')
    {
        $this->client = ClientFactory::create($serviceUrl);
        $this->serializer = SerializerFactory::create();
    }

    /**
     * Get zimbra api soap client.
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * Set Zimbra api soap client.
     *
     * @return self
     */
    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get the logger.
     *
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        if (!($this->logger instanceof LoggerInterface)) {
            $this->logger = new NullLogger();
        }
        return $this->logger;
    }

    /**
     * Set the logger.
     *
     * @return self
     */
    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * Get Zimbra api soap request header.
     *
     * @return Header
     */
    public function getRequestHeader(): ?Header
    {
        return $this->requestHeader;
    }

    /**
     * Set Zimbra api soap request header.
     *
     * @return self
     */
    public function setRequestHeader(Header $requestHeader): self
    {
        $this->requestHeader = $requestHeader;
        return $this;
    }

    /**
     * Get Zimbra api response soap header.
     *
     * @return Header
     */
    public function getResponseHeader(): ?Header
    {
        return $this->responseHeader;
    }

    /**
     * Invoke the request.
     *
     * @return  EnvelopeInterface
     */
    public function invoke(RequestInterface $request): ?ResponseInterface
    {
        $requestEnvelope = $request->getEnvelope();
        if ($this->requestHeader instanceof Header) {
            $requestEnvelope->setHeader($this->requestHeader);
        }
        $response = $this->client->sendRequest(
            $this->serializer->serialize($requestEnvelope, self::SERIALIZE_FORMAT),
            [
                'Content-Type' => static::SOAP_CONTENT_TYPE,
                'User-Agent'   => $_SERVER['HTTP_USER_AGENT'] ?? self::HTTP_USER_AGENT,
            ]
        );
        $this->getLogger()->debug('Soap response', ['response' => $response]);
        $responseEnvelope = $this->serializer->deserialize(
            $response->getBody()->getContents(),
            get_class($requestEnvelope), self::SERIALIZE_FORMAT
        );
        if ($responseEnvelope->getHeader() instanceof Header) {
            $this->responseHeader = $responseEnvelope->getHeader();
        }
        return $responseEnvelope->getBody()->getResponse();
    }

    protected function initRequestHeader(): self
    {
        if (empty($this->requestHeader)) {
            $this->requestHeader = new Header(new Context());
        }
        return $this;
    }
}
