<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for AccountSelector.
 */
class AccountSelectorTest extends ZimbraStructTestCase
{
    public function testAccountSelector()
    {
        $value = $this->faker->word;
        $acc = new AccountSelector(AccountBy::ID(), $value);
        $this->assertTrue($acc->getBy()->is('id'));

        $acc->setBy(AccountBy::ADMIN_NAME());
        $this->assertTrue($acc->getBy()->is('adminName'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account by="' . AccountBy::ADMIN_NAME() . '">' . $value . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acc);

        $array = [
            'account' => [
                'by' => AccountBy::ADMIN_NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $acc->toArray());
    }
}
