<?php declare(strict_types=1);

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
        $this->assertEquals(AccountBy::ID(), $acc->getBy());
        $this->assertSame($value, $acc->getValue());

        $acc = new AccountSelector(AccountBy::ID());
        $acc->setBy(AccountBy::NAME())
            ->setValue($value);
        $this->assertEquals(AccountBy::NAME(), $acc->getBy());
        $this->assertSame($value, $acc->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<account by="name">$value</account>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($acc, 'xml'));
        $this->assertEquals($acc, $this->serializer->deserialize($xml, AccountSelector::class, 'xml'));

        $json = json_encode([
            'by' => 'name',
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($acc, 'json'));
        $this->assertEquals($acc, $this->serializer->deserialize($json, AccountSelector::class, 'json'));
    }
}
