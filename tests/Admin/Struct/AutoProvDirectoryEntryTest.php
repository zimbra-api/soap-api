<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AutoProvDirectoryEntry;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AutoProvDirectoryEntry.
 */
class AutoProvDirectoryEntryTest extends ZimbraTestCase
{
    public function testAutoProvDirectoryEntry()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $dn = $this->faker->word;
        $key1 = $this->faker->text;
        $key2 = $this->faker->text;

        $entry = new AutoProvDirectoryEntry($dn, [$key1, $key2]);
        $this->assertSame($dn, $entry->getDn());
        $this->assertSame([$key1, $key2], $entry->getKeys());

        $entry = new AutoProvDirectoryEntry('');
        $entry->setDn($dn)
             ->setKeys([$key1])
             ->addKey($key2)
             ->setKeyValuePairs([new KeyValuePair($key, $value)]);
        $this->assertSame($dn, $entry->getDn());
        $this->assertSame([$key1, $key2], $entry->getKeys());

        $xml = <<<EOT
<?xml version="1.0"?>
<entry dn="$dn">
    <a n="$key">$value</a>
    <key>$key1</key>
    <key>$key2</key>
</entry>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($entry, 'xml'));
        $this->assertEquals($entry, $this->serializer->deserialize($xml, AutoProvDirectoryEntry::class, 'xml'));

        $json = json_encode([
            'dn' => $dn,
            'key' => [
                [
                    '_content' => $key1,
                ],
                [
                    '_content' => $key2,
                ],
            ],
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($entry, 'json'));
        $this->assertEquals($entry, $this->serializer->deserialize($json, AutoProvDirectoryEntry::class, 'json'));
    }
}
