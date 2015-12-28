<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Admin\Struct\CacheSelector;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Enum\CacheType;

/**
 * Testcase class for CacheSelector.
 */
class CacheSelectorTest extends ZimbraAdminTestCase
{
    public function testCacheSelector()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $enums = $this->faker->randomElements(CacheType::enums(), mt_rand(1, count(CacheType::enums())));
        $types = implode(',', $enums);

        $entry1 = new CacheEntrySelector(CacheEntryBy::ID(), $value1);
        $entry2 = new CacheEntrySelector(CacheEntryBy::NAME(), $value2);

        $cache = new CacheSelector($types, false, [$entry1]);
        $this->assertSame($types, $cache->getTypes());
        $this->assertFalse($cache->isAllServers());
        $this->assertSame([$entry1], $cache->getEntries()->all());

        $cache->setTypes($types)
              ->setAllServers(true)
              ->addEntry($entry2);
        $this->assertSame($types, $cache->getTypes());
        $this->assertTrue($cache->isAllServers());
        $this->assertSame([$entry1, $entry2], $cache->getEntries()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cache type="' . $types . '" allServers="true">'
                . '<entry by="' . CacheEntryBy::ID() . '">' . $value1 . '</entry>'
                . '<entry by="' . CacheEntryBy::NAME() . '">' . $value2 . '</entry>'
            . '</cache>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cache);

        $array = [
            'cache' => [
                'type' => $types,
                'allServers' => true,
                'entry' => [
                    [
                        'by' => CacheEntryBy::ID()->value(),
                        '_content' => $value1,
                    ],
                    [
                        'by' => CacheEntryBy::NAME()->value(),
                        '_content' => $value2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $cache->toArray());
    }
}
