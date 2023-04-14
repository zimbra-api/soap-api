<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateVolumeBody;
use Zimbra\Admin\Message\CreateVolumeEnvelope;
use Zimbra\Admin\Message\CreateVolumeRequest;
use Zimbra\Admin\Message\CreateVolumeResponse;
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Common\Enum\VolumeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateVolume.
 */
class CreateVolumeTest extends ZimbraTestCase
{
    public function testCreateVolume()
    {
        $id = $this->faker->randomNumber;
        $type = $this->faker->randomElement(VolumeType::cases());
        $threshold = $this->faker->randomNumber;
        $mgbits = $this->faker->randomNumber;
        $mbits = $this->faker->randomNumber;
        $fgbits = $this->faker->randomNumber;
        $fbits = $this->faker->randomNumber;
        $name = $this->faker->word;
        $rootPath = $this->faker->word;

        $volume = new VolumeInfo(
            $id, $name, $rootPath, $type, TRUE, $threshold, $mgbits, $mbits, $fgbits, $fbits, FALSE
        );

        $request = new CreateVolumeRequest($volume);
        $this->assertSame($volume, $request->getVolume());
        $request = new CreateVolumeRequest(new VolumeInfo());
        $request->setVolume($volume);
        $this->assertSame($volume, $request->getVolume());

        $response = new CreateVolumeResponse($volume);
        $this->assertSame($volume, $response->getVolume());
        $response = new CreateVolumeResponse();
        $response->setVolume($volume);
        $this->assertSame($volume, $response->getVolume());

        $body = new CreateVolumeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateVolumeBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateVolumeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateVolumeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateVolumeRequest>
            <urn:volume id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="false" />
        </urn:CreateVolumeRequest>
        <urn:CreateVolumeResponse>
            <urn:volume id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="false" />
        </urn:CreateVolumeResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateVolumeEnvelope::class, 'xml'));
    }
}
