<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AuthRequest;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\Pref;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthRequest.
 */
class AuthRequestTest extends ZimbraStructTestCase
{
    public function testAuthRequest()
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

        $time = time();
        $lifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $preauth = new PreAuth($time, $value, $time);
        $authToken = new AuthToken($value, TRUE, $lifetime);

        $attr = new Attr($name, $value, TRUE);
        $attrs = new AuthAttrs([$attr]);

        $pref = new Pref($name, $value, $time);
        $prefs = new AuthPrefs([$pref]);

        $req = new AuthRequest(
            $account,
            $password,
            $recoveryCode,
            $preauth,
            $authToken,
            $jwtToken,
            $virtualHost,
            $prefs,
            $attrs,
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
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($recoveryCode, $req->getRecoveryCode());
        $this->assertSame($preauth, $req->getPreAuth());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($jwtToken, $req->getJwtToken());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertSame($prefs, $req->getPrefs());
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame($requestedSkin, $req->getRequestedSkin());
        $this->assertFalse($req->getPersistAuthTokenCookie());
        $this->assertFalse($req->getCsrfSupported());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());
        $this->assertFalse($req->getDeviceTrusted());
        $this->assertSame($trustedToken, $req->getTrustedDeviceToken());
        $this->assertSame($deviceId, $req->getDeviceId());
        $this->assertFalse($req->getGenerateDeviceId());
        $this->assertSame($tokenType, $req->getTokenType());

        $req = new AuthRequest();
        $req->setAccount($account)
            ->setPassword($password)
            ->setRecoveryCode($recoveryCode)
            ->setPreAuth($preauth)
            ->setAuthToken($authToken)
            ->setJwtToken($jwtToken)
            ->setVirtualHost($virtualHost)
            ->setPrefs($prefs)
            ->setAttrs($attrs)
            ->setRequestedSkin($requestedSkin)
            ->setPersistAuthTokenCookie(TRUE)
            ->setCsrfSupported(TRUE)
            ->setTwoFactorCode($twoFactorCode)
            ->setDeviceTrusted(TRUE)
            ->setTrustedDeviceToken($trustedToken)
            ->setDeviceId($deviceId)
            ->setGenerateDeviceId(TRUE)
            ->setTokenType($tokenType);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($recoveryCode, $req->getRecoveryCode());
        $this->assertSame($preauth, $req->getPreAuth());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($jwtToken, $req->getJwtToken());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertSame($prefs, $req->getPrefs());
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame($requestedSkin, $req->getRequestedSkin());
        $this->assertTrue($req->getPersistAuthTokenCookie());
        $this->assertTrue($req->getCsrfSupported());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());
        $this->assertTrue($req->getDeviceTrusted());
        $this->assertSame($trustedToken, $req->getTrustedDeviceToken());
        $this->assertSame($deviceId, $req->getDeviceId());
        $this->assertTrue($req->getGenerateDeviceId());
        $this->assertSame($tokenType, $req->getTokenType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthRequest xmlns="urn:zimbraAccount" persistAuthTokenCookie="true" csrfTokenSecured="true" deviceTrusted="true" generateDeviceId="true" tokenType="' . $tokenType . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<password>' . $password . '</password>'
                . '<recoveryCode>' . $recoveryCode . '</recoveryCode>'
                . '<preauth timestamp="' . $time . '" expiresTimestamp="' . $time . '">' . $value . '</preauth>'
                . '<authToken verifyAccount="true" lifetime="' . $lifetime . '">' . $value . '</authToken>'
                . '<jwtToken>' . $jwtToken . '</jwtToken>'
                . '<virtualHost>' . $virtualHost . '</virtualHost>'
                . '<prefs>'
                    . '<pref name="' . $name . '" modified="' . $time . '">' . $value . '</pref>'
                . '</prefs>'
                . '<attrs>'
                    . '<attr name="' . $name . '" pd="true">' . $value . '</attr>'
                . '</attrs>'
                . '<requestedSkin>' . $requestedSkin . '</requestedSkin>'
                . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
                . '<trustedDeviceToken>' . $trustedToken . '</trustedDeviceToken>'
                . '<deviceId>' . $deviceId . '</deviceId>'
            . '</AuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AuthRequest::class, 'xml'));

        $json = json_encode([
            'persistAuthTokenCookie' => TRUE,
            'csrfTokenSecured' => TRUE,
            'account' => [
                'by' => (string) AccountBy::NAME(),
                '_content' => $value,
            ],
            'password' => [
                '_content' => $password,
            ],
            'recoveryCode' => [
                '_content' => $recoveryCode,
            ],
            'preauth' => [
                '_content' => $value,
                'timestamp' => $time,
                'expiresTimestamp' => $time,
            ],
            'authToken' => [
                '_content' => $value,
                'verifyAccount' => TRUE,
                'lifetime' => $lifetime,
            ],
            'jwtToken' => [
                '_content' => $jwtToken,
            ],
            'virtualHost' => [
                '_content' => $virtualHost,
            ],
            'prefs' => [
                'pref' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                        'modified' => $time,
                    ],
                ],
            ],
            'attrs' => [
                'attr' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                        'pd' => TRUE,
                    ],
                ],
            ],
            'requestedSkin' => [
                '_content' => $requestedSkin,
            ],
            'twoFactorCode' => [
                '_content' => $twoFactorCode,
            ],
            'deviceTrusted' => TRUE,
            'trustedDeviceToken' => [
                '_content' => $trustedToken,
            ],
            'deviceId' => [
                '_content' => $deviceId,
            ],
            'generateDeviceId' => TRUE,
            'tokenType' => $tokenType,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AuthRequest::class, 'json'));
    }
}
