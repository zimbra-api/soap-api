<?php declare(strict_types=1);

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
        $enums = $this->faker->randomElements(CacheType::toArray(), mt_rand(1, count(CacheType::toArray())));
        $types = implode(',', $enums);

        $entry1 = new CacheEntrySelector(CacheEntryBy::ID(), $value1);
        $entry2 = new CacheEntrySelector(CacheEntryBy::NAME(), $value2);

        $cache = new CacheSelector($types, FALSE, FALSE, [$entry1]);
        $this->assertSame($types, $cache->getTypes());
        $this->assertFalse($cache->isAllServers());
        $this->assertFalse($cache->isIncludeImapServers());
        $this->assertSame([$entry1], $cache->getEntries());

        $cache = new CacheSelector('');
        $cache->setTypes($types)
              ->setAllServers(TRUE)
              ->setIncludeImapServers(TRUE)
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
        $this->assertEquals($cache, $this->serializer->deserialize($xml, CacheSelector::class, 'xml'));

        $json = json_encode([
            'entry' => [
                [
                    'by' => (string) CacheEntryBy::ID(),
                    '_content' => $value1,
                ],
                [
                    'by' => (string) CacheEntryBy::NAME(),
                    '_content' => $value2,
                ],
            ],
            'type' => $types,
            'allServers' => TRUE,
            'imapServers' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cache, 'json'));
        $this->assertEquals($cache, $this->serializer->deserialize($json, CacheSelector::class, 'json'));
    }
}
