<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\Auth;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\Pref;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for Auth.
 */
class AuthTest extends ZimbraAccountApiTestCase
{
    public function testAuthRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $password = $this->faker->word;
        $virtualHost = $this->faker->word;
        $requestedSkin = $this->faker->word;
        $twoFactorCode = $this->faker->word;
        $trustedToken = $this->faker->word;
        $deviceId = $this->faker->word;

        $time = time();

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $preauth = new PreAuth($time, $value, $time);
        $authToken = new AuthToken($value, true);

        $attr = new Attr($name, $value, true);
        $attrs = new AuthAttrs([$attr]);

        $pref = new Pref($name, $value, $time);
        $prefs = new AuthPrefs([$pref]);

        $req = new Auth(
            $account, $password, $preauth, $authToken, $virtualHost,
            $prefs, $attrs, $requestedSkin, $twoFactorCode,
            $trustedToken, $deviceId, false, false, false, false
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($preauth, $req->getPreAuth());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertSame($prefs, $req->getPrefs());
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame($requestedSkin, $req->getRequestedSkin());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());
        $this->assertSame($trustedToken, $req->getTrustedDeviceToken());
        $this->assertSame($deviceId, $req->getDeviceId());
        $this->assertFalse($req->getPersistAuthTokenCookie());
        $this->assertFalse($req->getCsrfTokenSecured());
        $this->assertFalse($req->getDeviceTrusted());
        $this->assertFalse($req->getGenerateDeviceId());

        $req = new Auth();
        $req->setAccount($account)
            ->setPassword($password)
            ->setPreAuth($preauth)
            ->setAuthToken($authToken)
            ->setVirtualHost($virtualHost)
            ->setPrefs($prefs)
            ->setAttrs($attrs)
            ->setRequestedSkin($requestedSkin)
            ->setTwoFactorCode($twoFactorCode)
            ->setTrustedDeviceToken($trustedToken)
            ->setDeviceId($deviceId)
            ->setPersistAuthTokenCookie(true)
            ->setCsrfTokenSecured(true)
            ->setDeviceTrusted(true)
            ->setGenerateDeviceId(true);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($preauth, $req->getPreAuth());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertSame($prefs, $req->getPrefs());
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame($requestedSkin, $req->getRequestedSkin());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());
        $this->assertSame($trustedToken, $req->getTrustedDeviceToken());
        $this->assertSame($deviceId, $req->getDeviceId());
        $this->assertTrue($req->getPersistAuthTokenCookie());
        $this->assertTrue($req->getCsrfTokenSecured());
        $this->assertTrue($req->getDeviceTrusted());
        $this->assertTrue($req->getGenerateDeviceId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthRequest persistAuthTokenCookie="true" csrfTokenSecured="true" deviceTrusted="true" generateDeviceId="true">'
                . '<prefs>'
                    . '<pref name="' . $name . '" modified="' . $time . '">' . $value . '</pref>'
                . '</prefs>'
                . '<attrs>'
                    . '<attr name="' . $name . '" pd="true">' . $value . '</attr>'
                . '</attrs>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<password>' . $password . '</password>'
                . '<preauth timestamp="' . $time . '" expiresTimestamp="' . $time . '">' . $value . '</preauth>'
                . '<authToken verifyAccount="true">' . $value . '</authToken>'
                . '<virtualHost>' . $virtualHost . '</virtualHost>'
                . '<requestedSkin>' . $requestedSkin . '</requestedSkin>'
                . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
                . '<trustedToken>' . $trustedToken . '</trustedToken>'
                . '<deviceId>' . $deviceId . '</deviceId>'
            . '</AuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AuthRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'password' => $password,
                'preauth' => [
                    'timestamp' => $time,
                    'expiresTimestamp' => $time,
                    '_content' => $value,
                ],
                'authToken' => [
                    'verifyAccount' => true,
                    '_content' => $value,
                ],
                'virtualHost' => $virtualHost,
                'prefs' => [
                    'pref' => [
                        [
                            'name' => $name,
                            'modified' => $time,
                            '_content' => $value,
                        ],
                    ],
                ],
                'attrs' => [
                    'attr' => [
                        [
                            'name' => $name,
                            'pd' => true,
                            '_content' => $value,
                        ],
                    ],
                ],
                'requestedSkin' => $requestedSkin,
                'twoFactorCode' => $twoFactorCode,
                'trustedToken' => $trustedToken,
                'deviceId' => $deviceId,
                'persistAuthTokenCookie' => true,
                'csrfTokenSecured' => true,
                'deviceTrusted' => true,
                'generateDeviceId' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAuthApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $password = $this->faker->word;
        $virtualHost = $this->faker->word;
        $requestedSkin = $this->faker->word;
        $twoFactorCode = $this->faker->word;
        $trustedToken = $this->faker->word;
        $deviceId = $this->faker->word;
        $time = time();

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $preauth = new PreAuth($time, $value, $time);
        $authToken = new AuthToken($value, true);

        $attr = new Attr($name, $value, true);
        $attrs = new AuthAttrs([$attr]);

        $pref = new Pref($name, $value, $time);
        $prefs = new AuthPrefs([$pref]);

        $this->api->auth(
            $account, $password, $preauth, $authToken, $virtualHost,
            $prefs, $attrs, $requestedSkin, $twoFactorCode,
            $trustedToken, $deviceId, false, false, true, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:AuthRequest persistAuthTokenCookie="false" csrfTokenSecured="false" deviceTrusted="true" generateDeviceId="true">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                        . '<urn1:preauth timestamp="' . $time . '" expiresTimestamp="' . $time . '">' . $value . '</urn1:preauth>'
                        . '<urn1:authToken verifyAccount="true">' . $value . '</urn1:authToken>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                        . '<urn1:prefs>'
                            . '<urn1:pref name="' . $name . '" modified="' . $time . '">' . $value . '</urn1:pref>'
                        . '</urn1:prefs>'
                        . '<urn1:attrs>'
                            . '<urn1:attr name="' . $name . '" pd="true">' . $value . '</urn1:attr>'
                        . '</urn1:attrs>'
                        . '<urn1:requestedSkin>' . $requestedSkin . '</urn1:requestedSkin>'
                        . '<urn1:twoFactorCode>' . $twoFactorCode . '</urn1:twoFactorCode>'
                        . '<urn1:trustedToken>' . $trustedToken . '</urn1:trustedToken>'
                        . '<urn1:deviceId>' . $deviceId . '</urn1:deviceId>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByAcount()
    {
        $value = $this->faker->word;
        $password = $this->faker->sha1;
        $virtualHost = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->authByAcount(
            $account, $password, $virtualHost
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:AuthRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                        . '<urn1:prefs />'
                        . '<urn1:attrs />'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByToken()
    {
        $value = $this->faker->sha1;
        $virtualHost = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $authToken = new AuthToken($value, true);

        $this->api->authByToken(
            $account, $authToken, $virtualHost
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:AuthRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:authToken verifyAccount="true">' . $value . '</urn1:authToken>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                        . '<urn1:prefs />'
                        . '<urn1:attrs />'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
