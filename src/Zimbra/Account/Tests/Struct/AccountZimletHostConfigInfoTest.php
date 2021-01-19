<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\AccountZimletHostConfigInfo;
use Zimbra\Account\Struct\AccountZimletProperty;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountZimletHostConfigInfo.
 */
class AccountZimletHostConfigInfoTest extends ZimbraStructTestCase
{
    public function testAccountZimletHostConfigInfo()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;

        $property = new AccountZimletProperty($name, $value);

        $host = new AccountZimletHostConfigInfo($name, [$property]);
        $this->assertSame($name, $host->getName());
        $this->assertSame([$property], $host->getZimletProperties());

        $host = new AccountZimletHostConfigInfo;
        $host->setName($name)
            ->setZimletProperties([$property])
            ->addZimletProperty($property);
        $this->assertSame($name, $host->getName());
        $this->assertSame([$property, $property], $host->getZimletProperties());
        $host->setZimletProperties([$property]);

        $xml = <<<EOT
<?xml version="1.0"?>
<host name="$name">
    <property name="$name">$value</property>
</host>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($host, 'xml'));
        $this->assertEquals($host, $this->serializer->deserialize($xml, AccountZimletHostConfigInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'property' => [
                [
                    'name' => $name,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($host, 'json'));
        $this->assertEquals($host, $this->serializer->deserialize($json, AccountZimletHostConfigInfo::class, 'json'));
    }
}
