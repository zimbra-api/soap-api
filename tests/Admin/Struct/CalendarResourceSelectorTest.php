<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CalendarResourceSelector;
use Zimbra\Common\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalendarResourceSelector.
 */
class CalendarResourceSelectorTest extends ZimbraTestCase
{
    public function testCalendarResourceSelector()
    {
        $value = $this->faker->word;
        $cal = new CalendarResourceSelector(CalResBy::ID, $value);
        $this->assertEquals(CalResBy::ID, $cal->getBy());
        $this->assertSame($value, $cal->getValue());

        $cal = new CalendarResourceSelector();
        $cal->setBy(CalResBy::NAME)
            ->setValue($value);
        $this->assertEquals(CalResBy::NAME, $cal->getBy());
        $this->assertSame($value, $cal->getValue());

        $by = CalResBy::NAME->value;
        $xml = <<<EOT
<?xml version="1.0"?>
<result by="$by">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cal, 'xml'));
        $this->assertEquals($cal, $this->serializer->deserialize($xml, CalendarResourceSelector::class, 'xml'));
    }
}
