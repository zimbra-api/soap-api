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
abstract class Api implements ApiInterface
{
    /**
     * Zimbra api soap client
     * @var ClientInterface
     */
    private $client;

    /**
     * Zimbra api request soap header
     * @var Header
     */
    private $requestHeader;

    /**
     * Zimbra api response soap header
     * @var Header
     */
    private $responseHeader;

    /**
     * Request format
     * @var string
     */
    private $requestFormat;

    public function __construct(string $endpoint, ?string $requestFormat = NULL)
    {
        $this->client = new ClientFactory::create($endpoint);
        if (RequestFormat::isValid($requestFormat)) {
            $this->requestFormat = $requestFormat;
        }
        else {
            $this->requestFormat = RequestFormat::XML()->getValue();
        }
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
     * Set Zimbra api response soap header.
     *
     * @return self
     */
    public function setResponseHeader(Header $responseHeader): self
    {
        $this->responseHeader = $responseHeader;
        return $this;
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
     * Sets request format
     *
     * @param  string $requestFormat
     * @return self
     */
    public function setRequestFormat(string $requestFormat): self
    {
        if (RequestFormat::isValid(trim($requestFormat))) {
            $this->requestFormat = trim($requestFormat);
        }
        return $this;
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
        $response = $this->getClient()->sendRequest(
            $this->getSerializer()->serialize($requestEnvelope, $this->serializeFormat()),
            [
                'Content-Type' => 'application/soap+xml; charset=utf-8',
                'User-Agent'   => $_SERVER['HTTP_USER_AGENT'] ?? 'PHP-Zimbra-Soap-API',
            ]
        );
        $responseEnvelope = $this->getSerializer()->deserialize(
            $response->getBody()->getContents(),
            get_class($requestEnvelope), $this->serializeFormat()
        );
        if (!empty($responseEnvelope->getHeader())) {
            $this->responseHeader = $responseEnvelope->getHeader();
        }
        return $responseEnvelope->getBody()->getResponse();
    }

    /**
     * Gets serialize format
     *
     * @return string
     */
    protected function serializeFormat(): string
    {
        return $this->requestFormat == RequestFormat::JS()->getValue() ? 'json' : 'xml';
    }

    /**
     * Gets serializer
     *
     * @return SerializerInterface
     */
    protected function getSerializer(): SerializerInterface
    {
        return SerializerFactory::create();
    }

    protected function initRequestHeader(): self
    {
        if (!($this->requestHeader instanceof Header)) {
            $this->requestHeader = new Header(new Context());
        }
        return $this;
    }
}
