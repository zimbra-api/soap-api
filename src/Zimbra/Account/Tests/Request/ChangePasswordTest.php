<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\ChangePassword;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for ChangePassword.
 */
class ChangePasswordTest extends ZimbraAccountApiTestCase
{
    public function testChangePasswordRequest()
    {
        $value = $this->faker->word;
        $oldPassword = $this->faker->sha1;
        $password = $this->faker->sha1;
        $virtualHost = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $req = new ChangePassword(
            $account, $oldPassword, $password, $virtualHost
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($oldPassword, $req->getOldPassword());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($virtualHost, $req->getVirtualHost());

        $req->setAccount($account)
            ->setOldPassword($oldPassword)
            ->setPassword($password)
            ->setVirtualHost($virtualHost);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($oldPassword, $req->getOldPassword());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($virtualHost, $req->getVirtualHost());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ChangePasswordRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<oldPassword>' . $oldPassword . '</oldPassword>'
                . '<password>' . $password . '</password>'
                . '<virtualHost>' . $virtualHost . '</virtualHost>'
            . '</ChangePasswordRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ChangePasswordRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'oldPassword' => $oldPassword,
                'password' => $password,
                'virtualHost' => $virtualHost,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testChangePasswordApi()
    {
        $value = $this->faker->word;
        $oldPassword = $this->faker->sha1;
        $password = $this->faker->sha1;
        $virtualHost = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->changePassword(
            $account, $oldPassword, $password, $virtualHost
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ChangePasswordRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:oldPassword>' . $oldPassword . '</urn1:oldPassword>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                    . '</urn1:ChangePasswordRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
