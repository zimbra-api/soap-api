<?php

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AuthResponse;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\Pref;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\Session;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthResponse.
 */
class AuthResponseTest extends ZimbraStructTestCase
{
    public function testAuthResponse()
    {
        $authToken = $this->faker->uuid;
        $lifetime = mt_rand(1, 100);
        $trustLifetime = mt_rand(1, 100);
        $type = $this->faker->word;
        $id = $this->faker->uuid;
        $refer = $this->faker->word;
        $skin = $this->faker->word;
        $csrfToken = $this->faker->uuid;
        $deviceId = $this->faker->uuid;
        $trustedToken = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;

        $time = time();

        $session = new Session($id, $type);
        $account = new AccountSelector(AccountBy::NAME()->value(), $value);

        $attr = new Attr($name, $value, true);
        $attrs = new AuthAttrs([$attr]);

        $pref = new Pref($name, $value, $time);
        $prefs = new AuthPrefs([$pref]);

        $res = new AuthResponse(
            $authToken,
            $lifetime,
            $session,
            $refer,
            $skin,
            $csrfToken,
            $deviceId,
            $trustedToken,
            $trustLifetime,
            false,
            $prefs,
            $attrs,
            false,
            false
        );
        $this->assertSame($authToken, $res->getAuthToken());
        $this->assertSame($lifetime, $res->getLifetime());
        $this->assertSame($session, $res->getSession());
        $this->assertSame($refer, $res->getRefer());
        $this->assertSame($skin, $res->getSkin());
        $this->assertSame($csrfToken, $res->getCsrfToken());
        $this->assertSame($deviceId, $res->getDeviceId());
        $this->assertSame($trustedToken, $res->getTrustedToken());
        $this->assertSame($trustLifetime, $res->getTrustLifetime());
        $this->assertFalse($res->getZmgProxy());
        $this->assertSame($prefs, $res->getPrefs());
        $this->assertSame($attrs, $res->getAttrs());
        $this->assertFalse($res->getTwoFactorAuthRequired());
        $this->assertFalse($res->getTrustedDevicesEnabled());

        $res = new AuthResponse();
        $res->setAuthToken($authToken)
            ->setLifetime($lifetime)
            ->setSession($session)
            ->setRefer($refer)
            ->setSkin($skin)
            ->setCsrfToken($csrfToken)
            ->setDeviceId($deviceId)
            ->setTrustedToken($trustedToken)
            ->setTrustLifetime($trustLifetime)
            ->setZmgProxy(true)
            ->setPrefs($prefs)
            ->setAttrs($attrs)
            ->setTwoFactorAuthRequired(true)
            ->setTrustedDevicesEnabled(true);
        $this->assertSame($authToken, $res->getAuthToken());
        $this->assertSame($lifetime, $res->getLifetime());
        $this->assertSame($session, $res->getSession());
        $this->assertSame($refer, $res->getRefer());
        $this->assertSame($skin, $res->getSkin());
        $this->assertSame($csrfToken, $res->getCsrfToken());
        $this->assertSame($deviceId, $res->getDeviceId());
        $this->assertSame($trustedToken, $res->getTrustedToken());
        $this->assertSame($trustLifetime, $res->getTrustLifetime());
        $this->assertTrue($res->getZmgProxy());
        $this->assertSame($prefs, $res->getPrefs());
        $this->assertSame($attrs, $res->getAttrs());
        $this->assertTrue($res->getTwoFactorAuthRequired());
        $this->assertTrue($res->getTrustedDevicesEnabled());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthResponse xmlns="urn:zimbraAccount" zmgProxy="true">'
                . '<authToken>' . $authToken . '</authToken>'
                . '<lifetime>' . $lifetime . '</lifetime>'
                . '<trustLifetime>' . $trustLifetime . '</trustLifetime>'
                . '<session type="' . $type . '" id="' . $id . '">'  .$id . '</session>'
                . '<refer>' . $refer . '</refer>'
                . '<skin>' . $skin . '</skin>'
                . '<csrfToken>' . $csrfToken . '</csrfToken>'
                . '<deviceId>' . $deviceId . '</deviceId>'
                . '<trustedToken>' . $trustedToken . '</trustedToken>'
                . '<prefs>'
                    . '<pref name="' . $name . '" modified="' . $time . '">' . $value . '</pref>'
                . '</prefs>'
                . '<attrs>'
                    . '<attr name="' . $name . '" pd="true">' . $value . '</attr>'
                . '</attrs>'
                . '<twoFactorAuthRequired>true</twoFactorAuthRequired>'
                . '<trustedDevicesEnabled>true</trustedDevicesEnabled>'
            . '</AuthResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));

        $res = $this->serializer->deserialize($xml, 'Zimbra\Account\Message\AuthResponse', 'xml');
        $session = $res->getSession();
        $prefs = $res->getPrefs();
        $attrs = $res->getAttrs();
        $pref = $prefs->getPrefs()[0];
        $attr = $attrs->getAttrs()[0];

        $this->assertSame($authToken, $res->getAuthToken());
        $this->assertSame($lifetime, $res->getLifetime());
        $this->assertSame($refer, $res->getRefer());
        $this->assertSame($skin, $res->getSkin());
        $this->assertSame($csrfToken, $res->getCsrfToken());
        $this->assertSame($deviceId, $res->getDeviceId());
        $this->assertSame($trustedToken, $res->getTrustedToken());
        $this->assertSame($trustLifetime, $res->getTrustLifetime());
        $this->assertTrue($res->getZmgProxy());
        $this->assertTrue($res->getTwoFactorAuthRequired());
        $this->assertTrue($res->getTrustedDevicesEnabled());

        $this->assertSame($type, $session->getType());
        $this->assertSame($id, $session->getId());
        $this->assertSame($id, $session->getValue());

        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($time, $pref->getModified());

        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertTrue($attr->getPermDenied());
    }
}
