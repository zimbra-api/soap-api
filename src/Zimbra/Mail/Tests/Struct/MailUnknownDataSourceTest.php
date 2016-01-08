<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailUnknownDataSource;

/**
 * Testcase class for MailUnknownDataSource.
 */
class MailUnknownDataSourceTest extends ZimbraMailTestCase
{
    public function testMailUnknownDataSource()
    {
        $unknown = new MailUnknownDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $unknown);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<unknown />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $unknown);

        $array = array(
            'unknown' => array(),
        );
        $this->assertEquals($array, $unknown->toArray());
    }
}
