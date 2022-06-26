<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyAlwaysOnClusterBody;
use Zimbra\Admin\Message\ModifyAlwaysOnClusterEnvelope;
use Zimbra\Admin\Message\ModifyAlwaysOnClusterRequest;
use Zimbra\Admin\Message\ModifyAlwaysOnClusterResponse;
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyAlwaysOnCluster.
 */
class ModifyAlwaysOnClusterTest extends ZimbraTestCase
{
    public function testModifyAlwaysOnCluster()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->name;

        $cluster = new AlwaysOnClusterInfo($name, $id, [new Attr($key, $value)]);

        $request = new ModifyAlwaysOnClusterRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new ModifyAlwaysOnClusterRequest('');
        $request->setId($id)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($id, $request->getId());

        $response = new ModifyAlwaysOnClusterResponse($cluster);
        $this->assertEquals($cluster, $response->getAlwaysOnCluster());
        $response = new ModifyAlwaysOnClusterResponse(new AlwaysOnClusterInfo('', ''));
        $response->setAlwaysOnCluster($cluster);
        $this->assertEquals($cluster, $response->getAlwaysOnCluster());

        $body = new ModifyAlwaysOnClusterBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyAlwaysOnClusterBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyAlwaysOnClusterEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyAlwaysOnClusterEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyAlwaysOnClusterRequest id="$id">
            <urn:a n="$key">$value</urn:a>
        </urn:ModifyAlwaysOnClusterRequest>
        <urn:ModifyAlwaysOnClusterResponse>
            <urn:alwaysOnCluster name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:alwaysOnCluster>
        </urn:ModifyAlwaysOnClusterResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyAlwaysOnClusterEnvelope::class, 'xml'));
    }
}
