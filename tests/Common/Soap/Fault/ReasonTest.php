<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap\Fault;

use JMS\Serializer\Annotation\XmlNamespace;
use Zimbra\Common\Soap\Fault\Reason;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Reason.
 */
class ReasonTest extends ZimbraTestCase
{
    public function testFaultReason()
    {
        $text = $this->faker->text;
        $reason = new MockReason();
        $reason->setText($text);
        $this->assertSame($text, $reason->getText());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:soap="http://www.w3.org/2003/05/soap-envelope"><soap:Text>$text</soap:Text></result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($reason, 'xml'));
        $this->assertEquals($reason, $this->serializer->deserialize($xml, MockReason::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="http://www.w3.org/2003/05/soap-envelope", prefix="soap")
 */
class MockReason extends Reason
{
}
