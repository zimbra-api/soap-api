<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailRssDataSource;

/**
 * Testcase class for MailRssDataSource.
 */
class MailRssDataSourceTest extends ZimbraMailTestCase
{
    public function testMailRssDataSource()
    {
        $rss = new MailRssDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $rss);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<rss />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rss);

        $array = array(
            'rss' => array(),
        );
        $this->assertEquals($array, $rss->toArray());
    }
}
