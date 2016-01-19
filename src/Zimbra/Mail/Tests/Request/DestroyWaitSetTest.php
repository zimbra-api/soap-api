<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\DestroyWaitSet;

/**
 * Testcase class for DestroyWaitSet.
 */
class DestroyWaitSetTest extends ZimbraMailApiTestCase
{
    public function testDestroyWaitSetRequest()
    {
        $waitSet = $this->faker->uuid;
        $req = new DestroyWaitSet(
            $waitSet
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($waitSet, $req->getWaitSetId());

        $req = new DestroyWaitSet('');
        $req->setWaitSetId($waitSet);
        $this->assertSame($waitSet, $req->getWaitSetId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DestroyWaitSetRequest waitSet="' . $waitSet . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DestroyWaitSetRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'waitSet' => $waitSet,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDestroyWaitSetApi()
    {
        $waitSet = $this->faker->uuid;
        $this->api->destroyWaitSet(
            $waitSet
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DestroyWaitSetRequest waitSet="' . $waitSet . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
