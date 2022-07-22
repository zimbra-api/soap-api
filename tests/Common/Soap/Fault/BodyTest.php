<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap\Fault;

use JMS\Serializer\Annotation\XmlNamespace;
use Zimbra\Common\Soap\Fault\Body;
use Zimbra\Common\Soap\Fault\Code;
use Zimbra\Common\Soap\Fault\Reason;
use Zimbra\Common\Soap\Fault\Response;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Body.
 */
class BodyTest extends ZimbraTestCase
{
    public function testFaultBody()
    {
        $value = $this->faker->word;
        $text = $this->faker->text;
        $code = new Code();
        $code->setValue($value);
        $reason = new Reason();
        $reason->setText($text);
        $response = new Response();
        $response->setCode($code)->setReason($reason);

        $body = new MockBody();
        $body->setSoapFault($response);
        $this->assertSame($response, $body->getSoapFault());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:soap="http://www.w3.org/2003/05/soap-envelope">
    <soap:Fault>
        <soap:Code>
            <soap:Value>$value</soap:Value>
        </soap:Code>
        <soap:Reason>
            <soap:Text>$text</soap:Text>
        </soap:Reason>
    </soap:Fault>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, MockBody::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="http://www.w3.org/2003/05/soap-envelope", prefix="soap")
 */
class MockBody extends Body
{
}
