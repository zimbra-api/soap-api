<?php declare(strict_types=1);

namespace Zimbra\Tests\Struct;

use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountNameSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountNameSelector.
 */
class AccountNameSelectorTest extends ZimbraTestCase
{
    public function testAccountNameSelector()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $acc = new AccountNameSelector(AccountBy::ID(), $name, $value);
        $this->assertEquals(AccountBy::ID(), $acc->getBy());
        $this->assertSame($name, $acc->getName());
        $this->assertSame($value, $acc->getValue());

        $acc = new AccountNameSelector(AccountBy::ID());
        $acc->setBy(AccountBy::NAME())
            ->setName($name)
            ->setValue($value);
        $this->assertEquals(AccountBy::NAME(), $acc->getBy());
        $this->assertSame($name, $acc->getName());
        $this->assertSame($value, $acc->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result by="name" name="$name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($acc, 'xml'));
        $this->assertEquals($acc, $this->serializer->deserialize($xml, AccountNameSelector::class, 'xml'));

        $json = json_encode([
            'by' => 'name',
            'name' => $name,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($acc, 'json'));
        $this->assertEquals($acc, $this->serializer->deserialize($json, AccountNameSelector::class, 'json'));
    }
}
