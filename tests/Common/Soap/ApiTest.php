<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Psr\Log\LoggerInterface;
use Zimbra\Common\Struct\{
    SoapBody,
    SoapBodyInterface,
    SoapEnvelope,
    SoapEnvelopeInterface,
    SoapRequestInterface,
    SoapRequest,
    SoapResponse,
    SoapResponseInterface
};
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\Header\AccountInfo;
use Zimbra\Common\Soap\{AbstractApi, ClientInterface};

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Soap api.
 */
class ApiTest extends ZimbraTestCase
{
    public function testSoapApi()
    {
        $token = $this->faker->sha256;
        $email = $this->faker->email;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra">
    <soap:Body>
        <urn:FooResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $account = new AccountInfo(AccountBy::NAME(), $email);
        $api = new StubApi($this->mockSoapClient($xml));
        $api->setAuthToken($token)
            ->setTargetAccount($account);
        $response = $api->invoke(new FooRequest());

        $this->assertInstanceOf(ClientInterface::class, $api->getClient());
        $this->assertInstanceOf(LoggerInterface::class, $api->getLogger());
        $this->assertInstanceOf(FooResponse::class, $response);
        $this->assertSame($token, $api->getRequestHeader()->getContext()->getAuthToken());
        $this->assertSame($account, $api->getRequestHeader()->getContext()->getAccount());
    }
}

class StubApi extends AbstractApi
{
    public function __construct(ClientInterface $client)
    {
        $this->setClient($client);
    }
}

/**
 * @XmlNamespace(uri="urn:zimbra", prefix="urn")
 * @XmlRoot(name="soap:Envelope")
 */
class FooEnvelope extends SoapEnvelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Tests\Common\Soap\FooBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $body;

    /**
     * Gets soap message body
     *
     * @return SoapBodyInterface
     */
    public function getBody() : SoapBodyInterface
    {
        return $this->body;
    }

    /**
     * Sets soap message body
     *
     * @param  SoapBodyInterface $body
     * @return self
     */
    public function setBody(SoapBodyInterface $body): self
    {
        $this->body = $body;
        return $this;
    }
}

class FooBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("FooRequest")
     * @Type("Zimbra\Tests\Common\Soap\FooRequest")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("FooResponse")
     * @Type("Zimbra\Tests\Common\Soap\FooResponse")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $response;

    /**
     * Constructor
     *
     * @return self
     */
    public function __construct(
        ?FooRequest $request = NULL, ?FooResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof FooRequest) {
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
        if ($response instanceof FooResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?SoapResponseInterface
    {
        return $this->response;
    }
}

class FooRequest extends SoapRequest
{
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new FooEnvelope(
            new FooBody($this)
        );
    }
}

class FooResponse implements SoapResponseInterface
{
}
