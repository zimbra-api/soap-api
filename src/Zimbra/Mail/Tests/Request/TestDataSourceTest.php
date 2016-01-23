<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\TestDataSource;
use Zimbra\Mail\Struct\MailImapDataSource;
use Zimbra\Mail\Struct\MailPop3DataSource;

/**
 * Testcase class for TestDataSource.
 */
class TestDataSourceTest extends ZimbraMailApiTestCase
{
    public function testTestDataSourceRequest()
    {
        $pop3 = new MailPop3DataSource(true);
        $imap = new MailImapDataSource();

        $req = new TestDataSource(
            $pop3
        );
        $this->assertSame($pop3, $req->getDataSource());
        $req->setDataSource($imap);
        $this->assertSame($imap, $req->getDataSource());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<TestDataSourceRequest>'
                .'<imap />'
            .'</TestDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'TestDataSourceRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'imap' => array(),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testTestDataSourceApi()
    {
        $imap = new \Zimbra\Mail\Struct\MailImapDataSource();
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(true);
        $caldav = new \Zimbra\Mail\Struct\MailCaldavDataSource();
        $yab = new \Zimbra\Mail\Struct\MailYabDataSource();
        $rss = new \Zimbra\Mail\Struct\MailRssDataSource();
        $gal = new \Zimbra\Mail\Struct\MailGalDataSource();
        $cal = new \Zimbra\Mail\Struct\MailCalDataSource();
        $unknown = new \Zimbra\Mail\Struct\MailUnknownDataSource();

        $this->api->testImapDataSource(
           $imap
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:imap />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->testPop3DataSource(
           $pop3
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:pop3 leaveOnServer="true" />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->testCaldavDataSource(
           $caldav
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:caldav />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->testYabDataSource(
           $yab
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:yab />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->testRssDataSource(
           $rss
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:rss />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->testGalDataSource(
           $gal
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:gal />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->testCalDataSource(
           $cal
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:cal />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->testUnknownDataSource(
           $unknown
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:unknown />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
