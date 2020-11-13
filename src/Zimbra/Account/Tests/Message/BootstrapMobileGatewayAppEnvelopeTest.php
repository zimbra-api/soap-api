<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\BootstrapMobileGatewayAppEnvelope;
use Zimbra\Account\Message\BootstrapMobileGatewayAppBody;
use Zimbra\Account\Message\BootstrapMobileGatewayAppRequest;
use Zimbra\Account\Message\BootstrapMobileGatewayAppResponse;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for BootstrapMobileGatewayAppEnvelope.
 */
class BootstrapMobileGatewayAppEnvelopeTest extends ZimbraStructTestCase
{
    public function testBootstrapMobileGatewayAppEnvelope()
    {
        $request = new BootstrapMobileGatewayAppRequest(TRUE);

        $appId = $this->faker->word;
        $appKey = $this->faker->word;
        $value = $this->faker->word;
        $lifetime = mt_rand(1, 100);
        $authToken = new AuthToken($value, TRUE, $lifetime);
        $response = new BootstrapMobileGatewayAppResponse(
            $appId,
            $appKey,
            $authToken
        );

        $body = new BootstrapMobileGatewayAppBody($request, $response);

        $envelope = new BootstrapMobileGatewayAppEnvelope(NULL, $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new BootstrapMobileGatewayAppEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">'
                . '<soap:Body>'
                    . '<urn:BootstrapMobileGatewayAppRequest wantAppToken="true" />'
                    . '<urn:BootstrapMobileGatewayAppResponse>'
                        . '<appId>' . $appId . '</appId>'
                        . '<appKey>' . $appKey . '</appKey>'
                        . '<authToken verifyAccount="true" lifetime="' . $lifetime . '">' . $value . '</authToken>'
                    . '</urn:BootstrapMobileGatewayAppResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, BootstrapMobileGatewayAppEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'BootstrapMobileGatewayAppRequest' => [
                    'wantAppToken' => TRUE,
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'BootstrapMobileGatewayAppResponse' => [
                    'appId' => [
                        '_content' => $appId,
                    ],
                    'appKey' => [
                        '_content' => $appKey,
                    ],
                    'authToken' => [
                        '_content' => $value,
                        'verifyAccount' => TRUE,
                        'lifetime' => $lifetime,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, BootstrapMobileGatewayAppEnvelope::class, 'json'));
    }
}
