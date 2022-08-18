<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllVolumesBody;
use Zimbra\Admin\Message\GetAllVolumesEnvelope;
use Zimbra\Admin\Message\GetAllVolumesRequest;
use Zimbra\Admin\Message\GetAllVolumesResponse;
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Common\Enum\VolumeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllVolumesTest.
 */
class GetAllVolumesTest extends ZimbraTestCase
{
    public function testGetAllVolumes()
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
            $id, $name, $rootPath, $type, TRUE, $threshold, $mgbits, $mbits, $fgbits, $fbits, FALSE
        );

        $request = new GetAllVolumesRequest();

        $response = new GetAllVolumesResponse([$volume]);
        $this->assertSame([$volume], $response->getVolumes());
        $response = new GetAllVolumesResponse();
        $response->setVolumes([$volume]);
        $this->assertSame([$volume], $response->getVolumes());

        $body = new GetAllVolumesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllVolumesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllVolumesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllVolumesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllVolumesRequest />
        <urn:GetAllVolumesResponse>
            <urn:volume id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="false" />
        </urn:GetAllVolumesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllVolumesEnvelope::class, 'xml'));
    }
}
