<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetCurrentVolumesBody;
use Zimbra\Admin\Message\GetCurrentVolumesEnvelope;
use Zimbra\Admin\Message\GetCurrentVolumesRequest;
use Zimbra\Admin\Message\GetCurrentVolumesResponse;
use Zimbra\Admin\Struct\CurrentVolumeInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetCurrentVolumesTest.
 */
class GetCurrentVolumesTest extends ZimbraTestCase
{
    public function testGetCurrentVolumes()
    {
        $type = $this->faker->randomNumber;
        $id = $this->faker->randomNumber;

        $volume = new CurrentVolumeInfo($type, $id);

        $request = new GetCurrentVolumesRequest();

        $response = new GetCurrentVolumesResponse([$volume]);
        $this->assertSame([$volume], $response->getVolumes());
        $response = new GetCurrentVolumesResponse();
        $response->setVolumes([$volume]);
        $this->assertSame([$volume], $response->getVolumes());

        $body = new GetCurrentVolumesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetCurrentVolumesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetCurrentVolumesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetCurrentVolumesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetCurrentVolumesRequest />
        <urn:GetCurrentVolumesResponse>
            <urn:volume type="$type" id="$id" />
        </urn:GetCurrentVolumesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetCurrentVolumesEnvelope::class, 'xml'));
    }
}
