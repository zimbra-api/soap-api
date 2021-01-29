<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteVolumeBody;
use Zimbra\Admin\Message\DeleteVolumeEnvelope;
use Zimbra\Admin\Message\DeleteVolumeRequest;
use Zimbra\Admin\Message\DeleteVolumeResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteVolume.
 */
class DeleteVolumeTest extends ZimbraTestCase
{
    public function testDeleteVolume()
    {
        $id = mt_rand(1, 100);
        $request = new DeleteVolumeRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new DeleteVolumeRequest(0);
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new DeleteVolumeResponse();

        $body = new DeleteVolumeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteVolumeBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteVolumeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteVolumeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteVolumeRequest id="$id" />
        <urn:DeleteVolumeResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteVolumeEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteVolumeRequest' => [
                    'id' => $id,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteVolumeResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteVolumeEnvelope::class, 'json'));
    }
}
