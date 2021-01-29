<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetAlwaysOnClusterBody, GetAlwaysOnClusterEnvelope, GetAlwaysOnClusterRequest, GetAlwaysOnClusterResponse};
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\AlwaysOnClusterSelector;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\AlwaysOnClusterBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAlwaysOnCluster.
 */
class GetAlwaysOnClusterTest extends ZimbraTestCase
{
    public function testGetAlwaysOnCluster()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $attr1 = $this->faker->word;
        $attr2 = $this->faker->word;
        $attr3 = $this->faker->word;
        $attrs = implode(',', [$attr1, $attr2, $attr3]);

        $clusterSel = new AlwaysOnClusterSelector(AlwaysOnClusterBy::NAME(), $value);
        $clusterInfo = new AlwaysOnClusterInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetAlwaysOnClusterRequest($clusterSel, $attrs);
        $this->assertSame($clusterSel, $request->getAlwaysOnCluster());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetAlwaysOnClusterRequest();
        $request->setAlwaysOnCluster($clusterSel)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($clusterSel, $request->getAlwaysOnCluster());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetAlwaysOnClusterResponse(
            $clusterInfo
        );
        $this->assertSame($clusterInfo, $response->getAlwaysOnCluster());
        $response = new GetAlwaysOnClusterResponse();
        $response->setAlwaysOnCluster($clusterInfo);
        $this->assertSame($clusterInfo, $response->getAlwaysOnCluster());

        $body = new GetAlwaysOnClusterBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAlwaysOnClusterBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAlwaysOnClusterEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAlwaysOnClusterEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAlwaysOnClusterRequest attrs="$attrs">
            <alwaysOnCluster by="name">$value</alwaysOnCluster>
        </urn:GetAlwaysOnClusterRequest>
        <urn:GetAlwaysOnClusterResponse>
            <alwaysOnCluster name="$name" id="$id">
                <a n="$key">$value</a>
            </alwaysOnCluster>
        </urn:GetAlwaysOnClusterResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAlwaysOnClusterEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAlwaysOnClusterRequest' => [
                    'attrs' => $attrs,
                    'alwaysOnCluster' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAlwaysOnClusterResponse' => [
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
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAlwaysOnClusterEnvelope::class, 'json'));
    }
}
