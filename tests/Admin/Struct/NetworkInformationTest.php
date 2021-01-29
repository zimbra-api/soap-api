<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\NetworkInformation;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for NetworkInformation.
 */
class NetworkInformationTest extends ZimbraStructTestCase
{
    public function testNetworkInformation()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $ni = new NetworkInformation([new Attr($key, $value)]);

        $xml = <<<EOT
<?xml version="1.0"?>
<ni>
    <a n="$key">$value</a>
</ni>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ni, 'xml'));
        $this->assertEquals($ni, $this->serializer->deserialize($xml, NetworkInformation::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($ni, 'json'));
        $this->assertEquals($ni, $this->serializer->deserialize($json, NetworkInformation::class, 'json'));
    }
}
