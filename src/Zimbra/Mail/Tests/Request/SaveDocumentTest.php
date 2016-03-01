<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\SaveDocument;
use Zimbra\Mail\Struct\DocumentSpec;
use Zimbra\Mail\Struct\MessagePartSpec;
use Zimbra\Mail\Struct\IdVersion;
use Zimbra\Struct\Id;

/**
 * Testcase class for SaveDocument.
 */
class SaveDocumentTest extends ZimbraMailApiTestCase
{
    public function testSaveDocumentRequest()
    {
        $id = $this->faker->word;
        $part = $this->faker->word;
        $ver = mt_rand(1, 100);
        $name = $this->faker->word;
        $ct = $this->faker->word;
        $desc = $this->faker->word;
        $folder = $this->faker->word;
        $content = $this->faker->word;
        $flags = $this->faker->word;

        $upload = new Id($id);
        $m = new MessagePartSpec(
            $id, $part
        );
        $docVer = new IdVersion(
            $id, $ver
        );
        $doc = new DocumentSpec(
            $name, $ct, $desc, $folder, $id, $ver, $content, true, $flags, $upload, $m, $docVer
        );

        $req = new SaveDocument(
            $doc
        );
        $this->assertSame($doc, $req->getDoc());

        $req = new SaveDocument(
            new DocumentSpec()
        );
        $req->setDoc($doc);
        $this->assertSame($doc, $req->getDoc());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SaveDocumentRequest>'
                .'<doc name="' . $name . '" ct="' . $ct . '" desc="' . $desc . '" l="' . $folder . '" id="' . $id . '" ver="' . $ver . '" content="' . $content . '" descEnabled="true" f="' . $flags . '">'
                    .'<upload id="' . $id . '" />'
                    .'<m id="' . $id . '" part="' . $part . '" />'
                    .'<doc id="' . $id . '" ver="' . $ver . '" />'
                .'</doc>'
            .'</SaveDocumentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SaveDocumentRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'doc' => array(
                    'name' => $name,
                    'ct' => $ct,
                    'desc' => $desc,
                    'l' => $folder,
                    'id' => $id,
                    'ver' => $ver,
                    'content' => $content,
                    'descEnabled' => true,
                    'f' => $flags,
                    'upload' => array(
                        'id' => $id,
                    ),
                    'm' => array(
                        'id' => $id,
                        'part' => $part,
                    ),
                    'doc' => array(
                        'id' => $id,
                        'ver' => $ver,
                    ),
                )
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSaveDocumentApi()
    {
        $id = $this->faker->word;
        $part = $this->faker->word;
        $ver = mt_rand(1, 100);
        $name = $this->faker->word;
        $ct = $this->faker->word;
        $desc = $this->faker->word;
        $folder = $this->faker->word;
        $content = $this->faker->word;
        $flags = $this->faker->word;

        $upload = new Id($id);
        $m = new MessagePartSpec(
            $id, $part
        );
        $docVer = new IdVersion(
            $id, $ver
        );
        $doc = new DocumentSpec(
            $name, $ct, $desc, $folder, $id, $ver, $content, true, $flags, $upload, $m, $docVer
        );
        $this->api->saveDocument(
            $doc
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SaveDocumentRequest>'
                        .'<urn1:doc name="' . $name . '" ct="' . $ct . '" desc="' . $desc . '" l="' . $folder . '" id="' . $id . '" ver="' . $ver . '" content="' . $content . '" descEnabled="true" f="' . $flags . '">'
                            .'<urn1:upload id="' . $id . '" />'
                            .'<urn1:m id="' . $id . '" part="' . $part . '" />'
                            .'<urn1:doc id="' . $id . '" ver="' . $ver . '" />'
                        .'</urn1:doc>'
                    .'</urn1:SaveDocumentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
