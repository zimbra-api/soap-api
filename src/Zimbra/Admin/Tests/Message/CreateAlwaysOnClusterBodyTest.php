<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateAlwaysOnClusterBody;
use Zimbra\Admin\Message\CreateAlwaysOnClusterRequest;
use Zimbra\Admin\Message\CreateAlwaysOnClusterResponse;
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAlwaysOnClusterBody.
 */
class CreateAlwaysOnClusterBodyTest extends ZimbraStructTestCase
{
    public function testCreateAlwaysOnClusterBody()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $cluster = new AlwaysOnClusterInfo($name, $id, [$attr]);

        $request = new CreateAlwaysOnClusterRequest(
            $name, [$attr]
        );
        $response = new CreateAlwaysOnClusterResponse($cluster);

        $body = new CreateAlwaysOnClusterBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateAlwaysOnClusterBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CreateAlwaysOnClusterRequest name="' . $name . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CreateAlwaysOnClusterRequest>'
                . '<urn:CreateAlwaysOnClusterResponse>'
                    . '<alwaysOnCluster name="' . $name . '" id="' . $id . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</alwaysOnCluster>'
                . '</urn:CreateAlwaysOnClusterResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CreateAlwaysOnClusterBody::class, 'xml'));

        $json = json_encode([
            'CreateAlwaysOnClusterRequest' => [
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CreateAlwaysOnClusterResponse' => [
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
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CreateAlwaysOnClusterBody::class, 'json'));
    }
}
