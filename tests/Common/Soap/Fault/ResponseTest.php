<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap\Fault;

use JMS\Serializer\Annotation\XmlNamespace;
use Zimbra\Common\Soap\Fault\Code;
use Zimbra\Common\Soap\Fault\Reason;
use Zimbra\Common\Soap\Fault\Response;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Response.
 */
class ResponseTest extends ZimbraTestCase
{
    public function testFaultResponse()
    {
        $value = $this->faker->word;
        $text = $this->faker->text;
        $code = new Code();
        $code->setValue($value);
        $reason = new Reason();
        $reason->setText($text);

        $response = new MockResponse();
        $response->setCode($code)->setReason($reason);
        $this->assertSame($code, $response->getCode());
        $this->assertSame($reason, $response->getReason());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:soap="http://www.w3.org/2003/05/soap-envelope">
    <soap:Code>
        <soap:Value>$value</soap:Value>
    </soap:Code>
    <soap:Reason>
        <soap:Text>$text</soap:Text>
    </soap:Reason>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($response, 'xml'));
        $this->assertEquals($response, $this->serializer->deserialize($xml, MockResponse::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="http://www.w3.org/2003/05/soap-envelope", prefix="soap")
 */
class MockResponse extends Response
{
}
