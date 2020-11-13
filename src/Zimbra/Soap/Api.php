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
use Zimbra\Common\SerializerBuilder;
use Zimbra\Enum\RequestFormat;
use Zimbra\Soap\Request\Batch;

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
     * Zimbra api soap header
     * @var Header
     */
    private $header;

    /**
     * Request format
     * @var string
     */
    private $requestFormat;

    public function __construct($endpoint = 'https://localhost/service/soap', $requestFormat = '')
    {
        $this->client = new Client($endpoint);
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
     * Get Zimbra api soap header.
     *
     * @return Header
     */
    public function getHeader(): Header
    {
        return $this->header;
    }

    /**
     * Set Zimbra api soap header.
     *
     * @return self
     */
    public function setHeader(Header $header): self
    {
        $this->header = $header;
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
    public function setRequestFormat($requestFormat): self
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
    protected function invoke(RequestInterface $request): ResponseInterface
    {
        $requestEnvelope = $request->getEnvelope();
        if ($this->header instanceof Header) {
            $requestEnvelope->setHeader($this->header);
        }
        $response = $this->getClient()->sendRequest(
            $this->getSerializer()->serialize($requestEnvelope, $this->serializeFormat()),
            [
                'Content-Type' => 'application/soap+xml; charset=utf-8',
                'User-Agent'   => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'PHP-Zimbra-Soap-API',
            ]
        );
        $responseEnvelope = $this->getSerializer()->deserialize(
            $response->getBody()->getContents(),
            get_class($requestEnvelope), $this->serializeFormat()
        );
        return $responseEnvelope->getBody()->getResponse();
    }

    /**
     * Perform a batch request.
     *
     * @param  array $requests
     * @return ResponseInterface
     */
    public function batch(array $requests = []): ResponseInterface
    {
        $request = new \Zimbra\Soap\Request\Batch(
            $requests
        );
        return $this->dispatch($request);
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
        return SerializerBuilder::getSerializer();
    }
}
