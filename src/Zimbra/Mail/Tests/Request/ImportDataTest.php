<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ImportData;

/**
 * Testcase class for ImportData.
 */
class ImportDataTest extends ZimbraMailApiTestCase
{
    public function testImportDataRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $imap = new \Zimbra\Mail\Struct\ImapDataSourceNameOrId($name, $id);
        $pop3 = new \Zimbra\Mail\Struct\Pop3DataSourceNameOrId($name, $id);
        $caldav = new \Zimbra\Mail\Struct\CaldavDataSourceNameOrId($name, $id);
        $yab = new \Zimbra\Mail\Struct\YabDataSourceNameOrId($name, $id);
        $rss = new \Zimbra\Mail\Struct\RssDataSourceNameOrId($name, $id);
        $gal = new \Zimbra\Mail\Struct\GalDataSourceNameOrId($name, $id);
        $cal = new \Zimbra\Mail\Struct\CalDataSourceNameOrId($name, $id);
        $unknown = new \Zimbra\Mail\Struct\UnknownDataSourceNameOrId($name, $id);

        $req = new ImportData(
            [$imap, $pop3, $caldav, $yab, $rss, $gal, $cal]
        );
        $this->assertSame([$imap, $pop3, $caldav, $yab, $rss, $gal, $cal], $req->getDataSources()->all());
        $req->addDataSource($unknown);
        $this->assertSame([$imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown], $req->getDataSources()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ImportDataRequest>'
                .'<imap name="' . $name . '" id="' . $id . '" />'
                .'<pop3 name="' . $name . '" id="' . $id . '" />'
                .'<caldav name="' . $name . '" id="' . $id . '" />'
                .'<yab name="' . $name . '" id="' . $id . '" />'
                .'<rss name="' . $name . '" id="' . $id . '" />'
                .'<gal name="' . $name . '" id="' . $id . '" />'
                .'<cal name="' . $name . '" id="' . $id . '" />'
                .'<unknown name="' . $name . '" id="' . $id . '" />'
            .'</ImportDataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ImportDataRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'imap' => array(
                    'name' => $name,
                    'id' => $id,
                ),
                'pop3' => array(
                    'name' => $name,
                    'id' => $id,
                ),
                'caldav' => array(
                    'name' => $name,
                    'id' => $id,
                ),
                'yab' => array(
                    'name' => $name,
                    'id' => $id,
                ),
                'rss' => array(
                    'name' => $name,
                    'id' => $id,
                ),
                'gal' => array(
                    'name' => $name,
                    'id' => $id,
                ),
                'cal' => array(
                    'name' => $name,
                    'id' => $id,
                ),
                'unknown' => array(
                    'name' => $name,
                    'id' => $id,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testImportDataApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $imap = new \Zimbra\Mail\Struct\ImapDataSourceNameOrId($name, $id);
        $pop3 = new \Zimbra\Mail\Struct\Pop3DataSourceNameOrId($name, $id);
        $caldav = new \Zimbra\Mail\Struct\CaldavDataSourceNameOrId($name, $id);
        $yab = new \Zimbra\Mail\Struct\YabDataSourceNameOrId($name, $id);
        $rss = new \Zimbra\Mail\Struct\RssDataSourceNameOrId($name, $id);
        $gal = new \Zimbra\Mail\Struct\GalDataSourceNameOrId($name, $id);
        $cal = new \Zimbra\Mail\Struct\CalDataSourceNameOrId($name, $id);
        $unknown = new \Zimbra\Mail\Struct\UnknownDataSourceNameOrId($name, $id);

        $this->api->importData(
            [$imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ImportDataRequest>'
                        .'<urn1:imap name="' . $name . '" id="' . $id . '" />'
                        .'<urn1:pop3 name="' . $name . '" id="' . $id . '" />'
                        .'<urn1:caldav name="' . $name . '" id="' . $id . '" />'
                        .'<urn1:yab name="' . $name . '" id="' . $id . '" />'
                        .'<urn1:rss name="' . $name . '" id="' . $id . '" />'
                        .'<urn1:gal name="' . $name . '" id="' . $id . '" />'
                        .'<urn1:cal name="' . $name . '" id="' . $id . '" />'
                        .'<urn1:unknown name="' . $name . '" id="' . $id . '" />'
                    .'</urn1:ImportDataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
