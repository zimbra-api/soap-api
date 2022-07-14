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
use Zimbra\Common\SerializerFactory;
use Zimbra\Enum\RequestFormat;
use Zimbra\Soap\Header\AccountInfo;
use Zimbra\Soap\Header\Context;

/**
 * API is a base class which allows to manage Zimbra api
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
abstract class AbstractApi implements ApiInterface
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
     * Get Zimbra api soap client.
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
     * Gets request format
     *
     * @return string
     */
    public function getRequestFormat(): string
    {
        return $this->requestFormat;
    }

    /**
     * Invoke the request.
     *
     * @return  EnvelopeInterface
     */
    protected function invoke(RequestInterface $request): ?ResponseInterface
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