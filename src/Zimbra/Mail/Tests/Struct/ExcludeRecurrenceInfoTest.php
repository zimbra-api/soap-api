<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ExcludeRecurrenceInfo;

/**
 * Testcase class for ExcludeRecurrenceInfo.
 */
class ExcludeRecurrenceInfoTest extends ZimbraMailTestCase
{
    public function testExcludeRecurrenceInfo()
    {
        $exclude = new ExcludeRecurrenceInfo();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\RecurrenceInfo', $exclude);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<exclude />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $exclude);

        $array = array(
            'exclude' => array(),
        );
        $this->assertEquals($array, $exclude->toArray());
    }
}
