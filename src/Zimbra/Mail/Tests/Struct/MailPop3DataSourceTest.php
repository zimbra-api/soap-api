<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailPop3DataSource;

/**
 * Testcase class for MailPop3DataSource.
 */
class MailPop3DataSourceTest extends ZimbraMailTestCase
{
    public function testMailPop3DataSource()
    {
        $pop3 = new MailPop3DataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $pop3);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<pop3 />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pop3);

        $array = array(
            'pop3' => array(),
        );
        $this->assertEquals($array, $pop3->toArray());
    }
}
