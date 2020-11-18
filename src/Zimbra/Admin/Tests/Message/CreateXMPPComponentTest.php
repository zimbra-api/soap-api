<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateXMPPComponentBody;
use Zimbra\Admin\Message\CreateXMPPComponentEnvelope;
use Zimbra\Admin\Message\CreateXMPPComponentRequest;
use Zimbra\Admin\Message\CreateXMPPComponentResponse;
use Zimbra\Admin\Struct\XMPPComponentSpec;
use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Enum\VolumeType;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateXMPPComponent.
 */
class CreateXMPPComponentTest extends ZimbraStructTestCase
{
    public function testCreateXMPPComponent()
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

        $request = new CreateXMPPComponentRequest($volume);
        $this->assertSame($volume, $request->getVolume());
        $request = new CreateXMPPComponentRequest(new VolumeInfo());
        $request->setVolume($volume);
        $this->assertSame($volume, $request->getVolume());

        $response = new CreateXMPPComponentResponse($volume);
        $this->assertSame($volume, $response->getVolume());
        $response = new CreateXMPPComponentResponse();
        $response->setVolume($volume);
        $this->assertSame($volume, $response->getVolume());

        $body = new CreateXMPPComponentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateXMPPComponentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateXMPPComponentEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateXMPPComponentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateXMPPComponentRequest>'
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
                    . '</urn:CreateXMPPComponentRequest>'
                    . '<urn:CreateXMPPComponentResponse>'
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
                    . '</urn:CreateXMPPComponentResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateXMPPComponentEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateXMPPComponentRequest' => [
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
                'CreateXMPPComponentResponse' => [
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateXMPPComponentEnvelope::class, 'json'));
    }
}
