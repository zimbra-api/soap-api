<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateAlwaysOnClusterBody;
use Zimbra\Admin\Message\CreateAlwaysOnClusterEnvelope;
use Zimbra\Admin\Message\CreateAlwaysOnClusterRequest;
use Zimbra\Admin\Message\CreateAlwaysOnClusterResponse;
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateAlwaysOnCluster.
 */
class CreateAlwaysOnClusterTest extends ZimbraTestCase
{
    public function testCreateAlwaysOnCluster()
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
        $this->assertSame($name, $request->getName());
        $request = new CreateAlwaysOnClusterRequest('');
        $request->setName($name)
            ->setAttrs([$attr]);
        $this->assertSame($name, $request->getName());

        $response = new CreateAlwaysOnClusterResponse($cluster);
        $this->assertSame($cluster, $response->getAlwaysOnCluster());
        $response = new CreateAlwaysOnClusterResponse();
        $response->setAlwaysOnCluster($cluster);
        $this->assertSame($cluster, $response->getAlwaysOnCluster());

        $body = new CreateAlwaysOnClusterBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateAlwaysOnClusterBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateAlwaysOnClusterEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateAlwaysOnClusterEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateAlwaysOnClusterRequest name="$name">
            <urn:a n="$key">$value</urn:a>
        </urn:CreateAlwaysOnClusterRequest>
        <urn:CreateAlwaysOnClusterResponse>
            <urn:alwaysOnCluster name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:alwaysOnCluster>
        </urn:CreateAlwaysOnClusterResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateAlwaysOnClusterEnvelope::class, 'xml'));
    }
}
