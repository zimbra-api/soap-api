<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\TzFixupRuleMatchDate;

/**
 * Testcase class for TzFixupRuleMatchDate.
 */
class TzFixupRuleMatchDateTest extends ZimbraAdminTestCase
{
    public function testTzFixupRuleMatchDate()
    {
        $mon = mt_rand(1, 12);
        $mday = mt_rand(1, 31);
        $date = new TzFixupRuleMatchDate($mon, $mday);
        $this->assertSame($mon, $date->getMonth());
        $this->assertSame($mday, $date->getMonthDay());

        $date->setMonth($mon)
             ->setMonthDay($mday);
        $this->assertSame($mon, $date->getMonth());
        $this->assertSame($mday, $date->getMonthDay());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<date mon="' . $mon . '" mday="' . $mday . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $date);

        $array = [
            'date' => [
                'mon' => $mon,
                'mday' => $mday,
            ],
        ];
        $this->assertEquals($array, $date->toArray());
    }
}
