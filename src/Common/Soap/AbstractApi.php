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

use JMS\Serializer\SerializerInterface;
use Psr\Log\{
    LoggerAwareInterface,
    LoggerAwareTrait,
    LoggerInterface,
    NullLogger
};
use Zimbra\Common\Serializer\SerializerFactory;
use Zimbra\Common\Struct\Header\{AccountInfo, Context};
use Zimbra\Common\Struct\{
    SoapBodyInterface,
    SoapFaultInterface,
    SoapHeader,
    SoapHeaderInterface,
    SoapRequestInterface,
    SoapResponseInterface
};

/**
 * Base class which allows to manage Zimbra soap api
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class AbstractApi implements
    ApiInterface,
    HeaderAwareInterface,
    LoggerAwareInterface
{
    use LoggerAwareTrait;

    const SERIALIZE_FORMAT = "xml";

    /**
     * Soap client
     *
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * Serializer.
     *
     * @var SerializerInterface
     */
    private ?SerializerInterface $serializer = null;

    /**
     * Request soap header
     *
     * @var SoapHeaderInterface
     */
    private ?SoapHeaderInterface $requestHeader = null;

    /**
     * Response soap header
     *
     * @var SoapHeaderInterface
     */
    private ?SoapHeaderInterface $responseHeader = null;

    /**
     * Constructor
     *
     * @param string $serviceUrl
     */
    public function __construct(string $serviceUrl = "")
    {
        $this->setClient(ClientFactory::create($serviceUrl));
    }

    /**
     * {@inheritdoc}
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * Set soap client.
     *
     * @param ClientInterface $client
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
     * {@inheritdoc}
     */
    public function getRequestHeader(): ?SoapHeaderInterface
    {
        return $this->requestHeader;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseHeader(): ?SoapHeaderInterface
    {
        return $this->responseHeader;
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthToken(string $token): self
    {
        $this->initRequestHeader()
            ->getRequestHeader()
            ->getContext()
            ->setAuthToken($token);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setTargetAccount(AccountInfo $account): self
    {
        $this->initRequestHeader()
            ->getRequestHeader()
            ->getContext()
            ->setAccount($account);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function invoke(
        SoapRequestInterface $request
    ): ?SoapResponseInterface {
        $requestEnvelope = $request->getEnvelope();
        if ($this->requestHeader instanceof SoapHeaderInterface) {
            $requestEnvelope->setHeader($this->requestHeader);
        }

        $requestMessage = $this->getSerializer()->serialize(
            $requestEnvelope,
            self::SERIALIZE_FORMAT
        );
        $this->getLogger()->debug("Soap request message: {request}", [
            "request" => $requestMessage,
        ]);
        $response = $this->getClient()->sendRequest($requestMessage);

        $soapResponse = null;
        $responseMessage = $response->getBody()->getContents();
        $this->getLogger()->debug("Soap response message: {response}", [
            "response" => $responseMessage,
        ]);
        $responseEnvelope = $this->getSerializer()->deserialize(
            $responseMessage,
            get_class($requestEnvelope),
            self::SERIALIZE_FORMAT
        );
        if ($responseEnvelope->getHeader() instanceof SoapHeaderInterface) {
            $this->responseHeader = $responseEnvelope->getHeader();
        }
        if ($responseEnvelope->getBody() instanceof SoapBodyInterface) {
            if (
                $responseEnvelope->getBody()->getSoapFault() instanceof
                SoapFaultInterface
            ) {
                throw new Exception(
                    $responseEnvelope->getBody()->getSoapFault(),
                    $response->getStatusCode()
                );
            }
            $soapResponse = $responseEnvelope->getBody()->getResponse();
        } else {
            throw new \RuntimeException(
                $responseMessage,
                $response->getStatusCode()
            );
        }
        return $soapResponse;
    }

    /**
     * Get the serializer.
     *
     * @return SerializerInterface
     */
    protected function getSerializer(): SerializerInterface
    {
        if (!($this->serializer instanceof SerializerInterface)) {
            $this->serializer = SerializerFactory::create();
        }
        return $this->serializer;
    }

    /**
     * Init soap request header.
     *
     * @return self
     */
    protected function initRequestHeader(): self
    {
        if (!($this->requestHeader instanceof SoapHeaderInterface)) {
            $this->requestHeader = new SoapHeader(new Context());
        }
        return $this;
    }
}
