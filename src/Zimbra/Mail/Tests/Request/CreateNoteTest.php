<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\CreateNote;
use Zimbra\Mail\Struct\NewNoteSpec;

/**
 * Testcase class for CreateNote.
 */
class CreateNoteTest extends ZimbraMailApiTestCase
{
    public function testCreateNoteRequest()
    {
        $l = $this->faker->word;
        $content = $this->faker->uuid;
        $pos = $this->faker->word;
        $color = mt_rand(1, 127);
        $note = new NewNoteSpec(
            $l, $content, $color, $pos
        );

        $req = new CreateNote(
            $note
        );
        $this->assertSame($note, $req->getNote());
        $req->setNote($note);
        $this->assertSame($note, $req->getNote());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateNoteRequest>'
                .'<note l="' . $l . '" content="' . $content . '" color="' . $color . '" pos="' . $pos . '" />'
            .'</CreateNoteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateNoteRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'note' => array(
                    'l' => $l,
                    'content' => $content,
                    'color' => $color,
                    'pos' => $pos,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateNoteApi()
    {
        $l = $this->faker->word;
        $content = $this->faker->uuid;
        $pos = $this->faker->word;
        $color = mt_rand(1, 127);
        $note = new NewNoteSpec(
            $l, $content, $color, $pos
        );

        $this->api->createNote(
           $note
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateNoteRequest>'
                        .'<urn1:note l="' . $l . '" content="' . $content . '" color="' . $color . '" pos="' . $pos . '" />'
                    .'</urn1:CreateNoteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
