<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AuthEnvelope;
use Zimbra\Admin\Message\AuthBody;
use Zimbra\Admin\Message\AuthRequest;
use Zimbra\Admin\Message\AuthResponse;
use Zimbra\Enum\AccountBy;
use Zimbra\Soap\Header;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthResponse.
 */
class AuthResponseTest extends ZimbraStructTestCase
{
    public function testAuthRequest()
    {
        $name = $this->faker->word;
        $password = $this->faker->uuid;
        $value = $this->faker->word;
        $authToken = $this->faker->uuid;
        $virtualHost = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $req = new AuthRequest(
            $name,
            $password,
            $authToken,
            $account,
            $virtualHost,
            FALSE,
            FALSE,
            $twoFactorCode
        );
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertFalse($req->getPersistAuthTokenCookie());
        $this->assertFalse($req->getCsrfSupported());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());

        $req = new AuthRequest();
        $req->setName($name)
            ->setPassword($password)
            ->setAuthToken($authToken)
            ->setAccount($account)
            ->setVirtualHost($virtualHost)
            ->setPersistAuthTokenCookie(TRUE)
            ->setCsrfSupported(TRUE)
            ->setTwoFactorCode($twoFactorCode);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertTrue($req->getPersistAuthTokenCookie());
        $this->assertTrue($req->getCsrfSupported());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true" csrfTokenSecured="true">'
                . '<authToken>' . $authToken . '</authToken>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<virtualHost>' . $virtualHost . '</virtualHost>'
                . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
            . '</AuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AuthRequest::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'password' => $password,
            'authToken' => [
                '_content' => $authToken,
            ],
            'account' => [
                'by' => (string) AccountBy::NAME(),
                '_content' => $value,
            ],
            'virtualHost' => [
                '_content' => $virtualHost,
            ],
            'persistAuthTokenCookie' => TRUE,
            'csrfTokenSecured' => TRUE,
            'twoFactorCode' => [
                '_content' => $twoFactorCode,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AuthRequest::class, 'json'));
    }

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

    public function testAuthBody()
    {
        $name = $this->faker->word;
        $password = $this->faker->uuid;
        $value = $this->faker->word;
        $authToken = $this->faker->uuid;
        $virtualHost = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;
        $csrfToken = $this->faker->uuid;
        $lifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new AuthRequest(
            $name,
            $password,
            $authToken,
            $account,
            $virtualHost,
            TRUE,
            TRUE,
            $twoFactorCode
        );
        $response = new AuthResponse(
            $authToken,
            $csrfToken,
            $lifetime
        );

        $body = new AuthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AuthBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true" csrfTokenSecured="true">'
                    . '<authToken>' . $authToken . '</authToken>'
                    . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                    . '<virtualHost>' . $virtualHost . '</virtualHost>'
                    . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
                . '</urn:AuthRequest>'
                . '<urn:AuthResponse>'
                    . '<authToken>' . $authToken . '</authToken>'
                    . '<csrfToken>' . $csrfToken . '</csrfToken>'
                    . '<lifetime>' . $lifetime . '</lifetime>'
                . '</urn:AuthResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AuthBody::class, 'xml'));

        $json = json_encode([
            'AuthRequest' => [
                'name' => $name,
                'password' => $password,
                'authToken' => [
                    '_content' => $authToken,
                ],
                'account' => [
                    'by' => (string) AccountBy::NAME(),
                    '_content' => $value,
                ],
                'virtualHost' => [
                    '_content' => $virtualHost,
                ],
                'persistAuthTokenCookie' => TRUE,
                'csrfTokenSecured' => TRUE,
                'twoFactorCode' => [
                    '_content' => $twoFactorCode,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AuthResponse' => [
                'authToken' => [
                    '_content' => $authToken,
                ],
                'csrfToken' => [
                    '_content' => $csrfToken,
                ],
                'lifetime' => [
                    '_content' => $lifetime,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);

        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AuthBody::class, 'json'));
    }

    public function testAuthEnvelope()
    {
        $name = $this->faker->word;
        $password = $this->faker->uuid;
        $value = $this->faker->word;
        $authToken = $this->faker->uuid;
        $virtualHost = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;
        $csrfToken = $this->faker->uuid;
        $lifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new AuthRequest(
            $name,
            $password,
            $authToken,
            $account,
            $virtualHost,
            TRUE,
            TRUE,
            $twoFactorCode
        );
        $response = new AuthResponse(
            $authToken,
            $csrfToken,
            $lifetime
        );
        $body = new AuthBody($request, $response);

        $envelope = new AuthEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AuthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true" csrfTokenSecured="true">'
                        . '<authToken>' . $authToken . '</authToken>'
                        . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                        . '<virtualHost>' . $virtualHost . '</virtualHost>'
                        . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
                    . '</urn:AuthRequest>'
                    . '<urn:AuthResponse>'
                        . '<authToken>' . $authToken . '</authToken>'
                        . '<csrfToken>' . $csrfToken . '</csrfToken>'
                        . '<lifetime>' . $lifetime . '</lifetime>'
                    . '</urn:AuthResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AuthEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AuthRequest' => [
                    'name' => $name,
                    'password' => $password,
                    'authToken' => [
                        '_content' => $authToken,
                    ],
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
                        '_content' => $value,
                    ],
                    'virtualHost' => [
                        '_content' => $virtualHost,
                    ],
                    'persistAuthTokenCookie' => TRUE,
                    'csrfTokenSecured' => TRUE,
                    'twoFactorCode' => [
                        '_content' => $twoFactorCode,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AuthResponse' => [
                    'authToken' => [
                        '_content' => $authToken,
                    ],
                    'csrfToken' => [
                        '_content' => $csrfToken,
                    ],
                    'lifetime' => [
                        '_content' => $lifetime,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AuthEnvelope::class, 'json'));
    }
}
