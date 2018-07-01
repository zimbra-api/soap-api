<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CalendarResourceSelector;
use Zimbra\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CalendarResourceSelector.
 */
class CalendarResourceSelectorTest extends ZimbraStructTestCase
{
    public function testCalendarResourceSelector()
    {
        $value = $this->faker->word;
        $cal = new CalendarResourceSelector(CalResBy::ID()->value(), $value);
        $this->assertSame(CalResBy::ID()->value(), $cal->getBy());
        $this->assertSame($value, $cal->getValue());

        $cal = new CalendarResourceSelector('');
        $cal->setBy(CalResBy::NAME()->value())
            ->setValue($value);
        $this->assertSame(CalResBy::NAME()->value(), $cal->getBy());
        $this->assertSame($value, $cal->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<calresource by="' . CalResBy::NAME() . '">' . $value . '</calresource>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cal, 'xml'));

        $cal = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\CalendarResourceSelector', 'xml');
        $this->assertSame(CalResBy::NAME()->value(), $cal->getBy());
        $this->assertSame($value, $cal->getValue());
    }
}
