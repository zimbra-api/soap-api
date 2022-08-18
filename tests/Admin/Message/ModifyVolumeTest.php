<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyVolumeBody;
use Zimbra\Admin\Message\ModifyVolumeEnvelope;
use Zimbra\Admin\Message\ModifyVolumeRequest;
use Zimbra\Admin\Message\ModifyVolumeResponse;
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Common\Enum\VolumeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyVolume.
 */
class ModifyVolumeTest extends ZimbraTestCase
{
    public function testModifyVolume()
    {
        $id = $this->faker->randomNumber;
        $type = $this->faker->randomElement(array_map(static fn ($type) => $type->value, VolumeType::cases()));
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

        $request = new ModifyVolumeRequest($volume, $id);
        $this->assertSame($id, $request->getId());
        $this->assertEquals($volume, $request->getVolume());
        $request = new ModifyVolumeRequest(new VolumeInfo());
        $request->setId($id)
            ->setVolume($volume);
        $this->assertSame($id, $request->getId());
        $this->assertEquals($volume, $request->getVolume());

        $response = new ModifyVolumeResponse();

        $body = new ModifyVolumeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyVolumeBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyVolumeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyVolumeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyVolumeRequest id="$id">
            <urn:volume id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="true" />
        </urn:ModifyVolumeRequest>
        <urn:ModifyVolumeResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyVolumeEnvelope::class, 'xml'));
    }
}
