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
    }
}
