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
        $acc = new AccountNameSelector(AccountBy::ID()->value(), $name, $value);
        $this->assertSame(AccountBy::ID()->value(), $acc->getBy());
        $this->assertSame($name, $acc->getName());
        $this->assertSame($value, $acc->getValue());

        $acc = new AccountNameSelector(AccountBy::ID()->value());
        $acc->setBy(AccountBy::NAME()->value())
            ->setName($name)
            ->setValue($value);
        $this->assertSame(AccountBy::NAME()->value(), $acc->getBy());
        $this->assertSame($name, $acc->getName());
        $this->assertSame($value, $acc->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account by="' . AccountBy::NAME() . '" name="' . $name . '">' . $value . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($acc, 'xml'));

        $acc = $this->serializer->deserialize($xml, 'Zimbra\Struct\AccountNameSelector', 'xml');
        $this->assertSame(AccountBy::NAME()->value(), $acc->getBy());
        $this->assertSame($name, $acc->getName());
        $this->assertSame($value, $acc->getValue());
    }
}
