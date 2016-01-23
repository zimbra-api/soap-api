<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ModifyDataSource;

/**
 * Testcase class for ModifyDataSource.
 */
class MailModifyDataSourceTest extends ZimbraMailApiTestCase
{
    public function testModifyDataSourceRequest()
    {
        $imap = new \Zimbra\Mail\Struct\MailImapDataSource();
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(true);
        $req = new ModifyDataSource(
            $pop3
        );
        $this->assertSame($pop3, $req->getDataSource());
        $req->setDataSource($imap);
        $this->assertSame($imap, $req->getDataSource());
        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyDataSourceRequest>'
                .'<imap />'
            .'</ModifyDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyDataSourceRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'imap' => [],
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDataSourceApi()
    {
        $imap = new \Zimbra\Mail\Struct\MailImapDataSource();
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(true);
        $caldav = new \Zimbra\Mail\Struct\MailCaldavDataSource();
        $yab = new \Zimbra\Mail\Struct\MailYabDataSource();
        $rss = new \Zimbra\Mail\Struct\MailRssDataSource();
        $gal = new \Zimbra\Mail\Struct\MailGalDataSource();
        $cal = new \Zimbra\Mail\Struct\MailCalDataSource();
        $unknown = new \Zimbra\Mail\Struct\MailUnknownDataSource();

        $this->api->modifyImapDataSource(
           $imap
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:imap />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->modifyPop3DataSource(
           $pop3
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:pop3 leaveOnServer="true" />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->modifyCaldavDataSource(
           $caldav
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:caldav />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->modifyYabDataSource(
           $yab
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:yab />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->modifyRssDataSource(
           $rss
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:rss />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->modifyGalDataSource(
           $gal
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:gal />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->modifyCalDataSource(
           $cal
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:cal />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->modifyUnknownDataSource(
           $unknown
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:unknown />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
