<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList, XmlNamespace, XmlRoot};
use Zimbra\Common\Enum\OnError;
use Zimbra\Common\Struct\{
    BatchRequest,
    BatchRequestInterface,
    BatchResponseInterface,
    SoapBody,
    SoapBodyInterface,
    SoapEnvelope,
    SoapEnvelopeInterface,
    SoapRequest,
    SoapRequestInterface,
    SoapResponse,
    SoapResponseInterface
};
use Zimbra\Tests\ZimbraTestCase;

/**
 * BatchRequestTest class for BatchRequest.
 */
class BatchRequestTest extends ZimbraTestCase
{
    public function testSoapBatchRequest()
    {
        $requestId = $this->faker->uuid;
        $request = new FooRequest();
        $request->setRequestId($requestId);
        $this->assertSame($requestId, $request->getRequestId());

        $response = new FooResponse();
        $response->setRequestId($requestId);
        $this->assertSame($requestId, $response->getRequestId());

        $batchRequest = new FooBatchRequest([$request]);
        $this->assertSame([$request], $batchRequest->getRequests());
        $this->assertEquals(OnError::CONTINUE(), $batchRequest->getOnError());
        $batchRequest = new FooBatchRequest();
        $batchRequest->setOnError(OnError::CONTINUE())
            ->setRequests([$request])
            ->addRequest($request);
        $this->assertSame([$request, $request], $batchRequest->getRequests());
        $this->assertEquals(OnError::CONTINUE(), $batchRequest->getOnError());

        $batchResponse = new FooBatchResponse([$response]);
        $this->assertSame([$response], $batchResponse->getResponses());
        $batchResponse = new FooBatchResponse();
        $batchResponse->setResponses([$response])
            ->addResponse($response);
        $this->assertSame([$response, $response], $batchResponse->getResponses());

        $envelope = new BatchEnvelope(new BatchBody($batchRequest, $batchResponse));

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra">
    <soap:Body>
        <urn:BatchRequest onerror="continue">
            <urn:FooRequest requestId="$requestId" />
            <urn:FooRequest requestId="$requestId" />
        </urn:BatchRequest>
        <urn:BatchResponse>
            <urn:FooResponse requestId="$requestId" />
            <urn:FooResponse requestId="$requestId" />
        </urn:BatchResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, BatchEnvelope::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbra", prefix="urn")
 * @XmlRoot(name="soap:Envelope")
 */
class BatchEnvelope extends SoapEnvelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Tests\Common\Struct\BatchBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $body;

    public function getBody() : SoapBodyInterface
    {
        return $this->body;
    }

    public function setBody(SoapBodyInterface $body): self
    {
        $this->body = $body;
        return $this;
    }
}

class BatchBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("BatchRequest")
     * @Type("Zimbra\Tests\Common\Struct\FooBatchRequest")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("BatchResponse")
     * @Type("Zimbra\Tests\Common\Struct\FooBatchResponse")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?SoapResponseInterface $response = NULL;

    public function __construct(?FooBatchRequest $request = NULL, ?FooBatchResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof FooBatchRequest) {
            $this->request = $request;
        }
        return $this;
    }

    public function getRequest(): ?SoapRequestInterface
    {
        return $this->request;
    }

    public function setResponse(SoapResponseInterface $response): self
    {
        if ($response instanceof FooBatchResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?SoapResponseInterface
    {
        return $this->response;
    }
}

class FooBatchRequest extends BatchRequest
{
    /**
     * @Accessor(getter="getRequests", setter="setRequests")
     * @Type("array<Zimbra\Tests\Common\Struct\FooRequest>")
     * @XmlList(inline=true, entry="FooRequest", namespace="urn:zimbra")
     */
    private $requests = [];

    public function addRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof FooRequest) {
            $this->requests[] = $request;
        }
        return $this;
    }

    public function setRequests(array $requests): self
    {
        $this->requests = array_filter($requests, static fn($request) => $request instanceof FooRequest);
        return $this;
    }

    public function getRequests(): array
    {
        return $this->requests;
    }

    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new BatchEnvelope(
            new BatchBody($this)
        );
    }
}

class FooBatchResponse implements BatchResponseInterface
{
    /**
     * @Accessor(getter="getResponses", setter="setResponses")
     * @Type("array<Zimbra\Tests\Common\Struct\FooResponse>")
     * @XmlList(inline=true, entry="FooResponse", namespace="urn:zimbra")
     */
    private $responses = [];

    public function __construct(array $responses = [])
    {
        $this->setResponses($responses);
    }

    public function addResponse(SoapResponseInterface $response): self
    {
        if ($response instanceof FooResponse) {
            $this->responses[] = $response;
        }
        return $this;
    }

    public function setResponses(array $responses): self
    {
        $this->responses = array_filter($responses, static fn($response) => $response instanceof FooResponse);
        return $this;
    }

    public function getResponses(): array
    {
        return $this->responses;
    }
}

class FooRequest extends SoapRequest
{
    protected function envelopeInit(): SoapEnvelopeInterface
    {}
}

class FooResponse extends SoapResponse
{
}
