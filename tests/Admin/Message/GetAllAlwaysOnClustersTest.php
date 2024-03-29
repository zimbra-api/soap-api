<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllAlwaysOnClustersBody;
use Zimbra\Admin\Message\GetAllAlwaysOnClustersEnvelope;
use Zimbra\Admin\Message\GetAllAlwaysOnClustersRequest;
use Zimbra\Admin\Message\GetAllAlwaysOnClustersResponse;
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllAlwaysOnClustersTest.
 */
class GetAllAlwaysOnClustersTest extends ZimbraTestCase
{
    public function testGetAllAlwaysOnClusters()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $cluster = new AlwaysOnClusterInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetAllAlwaysOnClustersRequest();

        $response = new GetAllAlwaysOnClustersResponse([$cluster]);
        $this->assertSame([$cluster], $response->getAlwaysOnClusterList());
        $response = new GetAllAlwaysOnClustersResponse();
        $response->setAlwaysOnClusterList([$cluster]);
        $this->assertSame([$cluster], $response->getAlwaysOnClusterList());

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

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllAlwaysOnClustersRequest />
        <urn:GetAllAlwaysOnClustersResponse>
            <urn:alwaysOnCluster name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:alwaysOnCluster>
        </urn:GetAllAlwaysOnClustersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllAlwaysOnClustersEnvelope::class, 'xml'));
    }
}
