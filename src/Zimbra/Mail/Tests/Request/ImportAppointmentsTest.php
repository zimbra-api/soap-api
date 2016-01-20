<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ImportAppointments;
use Zimbra\Mail\Struct\ContentSpec;

/**
 * Testcase class for ImportAppointments.
 */
class ImportAppointmentsTest extends ZimbraMailApiTestCase
{
    public function testImportAppointmentsRequest()
    {
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $mid = $this->faker->word;
        $part = $this->faker->word;
        $ct = $this->faker->word;
        $l = $this->faker->word;
        $content = new ContentSpec(
            $value, $aid, $mid, $part
        );

        $req = new ImportAppointments(
            $ct, $content, $l
        );
        $this->assertSame($ct, $req->getContentType());
        $this->assertSame($content, $req->getContent());
        $this->assertSame($l, $req->getFolderId());

        $req = new ImportAppointments(
            '', new ContentSpec('', '', '', '')
        );
        $req->setContentType($ct)
            ->setContent($content)
            ->setFolderId($l);
        $this->assertSame($ct, $req->getContentType());
        $this->assertSame($content, $req->getContent());
        $this->assertSame($l, $req->getFolderId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ImportAppointmentsRequest ct="' . $ct . '" l="' . $l . '">'
                .'<content aid="' . $aid . '" mid="' . $mid . '" part="' . $part . '">' . $value . '</content>'
            .'</ImportAppointmentsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ImportAppointmentsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'ct' => $ct,
                'l' => $l,
                'content' => array(
                    '_content' => $value,
                    'aid' => $aid,
                    'mid' => $mid,
                    'part' => $part,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testImportAppointmentsApi()
    {
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $mid = $this->faker->word;
        $part = $this->faker->word;
        $ct = $this->faker->word;
        $l = $this->faker->word;
        $content = new ContentSpec(
            $value, $aid, $mid, $part
        );
        $this->api->importAppointments($ct, $content, $l);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ImportAppointmentsRequest ct="' . $ct . '" l="' . $l . '">'
                        .'<urn1:content aid="' . $aid . '" mid="' . $mid . '" part="' . $part . '">' . $value . '</urn1:content>'
                    .'</urn1:ImportAppointmentsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
