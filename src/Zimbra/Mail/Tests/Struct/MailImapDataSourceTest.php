<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailImapDataSource;

/**
 * Testcase class for MailImapDataSource.
 */
class MailImapDataSourceTest extends ZimbraMailTestCase
{
    public function testMailImapDataSource()
    {
        $imap = new MailImapDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $imap);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<imap />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $imap);

        $array = array(
            'imap' => array(),
        );
        $this->assertEquals($array, $imap->toArray());
    }
}
