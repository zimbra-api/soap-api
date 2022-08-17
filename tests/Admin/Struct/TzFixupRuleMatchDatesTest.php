<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\TzFixupRuleMatchDates;
use Zimbra\Admin\Struct\TzFixupRuleMatchDate;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TzFixupRuleMatchDates.
 */
class TzFixupRuleMatchDatesTest extends ZimbraTestCase
{
    public function testTzFixupRuleMatchDates()
    {
        $std_mon = mt_rand(1, 12);
        $std_mday = mt_rand(1, 31);
        $standard = new TzFixupRuleMatchDate($std_mon, $std_mday);

        $day_mon = mt_rand(1, 12);
        $day_mday = mt_rand(1, 31);
        $daylight = new TzFixupRuleMatchDate($day_mon, $day_mday);

        $stdoff = mt_rand(1, 100);
        $dayoff = mt_rand(1, 100);
        $dates = new StubTzFixupRuleMatchDates($standard, $daylight, $stdoff, $dayoff);
        $this->assertSame($standard, $dates->getStandard());
        $this->assertSame($daylight, $dates->getDaylight());
        $this->assertSame($stdoff, $dates->getStdOffset());
        $this->assertSame($dayoff, $dates->getDstOffset());

        $dates = new StubTzFixupRuleMatchDates(
            new TzFixupRuleMatchDate(),
            new TzFixupRuleMatchDate()
        );
        $dates->setStandard($standard)
              ->setDaylight($daylight)
              ->setStdOffset($stdoff)
              ->setDstOffset($dayoff);
        $this->assertSame($standard, $dates->getStandard());
        $this->assertSame($daylight, $dates->getDaylight());
        $this->assertSame($stdoff, $dates->getStdOffset());
        $this->assertSame($dayoff, $dates->getDstOffset());

        $xml = <<<EOT
<?xml version="1.0"?>
<result stdoff="$stdoff" dayoff="$dayoff" xmlns:urn="urn:zimbraAdmin">
    <urn:standard mon="$std_mon" mday="$std_mday" />
    <urn:daylight mon="$day_mon" mday="$day_mday" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dates, 'xml'));
        $this->assertEquals($dates, $this->serializer->deserialize($xml, StubTzFixupRuleMatchDates::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubTzFixupRuleMatchDates extends TzFixupRuleMatchDates
{
}
