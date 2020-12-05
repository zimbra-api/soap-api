<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AdminKeyValuePairs;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminKeyValuePairs.
 */
class AdminKeyValuePairsTest extends ZimbraStructTestCase
{
    public function testAdminKeyValuePairs()
    {
        $key1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;

        $kvp1 = new KeyValuePair($key1, $value1);
        $kvp2 = new KeyValuePair($key1, $value2);
        $kvp3 = new KeyValuePair($key2, $value2);

        $stub = new AdminKeyValuePairs([$kvp1]);
        $this->assertSame([$kvp1], $stub->getKeyValuePairs());

        $stub->setKeyValuePairs([$kvp1, $kvp2])
            ->addKeyValuePair($kvp3);
        $this->assertSame([$kvp1, $kvp2, $kvp3], $stub->getKeyValuePairs());
        $this->assertSame($value1, $stub->firstValueForKey($key1));
        $this->assertSame([$value1, $value2], $stub->valuesForKey($key1));

        $xml = <<<EOT
<?xml version="1.0"?>
<stub>
    <a n="$key1">$value1</a>
    <a n="$key1">$value2</a>
    <a n="$key2">$value2</a>
</stub>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, AdminKeyValuePairs::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $key1,
                    '_content' => $value1,
                ],
                [
                    'n' => $key1,
                    '_content' => $value2,
                ],
                [
                    'n' => $key2,
                    '_content' => $value2,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($stub, 'json'));
        $this->assertEquals($stub, $this->serializer->deserialize($json, AdminKeyValuePairs::class, 'json'));
    }
}
