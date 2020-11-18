<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateVolumeBody;
use Zimbra\Admin\Message\CreateVolumeEnvelope;
use Zimbra\Admin\Message\CreateVolumeRequest;
use Zimbra\Admin\Message\CreateVolumeResponse;
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Enum\VolumeType;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateVolume.
 */
class CreateVolumeTest extends ZimbraStructTestCase
{
    public function testCreateVolume()
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

        $envelope = new CreateVolumeEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateVolumeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateVolumeRequest>'
                        . '<volume '
                            . 'id="' . $id . '" '
                            . 'name="' . $name . '" '
                            . 'rootpath="' . $rootPath . '" '
                            . 'type="' . $type . '" '
                            . 'compressBlobs="true" '
                            . 'compressionThreshold="' . $threshold . '" '
                            . 'mgbits="' . $mgbits . '" '
                            . 'mbits="' . $mbits . '" '
                            . 'fgbits="' . $fgbits . '" '
                            . 'fbits="' . $fbits . '" '
                            . 'isCurrent="false" />'
                    . '</urn:CreateVolumeRequest>'
                    . '<urn:CreateVolumeResponse>'
                        . '<volume '
                            . 'id="' . $id . '" '
                            . 'name="' . $name . '" '
                            . 'rootpath="' . $rootPath . '" '
                            . 'type="' . $type . '" '
                            . 'compressBlobs="true" '
                            . 'compressionThreshold="' . $threshold . '" '
                            . 'mgbits="' . $mgbits . '" '
                            . 'mbits="' . $mbits . '" '
                            . 'fgbits="' . $fgbits . '" '
                            . 'fbits="' . $fbits . '" '
                            . 'isCurrent="false" />'
                    . '</urn:CreateVolumeResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateVolumeEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateVolumeRequest' => [
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
                        'isCurrent' => FALSE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateVolumeResponse' => [
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
                        'isCurrent' => FALSE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateVolumeEnvelope::class, 'json'));
    }
}
