<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\DeleteCosBody;
use Zimbra\Admin\Message\DeleteCosEnvelope;
use Zimbra\Admin\Message\DeleteCosRequest;
use Zimbra\Admin\Message\DeleteCosResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DeleteCos.
 */
class DeleteCosTest extends ZimbraStructTestCase
{
    public function testDeleteCos()
    {
        $id = $this->faker->uuid;
        $request = new DeleteCosRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new DeleteCosRequest('');
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new DeleteCosResponse();

        $body = new DeleteCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteCosEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteCosRequest>
            <id>$id</id>
        </urn:DeleteCosRequest>
        <urn:DeleteCosResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteCosEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteCosRequest' => [
                    'id' => [
                        '_content' => $id,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteCosResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteCosEnvelope::class, 'json'));
    }
}
