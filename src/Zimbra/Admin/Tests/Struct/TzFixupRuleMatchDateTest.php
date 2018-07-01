<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\TzFixupRuleMatchDate;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TzFixupRuleMatchDate.
 */
class TzFixupRuleMatchDateTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<date mon="' . $mon . '" mday="' . $mday . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($date, 'xml'));

        $date = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\TzFixupRuleMatchDate', 'xml');
        $this->assertSame($mon, $date->getMonth());
        $this->assertSame($mday, $date->getMonthDay());
    }
}
