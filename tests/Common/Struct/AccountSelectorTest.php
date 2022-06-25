<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountSelector.
 */
class AccountSelectorTest extends ZimbraTestCase
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
<result by="name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($acc, 'xml'));
        $this->assertEquals($acc, $this->serializer->deserialize($xml, AccountSelector::class, 'xml'));
    }
}
