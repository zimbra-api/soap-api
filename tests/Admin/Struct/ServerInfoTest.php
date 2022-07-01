<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ServerInfo.
 */
class ServerInfoTest extends ZimbraTestCase
{
    public function testServerInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $server = new StubServerInfo($name, $id, [new Attr($key, $value)]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, StubServerInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubServerInfo extends ServerInfo
{
}
