<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\ChangePasswordResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePasswordResponse.
 */
class ChangePasswordResponseTest extends ZimbraStructTestCase
{
    public function testChangePasswordResponse()
    {
        $authToken = $this->faker->word;
        $lifetime = mt_rand(1, 100);

        $res = new ChangePasswordResponse(
            $authToken,
            $lifetime
        );
        $this->assertSame($authToken, $res->getAuthToken());
        $this->assertSame($lifetime, $res->getLifetime());

        $res = new ChangePasswordResponse('', 0);
        $res->setAuthToken($authToken)
            ->setLifetime($lifetime);
        $this->assertSame($authToken, $res->getAuthToken());
        $this->assertSame($lifetime, $res->getLifetime());
    }
}
