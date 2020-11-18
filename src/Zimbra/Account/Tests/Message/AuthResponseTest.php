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
    }
}
