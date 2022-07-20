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
        $id = $this->faker->randomNumber;
        $type = $this->faker->randomElement(VolumeType::toArray());
        $threshold = $this->faker->randomNumber;
        $mgbits = $this->faker->randomNumber;
        $mbits = $this->faker->randomNumber;
        $fgbits = $this->faker->randomNumber;
        $fbits = $this->faker->randomNumber;
        $name = $this->faker->word;
        $rootPath = $this->faker->word;

        $volume = new VolumeInfo(
            $id, $name, $rootPath, $type, TRUE, $threshold, $mgbits, $mbits, $fgbits, $fbits, TRUE
        );

        $request = new GetVolumeRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new GetVolumeRequest();
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new GetVolumeResponse($volume);
        $this->assertSame($volume, $response->getVolume());
        $response = new GetVolumeResponse();
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
            <urn:volume id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="true" />
        </urn:GetVolumeResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetVolumeEnvelope::class, 'xml'));
    }
}
