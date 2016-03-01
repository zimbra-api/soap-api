<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailYabDataSource;

/**
 * Testcase class for MailYabDataSource.
 */
class MailYabDataSourceTest extends ZimbraMailTestCase
{
    public function testMailYabDataSource()
    {
        $yab = new MailYabDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $yab);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<yab />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $yab);

        $array = array(
            'yab' => array(),
        );
        $this->assertEquals($array, $yab->toArray());
    }
}
