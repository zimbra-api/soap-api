<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\AuthEnvelope;
use Zimbra\Admin\Message\AuthBody;
use Zimbra\Admin\Message\AuthRequest;
use Zimbra\Admin\Message\AuthResponse;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AuthResponse.
 */
class AuthResponseTest extends ZimbraTestCase
{
    public function testAuth()
    {
        $name = $this->faker->word;
        $password = $this->faker->uuid;
        $value = $this->faker->word;
        $authToken = $this->faker->sha256;
        $virtualHost = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;
        $csrfToken = $this->faker->sha256;
        $lifetime = $this->faker->randomNumber;

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
            $lifetime,
            FALSE
        );
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertFalse($response->getTwoFactorAuthRequired());

        $response = new AuthResponse();
        $response->setAuthToken($authToken)
            ->setCsrfToken($csrfToken)
            ->setLifetime($lifetime)
            ->setTwoFactorAuthRequired(TRUE);
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertTrue($response->getTwoFactorAuthRequired());

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

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AuthRequest name="$name" password="$password" persistAuthTokenCookie="true" csrfTokenSecured="true">
            <urn:authToken>$authToken</urn:authToken>
            <urn:account by="name">$value</urn:account>
            <urn:virtualHost>$virtualHost</urn:virtualHost>
            <urn:twoFactorCode>$twoFactorCode</urn:twoFactorCode>
        </urn:AuthRequest>
        <urn:AuthResponse>
            <urn:authToken>$authToken</urn:authToken>
            <urn:csrfToken>$csrfToken</urn:csrfToken>
            <urn:lifetime>$lifetime</urn:lifetime>
            <urn:twoFactorAuthRequired>true</urn:twoFactorAuthRequired>
        </urn:AuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AuthEnvelope::class, 'xml'));
    }
}
