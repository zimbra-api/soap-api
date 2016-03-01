<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\SetMailboxMetadata;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for SetMailboxMetadata.
 */
class SetMailboxMetadataTest extends ZimbraMailApiTestCase
{
    public function testSetMailboxMetadataRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $section = $this->faker->word;

        $a = new KeyValuePair($key, $value);
        $meta = new MailCustomMetadata($section, [$a]);

        $req = new SetMailboxMetadata(
            $meta
        );
        $this->assertSame($meta, $req->getMetadata());

        $req = new SetMailboxMetadata();
        $req->setMetadata($meta);
        $this->assertSame($meta, $req->getMetadata());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SetMailboxMetadataRequest>'
                .'<meta section="' . $section . '">'
                    .'<a n="' . $key . '">' . $value . '</a>'
                .'</meta>'
            .'</SetMailboxMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SetMailboxMetadataRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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

    public function testSetMailboxMetadataApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $section = $this->faker->word;

        $a = new KeyValuePair($key, $value);
        $meta = new MailCustomMetadata($section, [$a]);

        $this->api->setMailboxMetadata(
            $meta
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SetMailboxMetadataRequest>'
                        .'<urn1:meta section="' . $section . '">'
                            .'<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                        .'</urn1:meta>'
                    .'</urn1:SetMailboxMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
