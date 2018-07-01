<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Admin\Struct\CacheSelector;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Enum\CacheType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CacheSelector.
 */
class CacheSelectorTest extends ZimbraStructTestCase
{
    public function testCacheSelector()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $enums = $this->faker->randomElements(CacheType::enums(), mt_rand(1, count(CacheType::enums())));
        $types = implode(',', $enums);

        $entry1 = new CacheEntrySelector(CacheEntryBy::ID()->value(), $value1);
        $entry2 = new CacheEntrySelector(CacheEntryBy::NAME()->value(), $value2);

        $cache = new CacheSelector($types, false, false, [$entry1]);
        $this->assertSame($types, $cache->getTypes());
        $this->assertFalse($cache->isAllServers());
        $this->assertFalse($cache->isIncludeImapServers());
        $this->assertSame([$entry1], $cache->getEntries());

        $cache = new CacheSelector('');
        $cache->setTypes($types)
              ->setAllServers(true)
              ->setIncludeImapServers(true)
              ->setEntries([$entry1])
              ->addEntry($entry2);
        $this->assertSame($types, $cache->getTypes());
        $this->assertTrue($cache->isAllServers());
        $this->assertTrue($cache->isIncludeImapServers());
        $this->assertSame([$entry1, $entry2], $cache->getEntries());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cache type="' . $types . '" allServers="true" imapServers="true">'
                . '<entry by="' . CacheEntryBy::ID() . '">' . $value1 . '</entry>'
                . '<entry by="' . CacheEntryBy::NAME() . '">' . $value2 . '</entry>'
            . '</cache>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cache, 'xml'));

        $cache = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\CacheSelector', 'xml');
        $entries = $cache->getEntries();
        $this->assertSame(CacheEntryBy::ID()->value(), $entries[0]->getBy());
        $this->assertSame($value1, $entries[0]->getValue());
        $this->assertSame(CacheEntryBy::NAME()->value(), $entries[1]->getBy());
        $this->assertSame($value2, $entries[1]->getValue());
    }
}
