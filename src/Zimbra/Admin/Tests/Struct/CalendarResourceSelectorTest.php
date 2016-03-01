<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\CalendarResourceSelector;
use Zimbra\Enum\CalendarResourceBy as CalResBy;

/**
 * Testcase class for CalendarResourceSelector.
 */
class CalendarResourceSelectorTest extends ZimbraAdminTestCase
{
    public function testCalendarResourceSelector()
    {
        $value = $this->faker->word;
        $cal = new CalendarResourceSelector(CalResBy::ID(), $value);
        $this->assertTrue($cal->getBy()->is('id'));
        $this->assertSame($value, $cal->getValue());

        $cal->setBy(CalResBy::NAME());
        $this->assertTrue($cal->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<calresource by="' . CalResBy::NAME() . '">' . $value . '</calresource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = [
            'calresource' => [
                'by' => CalResBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $cal->toArray());
    }
}
