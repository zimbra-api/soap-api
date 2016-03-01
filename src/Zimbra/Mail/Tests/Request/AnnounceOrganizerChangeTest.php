<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\AnnounceOrganizerChange;

/**
 * Testcase class for AnnounceOrganizerChange.
 */
class AnnounceOrganizerChangeTest extends ZimbraMailApiTestCase
{
    public function testAnnounceOrganizerChangeRequest()
    {
        $id = $this->faker->uuid;
        $req = new AnnounceOrganizerChange(
            $id
        );
        $this->assertSame($id, $req->getId());
        $req = new AnnounceOrganizerChange('');
        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AnnounceOrganizerChangeRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AnnounceOrganizerChangeRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'id' => $id,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAnnounceOrganizerChangeApi()
    {
        $id = $this->faker->uuid;
        $this->api->announceOrganizerChange(
           $id
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AnnounceOrganizerChangeRequest id="' . $id . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
