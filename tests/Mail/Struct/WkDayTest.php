<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\WeekDay;
use Zimbra\Mail\Struct\WkDay;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for WkDay.
 */
class WkDayTest extends ZimbraTestCase
{
    public function testWkDay()
    {
        $day = WeekDay::SU();
        $ordWk = $this->faker->numberBetween(1, 53);

        $wkday = new WkDay($day, $ordWk);
        $this->assertSame($day, $wkday->getDay());
        $this->assertSame($ordWk, $wkday->getOrdWk());

        $wkday = new WkDay(WeekDay::SU());
        $wkday->setDay($day)
            ->setOrdWk($ordWk);
        $this->assertSame($day, $wkday->getDay());
        $this->assertSame($ordWk, $wkday->getOrdWk());

        $xml = <<<EOT
<?xml version="1.0"?>
<result day="SU" ordwk="$ordWk" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($wkday, 'xml'));
        $this->assertEquals($wkday, $this->serializer->deserialize($xml, WkDay::class, 'xml'));
    }
}
