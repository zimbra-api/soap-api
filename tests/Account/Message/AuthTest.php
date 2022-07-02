<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\AuthEnvelope;
use Zimbra\Account\Message\AuthBody;
use Zimbra\Account\Message\AuthRequest;
use Zimbra\Account\Message\AuthResponse;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Pref;
use Zimbra\Account\Struct\Session;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for Auth.
 */
class AuthTest extends ZimbraTestCase
{
    public function testAuth()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $password = $this->faker->uuid;
        $recoveryCode = $this->faker->word;
        $jwtToken = $this->faker->word;
        $virtualHost = $this->faker->word;
        $requestedSkin = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;
        $trustedToken = $this->faker->uuid;
        $deviceId = $this->faker->uuid;
        $tokenType = $this->faker->word;
        $token = $this->faker->uuid;
        $refer = $this->faker->word;
        $skin = $this->faker->word;
        $csrfToken = $this->faker->uuid;
        $id = $this->faker->uuid;
        $type = $this->faker->word;

        $time = time();
        $lifetime = mt_rand(1, 100);
        $trustLifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $preauth = new PreAuth($time, $value, $time);
        $authToken = new AuthToken($value, TRUE, $lifetime);
        $session = new Session($id, $type);

        $attr = new Attr($name, $value, TRUE);
        $pref = new Pref($name, $value, $time);

        $request = new AuthRequest(
            $account,
            $password,
            $recoveryCode,
            $preauth,
            $authToken,
            $jwtToken,
            $virtualHost,
            [$pref],
            [$attr],
            $requestedSkin,
            FALSE,
            FALSE,
            $twoFactorCode,
            FALSE,
            $trustedToken,
            $deviceId,
            FALSE,
            $tokenType
        );

        $this->assertSame($account, $request->getAccount());
        $this->assertSame($password, $request->getPassword());
        $this->assertSame($recoveryCode, $request->getRecoveryCode());
        $this->assertSame($preauth, $request->getPreAuth());
        $this->assertSame($authToken, $request->getAuthToken());
        $this->assertSame($jwtToken, $request->getJwtToken());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertSame([$pref], $request->getPrefs());
        $this->assertSame([$attr], $request->getAttrs());
        $this->assertSame($requestedSkin, $request->getRequestedSkin());
        $this->assertFalse($request->getPersistAuthTokenCookie());
        $this->assertFalse($request->getCsrfSupported());
        $this->assertSame($twoFactorCode, $request->getTwoFactorCode());
        $this->assertFalse($request->getDeviceTrusted());
        $this->assertSame($trustedToken, $request->getTrustedDeviceToken());
        $this->assertSame($deviceId, $request->getDeviceId());
        $this->assertFalse($request->getGenerateDeviceId());
        $this->assertSame($tokenType, $request->getTokenType());

        $req = new AuthRequest();
        $request->setAccount($account)
            ->setPassword($password)
            ->setRecoveryCode($recoveryCode)
            ->setPreAuth($preauth)
            ->setAuthToken($authToken)
            ->setJwtToken($jwtToken)
            ->setVirtualHost($virtualHost)
            ->setPrefs([$pref])
            ->addPref($pref)
            ->setAttrs([$attr])
            ->addAttr($attr)
            ->setRequestedSkin($requestedSkin)
            ->setPersistAuthTokenCookie(TRUE)
            ->setCsrfSupported(TRUE)
            ->setTwoFactorCode($twoFactorCode)
            ->setDeviceTrusted(TRUE)
            ->setTrustedDeviceToken($trustedToken)
            ->setDeviceId($deviceId)
            ->setGenerateDeviceId(TRUE)
            ->setTokenType($tokenType);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($password, $request->getPassword());
        $this->assertSame($recoveryCode, $request->getRecoveryCode());
        $this->assertSame($preauth, $request->getPreAuth());
        $this->assertSame($authToken, $request->getAuthToken());
        $this->assertSame($jwtToken, $request->getJwtToken());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertSame([$pref, $pref], $request->getPrefs());
        $this->assertSame([$attr, $attr], $request->getAttrs());
        $this->assertSame($requestedSkin, $request->getRequestedSkin());
        $this->assertTrue($request->getPersistAuthTokenCookie());
        $this->assertTrue($request->getCsrfSupported());
        $this->assertSame($twoFactorCode, $request->getTwoFactorCode());
        $this->assertTrue($request->getDeviceTrusted());
        $this->assertSame($trustedToken, $request->getTrustedDeviceToken());
        $this->assertSame($deviceId, $request->getDeviceId());
        $this->assertTrue($request->getGenerateDeviceId());
        $this->assertSame($tokenType, $request->getTokenType());
        $request->setPrefs([$pref])->setAttrs([$attr]);

