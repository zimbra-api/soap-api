<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\AddRecurrenceInfo;

/**
 * Testcase class for AddRecurrenceInfo.
 */
class AddRecurrenceInfoTest extends ZimbraMailTestCase
{
    public function testAddRecurrenceInfo()
    {
        $add = new AddRecurrenceInfo();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\RecurrenceInfo', $add);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<add />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $add);

        $array = array(
            'add' => array(),
        );
        $this->assertEquals($array, $add->toArray());
    }
}
