<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\SetCustomMetadata;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for SetCustomMetadata.
 */
class SetCustomMetadataTest extends ZimbraMailApiTestCase
{
    public function testSetCustomMetadataRequest()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $section = $this->faker->word;

        $a = new KeyValuePair($key, $value);
        $meta = new MailCustomMetadata($section, [$a]);

        $req = new SetCustomMetadata(
            $id, $meta
        );
        $this->assertSame($id, $req->getId());
        $this->assertSame($meta, $req->getMetadata());

        $req = new SetCustomMetadata('');
        $req->setId($id)
            ->setMetadata($meta);
        $this->assertSame($id, $req->getId());
        $this->assertSame($meta, $req->getMetadata());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SetCustomMetadataRequest id="' . $id . '">'
                .'<meta section="' . $section . '">'
                    .'<a n="' . $key . '">' . $value . '</a>'
                .'</meta>'
            .'</SetCustomMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SetCustomMetadataRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'id' => $id,
                'meta' => array(
                    'a' => array(
                        array('n' => $key, '_content' => $value)
                    ),
                    'section' => $section,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetCustomMetadataApi()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $section = $this->faker->word;

        $a = new KeyValuePair($key, $value);
        $meta = new MailCustomMetadata($section, [$a]);

        $this->api->setCustomMetadata(
            $id, $meta
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SetCustomMetadataRequest id="' . $id . '">'
                        .'<urn1:meta section="' . $section . '">'
                            .'<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                        .'</urn1:meta>'
                    .'</urn1:SetCustomMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
