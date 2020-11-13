<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AuthResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthResponse.
 */
class AuthResponseTest extends ZimbraStructTestCase
{
    public function testAuthResponse()
    {
        $authToken = $this->faker->uuid;
        $csrfToken = $this->faker->uuid;
        $lifetime = mt_rand(1, 100);

        $res = new AuthResponse(
            $authToken,
            $csrfToken,
            $lifetime
        );
        $this->assertSame($authToken, $res->getAuthToken());
        $this->assertSame($csrfToken, $res->getCsrfToken());
        $this->assertSame($lifetime, $res->getLifetime());

        $res = new AuthResponse();
        $res->setAuthToken($authToken)
            ->setCsrfToken($csrfToken)
            ->setLifetime($lifetime);
        $this->assertSame($authToken, $res->getAuthToken());
        $this->assertSame($lifetime, $res->getLifetime());
        $this->assertSame($csrfToken, $res->getCsrfToken());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthResponse>'
                . '<authToken>' . $authToken . '</authToken>'
                . '<csrfToken>' . $csrfToken . '</csrfToken>'
                . '<lifetime>' . $lifetime . '</lifetime>'
            . '</AuthResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AuthResponse::class, 'xml'));

        $json = json_encode([
            'authToken' => [
                '_content' => $authToken,
            ],
            'csrfToken' => [
                '_content' => $csrfToken,
            ],
            'lifetime' => [
                '_content' => $lifetime,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AuthResponse::class, 'json'));
    }
}
