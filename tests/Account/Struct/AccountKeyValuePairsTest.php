<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountKeyValuePairs;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountKeyValuePairs.
 */
class AccountKeyValuePairsTest extends ZimbraTestCase
{
    public function testAccountKeyValuePairs()
    {
        $key1 = $this->faker->unique()->word;
        $key2 = $this->faker->unique()->word;
        $value1 = $this->faker->unique()->text;
        $value2 = $this->faker->unique()->text;

        $kvp1 = new KeyValuePair($key1, $value1);
        $kvp2 = new KeyValuePair($key1, $value2);
        $kvp3 = new KeyValuePair($key2, $value2);

        $kvp = new AccountKeyValuePairs([$kvp1]);
        $this->assertSame([$kvp1], $kvp->getKeyValuePairs());

        $kvp->setKeyValuePairs([$kvp1, $kvp2])
            ->addKeyValuePair($kvp3);
        $this->assertSame([$kvp1, $kvp2, $kvp3], $kvp->getKeyValuePairs());
        $this->assertSame($value1, $kvp->firstValueForKey($key1));
        $this->assertSame([$value1, $value2], $kvp->valuesForKey($key1));

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <a n="$key1">$value1</a>
    <a n="$key1">$value2</a>
    <a n="$key2">$value2</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($kvp, 'xml'));
        $this->assertEquals($kvp, $this->serializer->deserialize($xml, AccountKeyValuePairs::class, 'xml'));
    }
}
