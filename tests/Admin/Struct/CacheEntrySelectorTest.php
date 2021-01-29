<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CacheEntrySelector.
 */
class CacheEntrySelectorTest extends ZimbraTestCase
{
    public function testCacheEntrySelector()
    {
        $value = $this->faker->word;

        $entry = new CacheEntrySelector(CacheEntryBy::NAME(), $value);
        $this->assertEquals(CacheEntryBy::NAME(), $entry->getBy());
        $this->assertSame($value, $entry->getValue());

        $entry = new CacheEntrySelector(CacheEntryBy::NAME());
        $entry->setBy(CacheEntryBy::ID())
            ->setValue($value);
        $this->assertEquals(CacheEntryBy::ID(), $entry->getBy());
        $this->assertSame($value, $entry->getValue());

        $by = CacheEntryBy::ID()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<entry by="$by">$value</entry>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($entry, 'xml'));
        $this->assertEquals($entry, $this->serializer->deserialize($xml, CacheEntrySelector::class, 'xml'));

        $json = json_encode([
            'by' => $by,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($entry, 'json'));
        $this->assertEquals($entry, $this->serializer->deserialize($json, CacheEntrySelector::class, 'json'));
    }
}
