<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetFreeBusy;
use Zimbra\Mail\Struct\FreeBusyUserSpec;

/**
 * Testcase class for GetFreeBusy.
 */
class GetFreeBusyTest extends ZimbraMailApiTestCase
{
    public function testGetFreeBusyRequest()
    {
        $id = $this->faker->uuid;
        $uid = $this->faker->uuid;
        $excludeUid = $this->faker->uuid;
        $name = $this->faker->word;
        $l = mt_rand(1, 10);
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);

        $usr = new FreeBusyUserSpec(
            $l, $id, $name
        );

        $req = new GetFreeBusy(
            $s, $e, $uid, $id, $name, $excludeUid, [$usr]
        );
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());
        $this->assertSame($uid, $req->getUid());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame($excludeUid, $req->getExcludeUid());
        $this->assertSame([$usr], $req->getFreebusyUsers()->all());

        $req = new GetFreeBusy(
            0, 0
        );
        $req->setStartTime($s)
            ->setEndTime($e)
            ->setUid($uid)
            ->setId($id)
            ->setName($name)
            ->setExcludeUid($excludeUid)
            ->setFreebusyUsers([$usr])
            ->addFreebusyUser($usr);
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());
        $this->assertSame($uid, $req->getUid());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame($excludeUid, $req->getExcludeUid());
        $this->assertSame([$usr, $usr], $req->getFreebusyUsers()->all());

        $req = new GetFreeBusy(
            $s, $e, $uid, $id, $name, $excludeUid, [$usr]
        );
        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetFreeBusyRequest s="' . $s . '" e="' . $e . '" uid="' . $uid . '" id="' . $id . '" name="' . $name . '" excludeUid="' . $excludeUid . '">'
                .'<usr l="' . $l . '" id="' . $id . '" name="' . $name . '" />'
            .'</GetFreeBusyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetFreeBusyRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                's' => $s,
                'e' => $e,
                'uid' => $uid,
                'id' => $id,
                'name' => $name,
                'excludeUid' => $excludeUid,
                'usr' => array(
                    array(
                        'l' => $l,
                        'id' => $id,
                        'name' => $name,
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetFreeBusyApi()
    {
        $id = $this->faker->uuid;
        $uid = $this->faker->uuid;
        $excludeUid = $this->faker->uuid;
        $name = $this->faker->word;
        $l = mt_rand(1, 10);
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);
        $usr = new FreeBusyUserSpec(
            $l, $id, $name
        );

        $this->api->getFreeBusy(
            $s, $e, $uid, $id, $name, $excludeUid, [$usr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetFreeBusyRequest s="' . $s . '" e="' . $e . '" uid="' . $uid . '" id="' . $id . '" name="' . $name . '" excludeUid="' . $excludeUid . '">'
                        .'<urn1:usr l="' . $l . '" id="' . $id . '" name="' . $name . '" />'
                    .'</urn1:GetFreeBusyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
