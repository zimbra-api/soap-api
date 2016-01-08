<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailCalDataSource;

/**
 * Testcase class for MailCalDataSource.
 */
class MailCalDataSourceTest extends ZimbraMailTestCase
{
    public function testMailCalDataSource()
    {
        $cal = new MailCalDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $cal);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<cal />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = array(
            'cal' => array(),
        );
        $this->assertEquals($array, $cal->toArray());
    }
}
