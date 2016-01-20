<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ImportContacts;
use Zimbra\Mail\Struct\Content;

/**
 * Testcase class for ImportContacts.
 */
class ImportContactsTest extends ZimbraMailApiTestCase
{
    public function testImportContactsRequest()
    {
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $ct = $this->faker->word;
        $l = $this->faker->word;
        $csvfmt = $this->faker->word;
        $csvlocale = $this->faker->word;
        $content = new Content(
            $value, $aid
        );

        $req = new ImportContacts(
            $ct, $content, $l, $csvfmt, $csvlocale
        );
        $this->assertSame($ct, $req->getContentType());
        $this->assertSame($content, $req->getContent());
        $this->assertSame($l, $req->getFolderId());
        $this->assertSame($csvfmt, $req->getCsvFormat());
        $this->assertSame($csvlocale, $req->getCsvLocale());

        $req = new ImportContacts(
            '', new Content('', '')
        );
        $req->setContentType($ct)
            ->setContent($content)
            ->setFolderId($l)
            ->setCsvFormat($csvfmt)
            ->setCsvLocale($csvlocale);
        $this->assertSame($ct, $req->getContentType());
        $this->assertSame($content, $req->getContent());
        $this->assertSame($l, $req->getFolderId());
        $this->assertSame($csvfmt, $req->getCsvFormat());
        $this->assertSame($csvlocale, $req->getCsvLocale());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ImportContactsRequest ct="' . $ct . '" l="' . $l . '" csvfmt="' . $csvfmt . '" csvlocale="' . $csvlocale . '">'
                .'<content aid="' . $aid . '">' . $value . '</content>'
            .'</ImportContactsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ImportContactsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'ct' => $ct,
                'l' => $l,
                'csvfmt' => $csvfmt,
                'csvlocale' => $csvlocale,
                'content' => array(
                    '_content' => $value,
                    'aid' => $aid,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testImportContactsApi()
    {
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $ct = $this->faker->word;
        $l = $this->faker->word;
        $csvfmt = $this->faker->word;
        $csvlocale = $this->faker->word;
        $content = new Content(
            $value, $aid
        );
        $this->api->importContacts(
            $ct, $content, $l, $csvfmt, $csvlocale
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ImportContactsRequest ct="' . $ct . '" l="' . $l . '" csvfmt="' . $csvfmt . '" csvlocale="' . $csvlocale . '">'
                        .'<urn1:content aid="' . $aid . '">' . $value . '</urn1:content>'
                    .'</urn1:ImportContactsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
