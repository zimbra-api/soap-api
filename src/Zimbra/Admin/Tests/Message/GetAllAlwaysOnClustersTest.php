<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllAlwaysOnClustersBody;
use Zimbra\Admin\Message\GetAllAlwaysOnClustersEnvelope;
use Zimbra\Admin\Message\GetAllAlwaysOnClustersRequest;
use Zimbra\Admin\Message\GetAllAlwaysOnClustersResponse;
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllAlwaysOnClustersTest.
 */
class GetAllAlwaysOnClustersTest extends ZimbraStructTestCase
{
    public function testGetAllAlwaysOnClusters()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $cluster = new AlwaysOnClusterInfo($name, $id, [$attr]);

        $request = new GetAllAlwaysOnClustersRequest();

        $response = new GetAllAlwaysOnClustersResponse([$cluster]);
        $this->assertSame([$cluster], $response->getAlwaysOnClusterList());
        $response = new GetAllAlwaysOnClustersResponse();
        $response->setAlwaysOnClusterList([$cluster])
            ->addAlwaysOnCluster($cluster);
        $this->assertSame([$cluster, $cluster], $response->getAlwaysOnClusterList());
        $response->setAlwaysOnClusterList([$cluster]);

        $body = new GetAllAlwaysOnClustersBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllAlwaysOnClustersBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllAlwaysOnClustersEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllAlwaysOnClustersEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetAllAlwaysOnClustersRequest />'
                    . '<urn:GetAllAlwaysOnClustersResponse>'
                        . '<alwaysOnCluster name="' . $name . '" id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</alwaysOnCluster>'
                    . '</urn:GetAllAlwaysOnClustersResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllAlwaysOnClustersEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllAlwaysOnClustersRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllAlwaysOnClustersResponse' => [
                    'alwaysOnCluster' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllAlwaysOnClustersEnvelope::class, 'json'));
    }
}
