<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AuthBody;
use Zimbra\Account\Message\AuthRequest;
use Zimbra\Account\Message\AuthResponse;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\Pref;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\Session;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthBody.
 */
class AuthBodyTest extends ZimbraStructTestCase
{
    public function testAuthBody()
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
        $authToken = new AuthToken($value, true, $lifetime);
        $session = new Session($id, $type);

        $attr = new Attr($name, $value, true);
        $attrs = new AuthAttrs([$attr]);

        $pref = new Pref($name, $value, $time);
        $prefs = new AuthPrefs([$pref]);

        $request = new AuthRequest(
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
            true,
            true,
            $twoFactorCode,
            true,
            $trustedToken,
            $deviceId,
            true,
            $tokenType
        );

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
            true,
            $prefs,
            $attrs,
            true,
            true
        );

        $body = new AuthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AuthBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
    }
}