        $response = new AuthResponse(
            $token,
            $lifetime,
            $session,
            $refer,
            $skin,
            $csrfToken,
            $deviceId,
            $trustedToken,
            $trustLifetime,
            FALSE,
            [$pref],
            [$attr],
            FALSE,
            FALSE
        );
        $this->assertSame($token, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertSame($session, $response->getSession());
        $this->assertSame($refer, $response->getRefer());
        $this->assertSame($skin, $response->getSkin());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($deviceId, $response->getDeviceId());
        $this->assertSame($trustedToken, $response->getTrustedToken());
        $this->assertSame($trustLifetime, $response->getTrustLifetime());
        $this->assertFalse($response->getZmgProxy());
        $this->assertSame([$pref], $response->getPrefs());
        $this->assertSame([$attr], $response->getAttrs());
        $this->assertFalse($response->getTwoFactorAuthRequired());
        $this->assertFalse($response->getTrustedDevicesEnabled());

        $res = new AuthResponse();
        $response->setAuthToken($token)
            ->setLifetime($lifetime)
            ->setSession($session)
            ->setRefer($refer)
            ->setSkin($skin)
            ->setCsrfToken($csrfToken)
            ->setDeviceId($deviceId)
            ->setTrustedToken($trustedToken)
            ->setTrustLifetime($trustLifetime)
            ->setZmgProxy(TRUE)
            ->setPrefs([$pref])
            ->addPref($pref)
            ->setAttrs([$attr])
            ->addAttr($attr)
            ->setTwoFactorAuthRequired(TRUE)
            ->setTrustedDevicesEnabled(TRUE);
        $this->assertSame($token, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertSame($session, $response->getSession());
        $this->assertSame($refer, $response->getRefer());
        $this->assertSame($skin, $response->getSkin());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($deviceId, $response->getDeviceId());
        $this->assertSame($trustedToken, $response->getTrustedToken());
        $this->assertSame($trustLifetime, $response->getTrustLifetime());
        $this->assertTrue($response->getZmgProxy());
        $this->assertSame([$pref, $pref], $response->getPrefs());
        $this->assertSame([$attr, $attr], $response->getAttrs());
        $this->assertTrue($response->getTwoFactorAuthRequired());
        $this->assertTrue($response->getTrustedDevicesEnabled());
        $response->setPrefs([$pref])->setAttrs([$attr]);

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

        $by = AccountBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:AuthRequest persistAuthTokenCookie="true" csrfTokenSecured="true" deviceTrusted="true" generateDeviceId="true" tokenType="$tokenType">
            <urn:account by="$by">$value</urn:account>
            <urn:password>$password</urn:password>
            <urn:recoveryCode>$recoveryCode</urn:recoveryCode>
            <urn:preauth timestamp="$time" expiresTimestamp="$time">$value</urn:preauth>
            <urn:authToken verifyAccount="true" lifetime="$lifetime">$value</urn:authToken>
            <urn:jwtToken>$jwtToken</urn:jwtToken>
            <urn:virtualHost>$virtualHost</urn:virtualHost>
            <urn:prefs>
                <urn:pref name="$name" modified="$time">$value</urn:pref>
            </urn:prefs>
            <urn:attrs>
                <urn:attr name="$name" pd="true">$value</urn:attr>
            </urn:attrs>
            <urn:requestedSkin>$requestedSkin</urn:requestedSkin>
            <urn:twoFactorCode>$twoFactorCode</urn:twoFactorCode>
            <urn:trustedToken>$trustedToken</urn:trustedToken>
            <urn:deviceId>$deviceId</urn:deviceId>
        </urn:AuthRequest>
        <urn:AuthResponse zmgProxy="true">
            <urn:authToken>$token</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
            <urn:trustLifetime>$trustLifetime</urn:trustLifetime>
            <urn:session type="$type" id="$id">$id</urn:session>
            <urn:refer>$refer</urn:refer>
            <urn:skin>$skin</urn:skin>
            <urn:csrfToken>$csrfToken</urn:csrfToken>
            <urn:deviceId>$deviceId</urn:deviceId>
            <urn:trustedToken>$trustedToken</urn:trustedToken>
            <urn:prefs>
                <urn:pref name="$name" modified="$time">$value</urn:pref>
            </urn:prefs>
            <urn:attrs>
                <urn:attr name="$name" pd="true">$value</urn:attr>
            </urn:attrs>
            <urn:twoFactorAuthRequired>true</urn:twoFactorAuthRequired>
            <urn:trustedDevicesEnabled>true</urn:trustedDevicesEnabled>
        </urn:AuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AuthEnvelope::class, 'xml'));
    }
}
