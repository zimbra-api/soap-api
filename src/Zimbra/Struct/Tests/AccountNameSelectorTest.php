<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountNameSelector;

/**
 * Testcase class for AccountNameSelector.
 */
class AccountNameSelectorTest extends ZimbraStructTestCase
{
    public function testAccountNameSelector()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $acc = new AccountNameSelector(AccountBy::ID(), $name, $value);
        $this->assertTrue($acc->getBy()->is('id'));
        $this->assertSame($name, $acc->getName());

        $acc->setBy(AccountBy::ADMIN_NAME())
            ->setName($name);
        $this->assertTrue($acc->getBy()->is('adminName'));
        $this->assertSame($name, $acc->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account by="' . AccountBy::ADMIN_NAME() . '" name="' . $name . '">' . $value . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acc);

        $array = [
            'account' => [
                'by' => AccountBy::ADMIN_NAME()->value(),
                'name' => $name,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $acc->toArray());
    }
}
