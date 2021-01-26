<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Enum\WeekDay;
use Zimbra\Mail\Struct\WkDay;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for WkDay.
 */
class WkDayTest extends ZimbraStructTestCase
{
    public function testWkDay()
    {
        $day = WeekDay::SU();
        $ordWk = mt_rand(1, 53);

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
<wkday day="SU" ordwk="$ordWk" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($wkday, 'xml'));
        $this->assertEquals($wkday, $this->serializer->deserialize($xml, WkDay::class, 'xml'));

        $json = json_encode([
            'day' => 'SU',
            'ordwk' => $ordWk,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($wkday, 'json'));
        $this->assertEquals($wkday, $this->serializer->deserialize($json, WkDay::class, 'json'));
    }
}
