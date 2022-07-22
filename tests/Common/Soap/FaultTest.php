<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Common\Soap\Fault\{Code, Reason};
use Zimbra\Common\Soap\{
    Envelope, Fault, Body, BodyInterface, RequestInterface, ResponseInterface
};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Fault.
 */
class FaultTest extends ZimbraTestCase
{
    public function testSoapFault()
    {
        $value = $this->faker->word;
        $text = $this->faker->text;

        $code = new Code();
        $code->setValue($value);
        $this->assertSame($value, $code->getValue());

        $reason = new Reason();
        $reason->setText($text);
        $this->assertSame($text, $reason->getText());

        $fault = new Fault($code, $reason);
        $this->assertSame($code, $fault->getFaultCode());
        $this->assertSame($reason, $fault->getFaultReason());
        $fault = new Fault();
        $fault->setFaultCode($code)->setFaultReason($reason);
        $this->assertSame($code, $fault->getFaultCode());
        $this->assertSame($reason, $fault->getFaultReason());
        $this->assertSame($value, $fault->faultCode());
        $this->assertSame($text, $fault->faultString());

        $body = new FaultBody();
        $body->setFault($fault);
        $this->assertSame($fault, $body->getFault());

        $envelope = new FaultEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">
    <soap:Body>
        <soap:Fault>
            <soap:Code>
                <soap:Value>$value</soap:Value>
            </soap:Code>
            <soap:Reason>
                <soap:Text>$text</soap:Text>
            </soap:Reason>
        </soap:Fault>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FaultEnvelope::class, 'xml'));
    }
}

/**
 * @XmlRoot(name="soap:Envelope")
 */
class FaultEnvelope extends Envelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Tests\Common\Soap\FaultBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $body;

    /**
     * Gets soap message body
     *
     * @return BodyInterface
     */
    public function getBody() : BodyInterface
    {
        return $this->body;
    }

    /**
     * Sets soap message body
     *
     * @param  BodyInterface $body
     * @return self
     */
    public function setBody(BodyInterface $body): Envelope
    {
        $this->body = $body;
        return $this;
    }
}

class FaultBody extends Body
{
    public function setRequest(RequestInterface $request): self
    {}

    public function getRequest(): ?RequestInterface
    {}

    public function setResponse(ResponseInterface $response): self
    {}

    public function getResponse(): ?ResponseInterface
    {}
}
