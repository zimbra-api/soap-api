<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\ChangePasswordResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePasswordResponse.
 */
class ChangePasswordResponseTest extends ZimbraStructTestCase
{
    public function testChangePasswordResponse()
    {
        $authToken = $this->faker->word;
        $lifetime = mt_rand(1, 100);

        $res = new ChangePasswordResponse(
            $authToken,
            $lifetime
        );
        $this->assertSame($authToken, $res->getAuthToken());
        $this->assertSame($lifetime, $res->getLifetime());

        $res = new ChangePasswordResponse('', 0);
        $res->setAuthToken($authToken)
            ->setLifetime($lifetime);
        $this->assertSame($authToken, $res->getAuthToken());
        $this->assertSame($lifetime, $res->getLifetime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ChangePasswordResponse xmlns="urn:zimbraAccount">'
                . '<authToken>' . $authToken . '</authToken>'
                . '<lifetime>' . $lifetime . '</lifetime>'
            . '</ChangePasswordResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, ChangePasswordResponse::class, 'xml'));

        $json = json_encode([
            'authToken' => [
                '_content' => $authToken,
            ],
            'lifetime' => [
                '_content' => $lifetime,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, ChangePasswordResponse::class, 'json'));
    }
}
