<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetCustomMetadata;
use Zimbra\Mail\Struct\SectionAttr;

/**
 * Testcase class for GetCustomMetadata.
 */
class GetCustomMetadataTest extends ZimbraMailApiTestCase
{
    public function testGetCustomMetadataRequest()
    {
        $id = $this->faker->uuid;
        $section = $this->faker->word;
        $meta = new SectionAttr($section);
        $req = new GetCustomMetadata(
            $id, $meta
        );
        $this->assertSame($id, $req->getId());
        $this->assertSame($meta, $req->getMetadata());

        $req->setId($id)
            ->setMetadata($meta);
        $this->assertSame($id, $req->getId());
        $this->assertSame($meta, $req->getMetadata());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCustomMetadataRequest id="' . $id .'">'
                .'<meta section="' . $section . '" />'
            .'</GetCustomMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCustomMetadataRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'id' => $id,
                'meta' => array(
                    'section' => $section,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCustomMetadataApi()
    {
        $id = $this->faker->uuid;
        $section = $this->faker->word;
        $meta = new SectionAttr($section);

        $this->api->getCustomMetadata(
            $id, $meta
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetCustomMetadataRequest id="' . $id . '">'
                        .'<urn1:meta section="' . $section . '" />'
                    .'</urn1:GetCustomMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
