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
        $acc = new AccountSelector(AccountBy::ID()->value(), $value);
        $this->assertSame(AccountBy::ID()->value(), $acc->getBy());
        $this->assertSame($value, $acc->getValue());

        $acc = new AccountSelector(AccountBy::ID()->value());
        $acc->setBy(AccountBy::NAME()->value())
            ->setValue($value);
        $this->assertSame(AccountBy::NAME()->value(), $acc->getBy());
        $this->assertSame($value, $acc->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($acc, 'xml'));

        $acc = $this->serializer->deserialize($xml, 'Zimbra\Struct\AccountSelector', 'xml');
        $this->assertSame(AccountBy::NAME()->value(), $acc->getBy());
        $this->assertSame($value, $acc->getValue());
    }
}
