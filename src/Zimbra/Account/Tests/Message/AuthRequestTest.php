<?php

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
        $virtualHost = $this->faker->word;
        $requestedSkin = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;
        $trustedToken = $this->faker->uuid;
        $deviceId = $this->faker->uuid;

        $time = time();
        $lifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME()->value(), $value);
        $preauth = new PreAuth($time, $value, $time);
        $authToken = new AuthToken($value, true, $lifetime);

        $attr = new Attr($name, $value, true);
        $attrs = new AuthAttrs([$attr]);

        $pref = new Pref($name, $value, $time);
        $prefs = new AuthPrefs([$pref]);

        $req = new AuthRequest(
            $account,
            $password,
            $preauth,
            $authToken,
            $virtualHost,
            $prefs,
            $attrs,
            $requestedSkin,
            false,
            false,
            $twoFactorCode,
            false,
            $trustedToken,
            $deviceId,
            false
        );
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($preauth, $req->getPreAuth());
        $this->assertSame($authToken, $req->getAuthToken());
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

        $req = new AuthRequest();
        $req->setAccount($account)
            ->setPassword($password)
            ->setPreAuth($preauth)
            ->setAuthToken($authToken)
            ->setVirtualHost($virtualHost)
            ->setPrefs($prefs)
            ->setAttrs($attrs)
            ->setRequestedSkin($requestedSkin)
            ->setPersistAuthTokenCookie(true)
            ->setCsrfSupported(true)
            ->setTwoFactorCode($twoFactorCode)
            ->setDeviceTrusted(true)
            ->setTrustedDeviceToken($trustedToken)
            ->setDeviceId($deviceId)
            ->setGenerateDeviceId(true);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($preauth, $req->getPreAuth());
        $this->assertSame($authToken, $req->getAuthToken());
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthRequest persistAuthTokenCookie="true" csrfTokenSecured="true" deviceTrusted="true" generateDeviceId="true">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<password>' . $password . '</password>'
                . '<preauth timestamp="' . $time . '" expiresTimestamp="' . $time . '">' . $value . '</preauth>'
                . '<authToken verifyAccount="true" lifetime="' . $lifetime . '">' . $value . '</authToken>'
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

        $req = $this->serializer->deserialize($xml, 'Zimbra\Account\Message\AuthRequest', 'xml');
        $account = $req->getAccount();
        $preauth = $req->getPreAuth();
        $authToken = $req->getAuthToken();
        $prefs = $req->getPrefs();
        $attrs = $req->getAttrs();
        $pref = $prefs->getPrefs()[0];
        $attr = $attrs->getAttrs()[0];

        $this->assertSame($password, $req->getPassword());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertSame($requestedSkin, $req->getRequestedSkin());
        $this->assertTrue($req->getPersistAuthTokenCookie());
        $this->assertTrue($req->getCsrfSupported());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());
        $this->assertTrue($req->getDeviceTrusted());
        $this->assertSame($trustedToken, $req->getTrustedDeviceToken());
        $this->assertSame($deviceId, $req->getDeviceId());
        $this->assertTrue($req->getGenerateDeviceId());

        $this->assertSame($value, $account->getValue());
        $this->assertSame(AccountBy::NAME()->value(), $account->getBy());
 
        $this->assertSame($time, $preauth->getTimestamp());
        $this->assertSame($time, $preauth->getExpiresTimestamp());
        $this->assertSame($value, $preauth->getValue());

        $this->assertSame($value, $authToken->getValue());
        $this->assertTrue($authToken->getVerifyAccount());
        $this->assertSame($lifetime, $authToken->getLifetime());

        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($time, $pref->getModified());

        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertTrue($attr->getPermDenied());
    }
}
