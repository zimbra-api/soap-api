<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SetCurrentVolumeBody;
use Zimbra\Admin\Message\SetCurrentVolumeEnvelope;
use Zimbra\Admin\Message\SetCurrentVolumeRequest;
use Zimbra\Admin\Message\SetCurrentVolumeResponse;
use Zimbra\Enum\VolumeType;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for SetCurrentVolumeTest.
 */
class SetCurrentVolumeTest extends ZimbraStructTestCase
{
    public function testSetCurrentVolume()
    {
        $id = mt_rand(1, 10);
        $type = VolumeType::PRIMARY()->getValue();

        $request = new SetCurrentVolumeRequest($id, $type);
        $this->assertSame($id, $request->getId());
        $this->assertSame($type, $request->getType());

        $request = new SetCurrentVolumeRequest(0, VolumeType::SECONDARY()->getValue());
        $request->setId($id)
            ->setType($type);
        $this->assertSame($id, $request->getId());
        $this->assertSame($type, $request->getType());

        $response = new SetCurrentVolumeResponse();

        $body = new SetCurrentVolumeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SetCurrentVolumeBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SetCurrentVolumeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SetCurrentVolumeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SetCurrentVolumeRequest id="$id" type="$type" />
        <urn:SetCurrentVolumeResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetCurrentVolumeEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'SetCurrentVolumeRequest' => [
                    'id' => $id,
                    'type' => $type,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'SetCurrentVolumeResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, SetCurrentVolumeEnvelope::class, 'json'));
    }
}
