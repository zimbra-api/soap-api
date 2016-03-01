<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\CreateDataSource;

/**
 * Testcase class for CreateDataSource.
 */
class MailCreateDataSourceTest extends ZimbraMailApiTestCase
{
    public function testCreateDataSourceRequest()
    {
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(true);
        $imap = new \Zimbra\Mail\Struct\MailImapDataSource();

        $req = new CreateDataSource(
            $imap
        );
        $this->assertSame($imap, $req->getDataSource());
        $req->setDataSource($pop3);
        $this->assertSame($pop3, $req->getDataSource());

        $req = new CreateDataSource(
            $pop3
        );
        $this->assertSame($pop3, $req->getDataSource());
        $req->setDataSource($imap);
        $this->assertSame($imap, $req->getDataSource());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateDataSourceRequest>'
                .'<imap />'
            .'</CreateDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateDataSourceRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'imap' => array(
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDataSourceApi()
    {
        $imap = new \Zimbra\Mail\Struct\MailImapDataSource();
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(true);
        $caldav = new \Zimbra\Mail\Struct\MailCaldavDataSource();
        $yab = new \Zimbra\Mail\Struct\MailYabDataSource();
        $rss = new \Zimbra\Mail\Struct\MailRssDataSource();
        $gal = new \Zimbra\Mail\Struct\MailGalDataSource();
        $cal = new \Zimbra\Mail\Struct\MailCalDataSource();
        $unknown = new \Zimbra\Mail\Struct\MailUnknownDataSource();

        $this->api->createImapDataSource(
           $imap
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:imap />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->createPop3DataSource(
           $pop3
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:pop3 leaveOnServer="true" />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->createCaldavDataSource(
           $caldav
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:caldav />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->createYabDataSource(
           $yab
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:yab />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->createRssDataSource(
           $rss
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:rss />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->createGalDataSource(
           $gal
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:gal />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->createCalDataSource(
           $cal
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:cal />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->api->createUnknownDataSource(
           $unknown
        );
        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:unknown />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
