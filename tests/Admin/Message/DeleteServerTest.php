<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteServerBody;
use Zimbra\Admin\Message\DeleteServerEnvelope;
use Zimbra\Admin\Message\DeleteServerRequest;
use Zimbra\Admin\Message\DeleteServerResponse;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for DeleteServer.
 */
class DeleteServerTest extends ZimbraStructTestCase
{
    public function testDeleteServer()
    {
        $id = $this->faker->uuid;
        $request = new DeleteServerRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new DeleteServerRequest('');
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new DeleteServerResponse();

        $body = new DeleteServerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteServerBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteServerEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteServerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteServerRequest id="$id" />
        <urn:DeleteServerResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteServerEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteServerRequest' => [
                    'id' => $id,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteServerResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteServerEnvelope::class, 'json'));
    }
}
