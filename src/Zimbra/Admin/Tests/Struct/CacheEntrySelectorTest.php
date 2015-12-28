<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Enum\CacheEntryBy;

/**
 * Testcase class for CacheEntrySelector.
 */
class CacheEntrySelectorTest extends ZimbraAdminTestCase
{
    public function testCacheEntrySelector()
    {
        $value = $this->faker->word;

        $entry = new CacheEntrySelector(CacheEntryBy::NAME(), $value);
        $this->assertTrue($entry->getBy()->is('name'));
        $this->assertSame($value, $entry->getValue());

        $entry->setBy(CacheEntryBy::ID());
        $this->assertTrue($entry->getBy()->is('id'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<entry by="' . CacheEntryBy::ID() . '">' . $value . '</entry>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $entry);

        $array = [
            'entry' => [
                'by' => CacheEntryBy::ID()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $entry->toArray());
    }
}
