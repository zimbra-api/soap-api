<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\BootstrapMobileGatewayAppResponse;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for BootstrapMobileGatewayAppResponse.
 */
class BootstrapMobileGatewayAppResponseTest extends ZimbraStructTestCase
{
    public function testBootstrapMobileGatewayAppResponse()
    {
        $appId = $this->faker->word;
        $appKey = $this->faker->word;
        $value = $this->faker->word;
        $lifetime = mt_rand(1, 100);
        $authToken = new AuthToken($value, TRUE, $lifetime);

        $res = new BootstrapMobileGatewayAppResponse(
            $appId,
            $appKey,
            $authToken
        );
        $this->assertSame($appId, $res->getAppId());
        $this->assertSame($appKey, $res->getAppKey());
        $this->assertSame($authToken, $res->getAuthToken());

        $res = new BootstrapMobileGatewayAppResponse('', '');
        $res->setAppId($appId)
            ->setAppKey($appKey)
            ->setAuthToken($authToken);
        $this->assertSame($appId, $res->getAppId());
        $this->assertSame($appKey, $res->getAppKey());
        $this->assertSame($authToken, $res->getAuthToken());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<BootstrapMobileGatewayAppResponse xmlns="urn:zimbraAccount">'
                . '<appId>' . $appId . '</appId>'
                . '<appKey>' . $appKey . '</appKey>'
                . '<authToken verifyAccount="true" lifetime="' . $lifetime . '">' . $value . '</authToken>'
            . '</BootstrapMobileGatewayAppResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, BootstrapMobileGatewayAppResponse::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, BootstrapMobileGatewayAppResponse::class, 'json'));
    }
}
