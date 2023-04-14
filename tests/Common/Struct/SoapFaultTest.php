<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Common\Struct\Fault\{Code, Reason};
use Zimbra\Common\Struct\{
    SoapEnvelope, SoapFault, SoapBody, SoapBodyInterface, SoapRequestInterface, SoapResponseInterface
};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SoapFault.
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

        $soapFault = new SoapFault($code, $reason);
        $this->assertSame($code, $soapFault->getFaultCode());
        $this->assertSame($reason, $soapFault->getFaultReason());
        $soapFault = new SoapFault();
        $soapFault->setFaultCode($code)->setFaultReason($reason);
        $this->assertSame($code, $soapFault->getFaultCode());
        $this->assertSame($reason, $soapFault->getFaultReason());
        $this->assertSame($value, $soapFault->faultCode());
        $this->assertSame($text, $soapFault->faultString());

        $body = new FaultBody();
        $body->setSoapFault($soapFault);
        $this->assertSame($soapFault, $body->getSoapFault());

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
            <soap:Detail>
                <Error xmlns="urn:zimbra">
                    <Code>$value</Code>
                    <Trace>$text</Trace>
                </Error>
            </soap:Detail>
        </soap:Fault>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FaultEnvelope::class, 'xml'));
    }
}

#[XmlRoot(name: 'soap:Envelope')]
class FaultEnvelope extends SoapEnvelope
{
    #[Accessor(getter: 'getBody', setter: 'setBody')]
    #[SerializedName(name: 'Body')]
    #[Type(name: FaultBody::class)]
    #[XmlElement(namespace: 'http://www.w3.org/2003/05/soap-envelope')]
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

class FaultBody extends SoapBody
{
    public function setRequest(SoapRequestInterface $request): self
    {}

    public function getRequest(): ?SoapRequestInterface
    {}

    public function setResponse(SoapResponseInterface $response): self
    {}

    public function getResponse(): ?SoapResponseInterface
    {}
}
