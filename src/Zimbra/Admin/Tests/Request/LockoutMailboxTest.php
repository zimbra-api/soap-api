<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\LockoutMailbox;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\LockoutOperation;
use Zimbra\Struct\AccountNameSelector;

/**
 * Testcase class for LockoutMailbox.
 */
class LockoutMailboxTest extends ZimbraAdminApiTestCase
{
    public function testLockoutMailboxRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $account = new AccountNameSelector(AccountBy::NAME(), $name, $value);

        $req = new \Zimbra\Admin\Request\LockoutMailbox(
            $account, LockoutOperation::END()
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame('end', $req->getOperation()->value());

        $req->setOperation(LockoutOperation::START())
            ->setAccount($account);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame('start', $req->getOperation()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<LockoutMailboxRequest op="' . LockoutOperation::START() . '">'
                . '<account by="' . AccountBy::NAME() . '" name="' . $name . '">' . $value . '</account>'
            . '</LockoutMailboxRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'LockoutMailboxRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'op' => LockoutOperation::START()->value(),
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    'name' => $name,
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testLockoutMailboxApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $ops = ['start', 'end'];
        $op = $ops[array_rand($ops)];
        $account = new AccountNameSelector(AccountBy::NAME(), $name, $value);

        $this->api->lockoutMailbox(
            $account, LockoutOperation::START()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:LockoutMailboxRequest op="' . LockoutOperation::START() . '">'
                        . '<urn1:account by="' . AccountBy::NAME() . '" name="' . $name . '">' . $value . '</urn1:account>'
                    . '</urn1:LockoutMailboxRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
