<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailGalDataSource;

/**
 * Testcase class for MailGalDataSource.
 */
class MailGalDataSourceTest extends ZimbraMailTestCase
{
    public function testMailGalDataSource()
    {
        $gal = new MailGalDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $gal);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<gal />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $gal);

        $array = array(
            'gal' => array(),
        );
        $this->assertEquals($array, $gal->toArray());
    }
}
