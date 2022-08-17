<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\NetworkInformation;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NetworkInformation.
 */
class NetworkInformationTest extends ZimbraTestCase
{
    public function testNetworkInformation()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $ni = new StubNetworkInformation([new Attr($key, $value)]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ni, 'xml'));
        $this->assertEquals($ni, $this->serializer->deserialize($xml, StubNetworkInformation::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubNetworkInformation extends NetworkInformation
{
}
