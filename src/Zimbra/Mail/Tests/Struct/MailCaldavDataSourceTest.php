<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailCaldavDataSource;

/**
 * Testcase class for MailCaldavDataSource.
 */
class MailCaldavDataSourceTest extends ZimbraMailTestCase
{
    public function testMailCaldavDataSource()
    {
        $caldav = new MailCaldavDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $caldav);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<caldav />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $caldav);

        $array = array(
            'caldav' => array(),
        );
        $this->assertEquals($array, $caldav->toArray());
    }
}
