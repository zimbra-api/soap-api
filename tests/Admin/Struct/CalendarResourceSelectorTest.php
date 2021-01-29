<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CalendarResourceSelector;
use Zimbra\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalendarResourceSelector.
 */
class CalendarResourceSelectorTest extends ZimbraTestCase
{
    public function testCalendarResourceSelector()
    {
        $value = $this->faker->word;
        $cal = new CalendarResourceSelector(CalResBy::ID(), $value);
        $this->assertEquals(CalResBy::ID(), $cal->getBy());
        $this->assertSame($value, $cal->getValue());

        $cal = new CalendarResourceSelector(CalResBy::ID());
        $cal->setBy(CalResBy::NAME())
            ->setValue($value);
        $this->assertEquals(CalResBy::NAME(), $cal->getBy());
        $this->assertSame($value, $cal->getValue());

        $by = CalResBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<calresource by="$by">$value</calresource>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cal, 'xml'));
        $this->assertEquals($cal, $this->serializer->deserialize($xml, CalendarResourceSelector::class, 'xml'));

        $json = json_encode([
            'by' => $by,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cal, 'json'));
        $this->assertEquals($cal, $this->serializer->deserialize($json, CalendarResourceSelector::class, 'json'));
    }
}
