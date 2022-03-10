<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\TzFixupRuleMatchDate;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TzFixupRuleMatchDate.
 */
class TzFixupRuleMatchDateTest extends ZimbraTestCase
{
    public function testTzFixupRuleMatchDate()
    {
        $mon = mt_rand(1, 12);
        $mday = mt_rand(1, 31);
        $date = new TzFixupRuleMatchDate($mon, $mday);
        $this->assertSame($mon, $date->getMonth());
        $this->assertSame($mday, $date->getMonthDay());

        $date = new TzFixupRuleMatchDate(0, 0);
        $date->setMonth($mon)
             ->setMonthDay($mday);
        $this->assertSame($mon, $date->getMonth());
        $this->assertSame($mday, $date->getMonthDay());

        $xml = <<<EOT
<?xml version="1.0"?>
<result mon="$mon" mday="$mday" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($date, 'xml'));
        $this->assertEquals($date, $this->serializer->deserialize($xml, TzFixupRuleMatchDate::class, 'xml'));

        $json = json_encode([
            'mon' => $mon,
            'mday' => $mday,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($date, 'json'));
        $this->assertEquals($date, $this->serializer->deserialize($json, TzFixupRuleMatchDate::class, 'json'));
    }
}
