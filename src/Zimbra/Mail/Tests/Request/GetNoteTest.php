<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetNote;
use Zimbra\Struct\Id;

/**
 * Testcase class for GetNote.
 */
class GetNoteTest extends ZimbraMailApiTestCase
{
    public function testGetNoteRequest()
    {
        $id = $this->faker->uuid;
        $note = new Id($id);
        $req = new GetNote(
            $note
        );
        $this->assertSame($note, $req->getNote());
        $req->setNote($note);
        $this->assertSame($note, $req->getNote());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetNoteRequest>'
                .'<note id="' . $id . '" />'
            .'</GetNoteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetNoteRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'note' => array(
                    'id' => $id,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetNoteApi()
    {
        $id = $this->faker->uuid;
        $note = new Id($id);
        $this->api->getNote(
            $note
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetNoteRequest>'
                        .'<urn1:note id="' . $id . '" />'
                    .'</urn1:GetNoteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
