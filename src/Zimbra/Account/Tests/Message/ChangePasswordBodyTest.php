<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\ChangePasswordBody;
use Zimbra\Account\Message\ChangePasswordRequest;
use Zimbra\Account\Message\ChangePasswordResponse;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePasswordBody.
 */
class ChangePasswordBodyTest extends ZimbraStructTestCase
{
    public function testChangePasswordBody()
    {
        $value = $this->faker->word;
        $oldPassword = $this->faker->word;
        $newPassword = $this->faker->uuid;
        $virtualHost = $this->faker->word;
        $authToken = $this->faker->word;
        $lifetime = mt_rand(1, 100);
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new ChangePasswordRequest(
            $account,
            $oldPassword,
            $newPassword,
            $virtualHost
        );
        $response = new ChangePasswordResponse(
            $authToken,
            $lifetime
        );

        $body = new ChangePasswordBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ChangePasswordBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
    }
}
