<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $server = new ServerInfo($name, $id, [new Attr($key, $value)]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id">
    <a n="$key">$value</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, ServerInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($server, 'json'));
        $this->assertEquals($server, $this->serializer->deserialize($json, ServerInfo::class, 'json'));
    }
}
