<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AutoProvDirectoryEntry;
use Zimbra\Common\Struct\KeyValuePair;
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

        $entry = new StubAutoProvDirectoryEntry($dn, [$key1, $key2]);
        $this->assertSame($dn, $entry->getDn());
        $this->assertSame([$key1, $key2], $entry->getKeys());

        $entry = new StubAutoProvDirectoryEntry();
        $entry->setDn($dn)
             ->setKeys([$key1, $key2])
             ->setKeyValuePairs([new KeyValuePair($key, $value)]);
        $this->assertSame($dn, $entry->getDn());
        $this->assertSame([$key1, $key2], $entry->getKeys());

        $xml = <<<EOT
<?xml version="1.0"?>
<result dn="$dn" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
    <urn:key>$key1</urn:key>
    <urn:key>$key2</urn:key>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($entry, 'xml'));
        $this->assertEquals($entry, $this->serializer->deserialize($xml, StubAutoProvDirectoryEntry::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubAutoProvDirectoryEntry extends AutoProvDirectoryEntry
{
}
