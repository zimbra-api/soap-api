<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MailKeyValuePairs;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailKeyValuePairs.
 */
class MailKeyValuePairsTest extends ZimbraTestCase
{
    public function testMailKeyValuePairs()
    {
        $key1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value1 = $this->faker->text;
        $value2 = $this->faker->text;

        $kvp1 = new KeyValuePair($key1, $value1);
        $kvp2 = new KeyValuePair($key1, $value2);
        $kvp3 = new KeyValuePair($key2, $value2);

        $kvp = new MailKeyValuePairs([$kvp1]);
        $this->assertSame([$kvp1], $kvp->getKeyValuePairs());

        $kvp->setKeyValuePairs([$kvp1, $kvp2])
            ->addKeyValuePair($kvp3);
        $this->assertSame([$kvp1, $kvp2, $kvp3], $kvp->getKeyValuePairs());
        $this->assertSame($value1, $kvp->firstValueForKey($key1));
        $this->assertSame([$value1, $value2], $kvp->valuesForKey($key1));

        $xml = <<<EOT
<?xml version="1.0"?>
<kvp>
    <a n="$key1">$value1</a>
    <a n="$key1">$value2</a>
    <a n="$key2">$value2</a>
</kvp>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($kvp, 'xml'));
        $this->assertEquals($kvp, $this->serializer->deserialize($xml, MailKeyValuePairs::class, 'xml'));

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
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($kvp, 'json'));
        $this->assertEquals($kvp, $this->serializer->deserialize($json, MailKeyValuePairs::class, 'json'));
    }
}
