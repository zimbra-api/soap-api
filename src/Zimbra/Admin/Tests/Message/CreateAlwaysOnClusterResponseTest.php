<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateAlwaysOnClusterResponse;
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAlwaysOnClusterResponse.
 */
class CreateAlwaysOnClusterResponseTest extends ZimbraStructTestCase
{
    public function testCreateAlwaysOnClusterResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $cluster = new AlwaysOnClusterInfo($name, $id, [$attr]);

        $res = new CreateAlwaysOnClusterResponse($cluster);
        $this->assertEquals($cluster, $res->getAlwaysOnCluster());

        $res = new CreateAlwaysOnClusterResponse();
        $res->setAlwaysOnCluster($cluster);
        $this->assertEquals($cluster, $res->getAlwaysOnCluster());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAlwaysOnClusterResponse>'
                . '<alwaysOnCluster name="' . $name . '" id="' . $id . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</alwaysOnCluster>'
            . '</CreateAlwaysOnClusterResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CreateAlwaysOnClusterResponse::class, 'xml'));

        $json = json_encode([
            'alwaysOnCluster' => [
                'name' => $name,
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CreateAlwaysOnClusterResponse::class, 'json'));
    }
}
