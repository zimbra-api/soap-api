<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap\Fault;

use JMS\Serializer\Annotation\XmlNamespace;
use Zimbra\Common\Soap\Fault\Code;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Code.
 */
class CodeTest extends ZimbraTestCase
{
    public function testFaultCode()
    {
        $value = $this->faker->word;
        $code = new MockCode();
        $code->setValue($value);
        $this->assertSame($value, $code->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:soap="http://www.w3.org/2003/05/soap-envelope"><soap:Value>$value</soap:Value></result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($code, 'xml'));
        $this->assertEquals($code, $this->serializer->deserialize($xml, MockCode::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="http://www.w3.org/2003/05/soap-envelope", prefix="soap")
 */
class MockCode extends Code
{
}
