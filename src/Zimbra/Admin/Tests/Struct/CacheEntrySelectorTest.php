<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CacheEntrySelector.
 */
class CacheEntrySelectorTest extends ZimbraStructTestCase
{
    public function testCacheEntrySelector()
    {
        $value = $this->faker->word;

        $entry = new CacheEntrySelector(CacheEntryBy::NAME()->value(), $value);
        $this->assertSame(CacheEntryBy::NAME()->value(), $entry->getBy());
        $this->assertSame($value, $entry->getValue());

        $entry = new CacheEntrySelector('');
        $entry->setBy(CacheEntryBy::ID()->value())
            ->setValue($value);
        $this->assertSame(CacheEntryBy::ID()->value(), $entry->getBy());
        $this->assertSame($value, $entry->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<entry by="' . CacheEntryBy::ID() . '">' . $value . '</entry>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($entry, 'xml'));

        $entry = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\CacheEntrySelector', 'xml');
        $this->assertSame(CacheEntryBy::ID()->value(), $entry->getBy());
        $this->assertSame($value, $entry->getValue());
    }
}
