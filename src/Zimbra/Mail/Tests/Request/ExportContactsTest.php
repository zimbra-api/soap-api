<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ExportContacts;

/**
 * Testcase class for ExportContacts.
 */
class ExportContactsTest extends ZimbraMailApiTestCase
{
    public function testExportContactsRequest()
    {
        $ct = $this->faker->word;
        $l = $this->faker->word;
        $csvfmt = $this->faker->word;
        $csvlocale = $this->faker->word;
        $csvsep = $this->faker->word;
        $req = new ExportContacts(
            $ct, $l, $csvfmt, $csvlocale, $csvsep
        );
        $this->assertSame($ct, $req->getContentType());
        $this->assertSame($l, $req->getFolderId());
        $this->assertSame($csvfmt, $req->getCsvFormat());
        $this->assertSame($csvlocale, $req->getCsvLocale());
        $this->assertSame($csvsep, $req->getCsvDelimiter());

        $req = new ExportContacts('');
        $req->setContentType($ct)
            ->setFolderId($l)
            ->setCsvFormat($csvfmt)
            ->setCsvLocale($csvlocale)
            ->setCsvDelimiter($csvsep);
        $this->assertSame($ct, $req->getContentType());
        $this->assertSame($l, $req->getFolderId());
        $this->assertSame($csvfmt, $req->getCsvFormat());
        $this->assertSame($csvlocale, $req->getCsvLocale());
        $this->assertSame($csvsep, $req->getCsvDelimiter());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ExportContactsRequest ct="' . $ct . '" l="' . $l . '" csvfmt="' . $csvfmt . '" csvlocale="' . $csvlocale . '" csvsep="' . $csvsep . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ExportContactsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'ct' => $ct,
                'l' => $l,
                'csvfmt' => $csvfmt,
                'csvlocale' => $csvlocale,
                'csvsep' => $csvsep,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testExportContactsApi()
    {
        $ct = $this->faker->word;
        $l = $this->faker->word;
        $csvfmt = $this->faker->word;
        $csvlocale = $this->faker->word;
        $csvsep = $this->faker->word;
        $this->api->exportContacts(
            $ct, $l, $csvfmt, $csvlocale, $csvsep
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ExportContactsRequest ct="' . $ct . '" l="' . $l . '" csvfmt="' . $csvfmt . '" csvlocale="' . $csvlocale . '" csvsep="' . $csvsep . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
