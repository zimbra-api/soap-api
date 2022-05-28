<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetVolumeBody;
use Zimbra\Admin\Message\GetVolumeEnvelope;
use Zimbra\Admin\Message\GetVolumeRequest;
use Zimbra\Admin\Message\GetVolumeResponse;
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Common\Enum\VolumeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetVolume.
 */
class GetVolumeTest extends ZimbraTestCase
{
    public function testGetVolume()
    {
        $id = mt_rand(0, 10);
        $type = $this->faker->randomElement(VolumeType::toArray());
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = $this->faker->word;
        $rootPath = $this->faker->word;

        $volume = new VolumeInfo(
            $id, $name, $rootPath, $type, TRUE, $threshold, $mgbits, $mbits, $fgbits, $fbits, TRUE
        );

        $request = new GetVolumeRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new GetVolumeRequest(0);
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new GetVolumeResponse($volume);
        $this->assertSame($volume, $response->getVolume());
        $response = new GetVolumeResponse(new VolumeInfo());
        $response->setVolume($volume);
        $this->assertSame($volume, $response->getVolume());

        $body = new GetVolumeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetVolumeBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetVolumeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetVolumeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetVolumeRequest id="$id" />
        <urn:GetVolumeResponse>
            <volume id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="true" />
        </urn:GetVolumeResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetVolumeEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetVolumeRequest' => [
                    'id' => $id,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetVolumeResponse' => [
                    'volume' => [
                        'id' => $id,
                        'name' => $name,
                        'rootpath' => $rootPath,
                        'type' => $type,
                        'compressBlobs' => TRUE,
                        'compressionThreshold' => $threshold,
                        'mgbits' => $mgbits,
                        'mbits' => $mbits,
                        'fgbits' => $fgbits,
                        'fbits' => $fbits,
                        'isCurrent' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetVolumeEnvelope::class, 'json'));
    }
}
