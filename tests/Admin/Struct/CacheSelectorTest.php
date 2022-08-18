<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Admin\Struct\CacheSelector;
use Zimbra\Common\Enum\CacheEntryBy;
use Zimbra\Common\Enum\CacheType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CacheSelector.
 */
class CacheSelectorTest extends ZimbraTestCase
{
    public function testCacheSelector()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $enums = array_map(static fn ($enum) => $enum->value, CacheType::cases());
        $enums = $this->faker->randomElements($enums, mt_rand(1, count($enums)));
        $types = implode(',', $enums);

        $entry1 = new CacheEntrySelector(CacheEntryBy::NAME, $value1);
        $entry2 = new CacheEntrySelector(CacheEntryBy::NAME, $value2);

        $cache = new StubCacheSelector($types, FALSE, FALSE, [$entry1]);
        $this->assertSame($types, $cache->getTypes());
        $this->assertFalse($cache->isAllServers());
        $this->assertFalse($cache->isIncludeImapServers());
        $this->assertSame([$entry1], $cache->getEntries());

        $cache = new StubCacheSelector();
        $cache->setTypes($types)
              ->setAllServers(TRUE)
              ->setIncludeImapServers(TRUE)
              ->setEntries([$entry1])
              ->addEntry($entry2);
        $this->assertSame($types, $cache->getTypes());
        $this->assertTrue($cache->isAllServers());
        $this->assertTrue($cache->isIncludeImapServers());
        $this->assertSame([$entry1, $entry2], $cache->getEntries());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$types" allServers="true" imapServers="true" xmlns:urn="urn:zimbraAdmin">
    <urn:entry by="name">$value1</urn:entry>
    <urn:entry by="name">$value2</urn:entry>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cache, 'xml'));
        $this->assertEquals($cache, $this->serializer->deserialize($xml, StubCacheSelector::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubCacheSelector extends CacheSelector
{
}
