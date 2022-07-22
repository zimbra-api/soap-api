<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap\Fault;

use Zimbra\Common\Soap\Fault\Body;
use Zimbra\Common\Soap\Fault\Code;
use Zimbra\Common\Soap\Fault\Envelope;
use Zimbra\Common\Soap\Fault\Reason;
use Zimbra\Common\Soap\Fault\Response;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Envelope.
 */
class EnvelopeTest extends ZimbraTestCase
{
    public function testFaultEnvelope()
    {
        $value = $this->faker->word;
        $text = $this->faker->text;
        $code = new Code();
        $code->setValue($value);
        $reason = new Reason();
        $reason->setText($text);
        $response = new Response();
        $response->setCode($code)->setReason($reason);
        $body = new Body();
        $body->setSoapFault($response);

        $envelope = new Envelope();
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
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, Envelope::class, 'xml'));
    }
}
