<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AuthEnvelope;
use Zimbra\Admin\Message\AuthBody;
use Zimbra\Admin\Message\AuthRequest;
use Zimbra\Admin\Message\AuthResponse;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthResponse.
 */
class AuthResponseTest extends ZimbraStructTestCase
{
    public function testAuth()
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
            FALSE,
            FALSE,
            $twoFactorCode
        );
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());
        $this->assertSame($authToken, $request->getAuthToken());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertFalse($request->getPersistAuthTokenCookie());
        $this->assertFalse($request->getCsrfSupported());
        $this->assertSame($twoFactorCode, $request->getTwoFactorCode());

        $request = new AuthRequest();
        $request->setName($name)
            ->setPassword($password)
            ->setAuthToken($authToken)
            ->setAccount($account)
            ->setVirtualHost($virtualHost)
            ->setPersistAuthTokenCookie(TRUE)
            ->setCsrfSupported(TRUE)
            ->setTwoFactorCode($twoFactorCode);
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());
        $this->assertSame($authToken, $request->getAuthToken());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertTrue($request->getPersistAuthTokenCookie());
        $this->assertTrue($request->getCsrfSupported());
        $this->assertSame($twoFactorCode, $request->getTwoFactorCode());

        $response = new AuthResponse(
            $authToken,
            $csrfToken,
            $lifetime
        );
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($lifetime, $response->getLifetime());

        $response = new AuthResponse();
        $response->setAuthToken($authToken)
            ->setCsrfToken($csrfToken)
            ->setLifetime($lifetime);
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertSame($csrfToken, $response->getCsrfToken());

        $body = new AuthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AuthBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AuthEnvelope($body);
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
