<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\BootstrapMobileGatewayAppBody;
use Zimbra\Account\Message\BootstrapMobileGatewayAppRequest;
use Zimbra\Account\Message\BootstrapMobileGatewayAppResponse;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for BootstrapMobileGatewayAppBody.
 */
class BootstrapMobileGatewayAppBodyTest extends ZimbraStructTestCase
{
    public function testBootstrapMobileGatewayAppBody()
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
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new BootstrapMobileGatewayAppBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAccount">'
                . '<urn:BootstrapMobileGatewayAppRequest wantAppToken="true" />'
                . '<urn:BootstrapMobileGatewayAppResponse>'
                    . '<appId>' . $appId . '</appId>'
                    . '<appKey>' . $appKey . '</appKey>'
                    . '<authToken verifyAccount="true" lifetime="' . $lifetime . '">' . $value . '</authToken>'
                . '</urn:BootstrapMobileGatewayAppResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, BootstrapMobileGatewayAppBody::class, 'xml'));

        $json = json_encode([
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
        ]);

        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, BootstrapMobileGatewayAppBody::class, 'json'));
    }
}
