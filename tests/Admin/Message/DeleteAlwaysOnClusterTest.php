<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteAlwaysOnClusterBody;
use Zimbra\Admin\Message\DeleteAlwaysOnClusterEnvelope;
use Zimbra\Admin\Message\DeleteAlwaysOnClusterRequest;
use Zimbra\Admin\Message\DeleteAlwaysOnClusterResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteAlwaysOnCluster.
 */
class DeleteAlwaysOnClusterTest extends ZimbraTestCase
{
    public function testDeleteAlwaysOnCluster()
    {
        $id = $this->faker->uuid;
        $request = new DeleteAlwaysOnClusterRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new DeleteAlwaysOnClusterRequest('');
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new DeleteAlwaysOnClusterResponse();

        $body = new DeleteAlwaysOnClusterBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteAlwaysOnClusterBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteAlwaysOnClusterEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteAlwaysOnClusterEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteAlwaysOnClusterRequest id="$id" />
        <urn:DeleteAlwaysOnClusterResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteAlwaysOnClusterEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteAlwaysOnClusterRequest' => [
                    'id' => $id,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteAlwaysOnClusterResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteAlwaysOnClusterEnvelope::class, 'json'));
    }
}
