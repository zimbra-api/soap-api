<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AdminKeyValuePairs;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminKeyValuePairs.
 */
class AdminKeyValuePairsTest extends ZimbraTestCase
{
    public function testAdminKeyValuePairs()
    {
        $key1 = $this->faker->unique->word;
        $key2 = $this->faker->unique->word;
        $value1 = $this->faker->unique->word;
        $value2 = $this->faker->unique->word;

        $kvp1 = new KeyValuePair($key1, $value1);
        $kvp2 = new KeyValuePair($key1, $value2);
        $kvp3 = new KeyValuePair($key2, $value2);

        $stub = new StubAdminKeyValuePairs([$kvp1]);
        $this->assertSame([$kvp1], $stub->getKeyValuePairs());

        $stub->setKeyValuePairs([$kvp1, $kvp2])
            ->addKeyValuePair($kvp3);
        $this->assertSame([$kvp1, $kvp2, $kvp3], $stub->getKeyValuePairs());
        $this->assertSame($value1, $stub->firstValueForKey($key1));
        $this->assertSame([$value1, $value2], $stub->valuesForKey($key1));

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key1">$value1</urn:a>
    <urn:a n="$key1">$value2</urn:a>
    <urn:a n="$key2">$value2</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubAdminKeyValuePairs::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubAdminKeyValuePairs extends AdminKeyValuePairs
{
}
