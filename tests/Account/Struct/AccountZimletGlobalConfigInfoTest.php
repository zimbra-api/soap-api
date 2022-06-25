<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountZimletGlobalConfigInfo;
use Zimbra\Account\Struct\AccountZimletProperty;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountZimletGlobalConfigInfo.
 */
class AccountZimletGlobalConfigInfoTest extends ZimbraTestCase
{
    public function testAccountZimletGlobalConfigInfo()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;

        $property = new AccountZimletProperty($name, $value);

        $global = new AccountZimletGlobalConfigInfo([$property]);
        $this->assertSame([$property], $global->getZimletProperties());

        $global = new AccountZimletGlobalConfigInfo;
        $global->setZimletProperties([$property])
            ->addZimletProperty($property);
        $this->assertSame([$property, $property], $global->getZimletProperties());
        $global->setZimletProperties([$property]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <property name="$name">$value</property>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($global, 'xml'));
        $this->assertEquals($global, $this->serializer->deserialize($xml, AccountZimletGlobalConfigInfo::class, 'xml'));
    }
}
