<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetMailboxMetadata;
use Zimbra\Mail\Struct\SectionAttr;

/**
 * Testcase class for GetMailboxMetadata.
 */
class GetMailboxMetadataTest extends ZimbraMailApiTestCase
{
    public function testGetMailboxMetadataRequest()
    {
        $section = $this->faker->word;
        $meta = new SectionAttr($section);
        $req = new GetMailboxMetadata(
            $meta
        );
        $this->assertSame($meta, $req->getMetadata());
        $req->setMetadata($meta);
        $this->assertSame($meta, $req->getMetadata());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMailboxMetadataRequest>'
                .'<meta section="' . $section . '" />'
            .'</GetMailboxMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMailboxMetadataRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'meta' => array(
                    'section' => $section,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailboxMetadataApi()
    {
        $section = $this->faker->word;
        $meta = new SectionAttr($section);
        $this->api->getMailboxMetadata(
            $meta
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetMailboxMetadataRequest>'
                        .'<urn1:meta section="' . $section . '" />'
                    .'</urn1:GetMailboxMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
