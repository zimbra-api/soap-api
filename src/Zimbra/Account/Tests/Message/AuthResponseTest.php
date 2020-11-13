<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AuthResponse;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\Pref;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\Session;
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
        $this->assertEquals($res, $this->serializer->deserialize($xml, AuthResponse::class, 'xml'));

        $json = json_encode([
            'authToken' => [
                '_content' => $authToken,
            ],
            'lifetime' => [
                '_content' => $lifetime,
            ],
            'trustLifetime' => [
                '_content' => $trustLifetime,
            ],
            'session' => [
                'type' => $type,
                'id' => $id,
                '_content' => $id,
            ],
            'refer' => [
                '_content' => $refer,
            ],
            'skin' => [
                '_content' => $skin,
            ],
            'csrfToken' => [
                '_content' => $csrfToken,
            ],
            'deviceId' => [
                '_content' => $deviceId,
            ],
            'trustedToken' => [
                '_content' => $trustedToken,
            ],
            'zmgProxy' => TRUE,
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
            'twoFactorAuthRequired' => [
                '_content' => TRUE,
            ],
            'trustedDevicesEnabled' => [
                '_content' => TRUE,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AuthResponse::class, 'json'));
    }
}
