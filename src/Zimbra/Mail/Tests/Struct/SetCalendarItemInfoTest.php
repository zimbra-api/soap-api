<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\Msg;
use Zimbra\Mail\Struct\SetCalendarItemInfo;

/**
 * Testcase class for SetCalendarItemInfo.
 */
class SetCalendarItemInfoTest extends ZimbraMailTestCase
{
    public function testSetCalendarItemInfo()
    {
        $m = new Msg();

        $item = new SetCalendarItemInfo(
            $m, ParticipationStatus::NEEDS_ACTION()
        );
        $this->assertSame($m, $item->getMsg());
        $this->assertTrue($item->getPartStat()->is('NE'));

        $item = new SetCalendarItemInfo();
        $item->setMsg($m)
             ->setPartStat(ParticipationStatus::NEEDS_ACTION());
        $this->assertSame($m, $item->getMsg());
        $this->assertTrue($item->getPartStat()->is('NE'));

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<item ptst="' . ParticipationStatus::NEEDS_ACTION() . '">'
                .'<m />'
            .'</item>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $item);

        $array = array(
            'item' => array(
                'ptst' => ParticipationStatus::NEEDS_ACTION()->value(),
                'm' => array(),
            ),
        );
        $this->assertEquals($array, $item->toArray());
    }
}
