<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\ChangePasswordRequest;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePasswordRequest.
 */
class ChangePasswordRequestTest extends ZimbraStructTestCase
{
    public function testChangePasswordRequest()
    {
        $value = $this->faker->word;
        $oldPassword = $this->faker->word;
        $newPassword = $this->faker->uuid;
        $virtualHost = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $req = new ChangePasswordRequest(
            $account,
            $oldPassword,
            $newPassword,
            $virtualHost
        );
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($oldPassword, $req->getOldPassword());
        $this->assertSame($newPassword, $req->getPassword());
        $this->assertSame($virtualHost, $req->getVirtualHost());

        $req = new ChangePasswordRequest(new AccountSelector(AccountBy::ID(), ''), '', '');
        $req->setAccount($account)
            ->setOldPassword($oldPassword)
            ->setPassword($newPassword)
            ->setVirtualHost($virtualHost);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($oldPassword, $req->getOldPassword());
        $this->assertSame($newPassword, $req->getPassword());
        $this->assertSame($virtualHost, $req->getVirtualHost());
    }
}
