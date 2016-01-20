<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\GetMiniCal;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Struct\Id;

/**
 * Testcase class for GetMiniCal.
 */
class GetMiniCalTest extends ZimbraMailApiTestCase
{
    public function testGetMiniCalRequest()
    {
        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);
        $tz = new CalTZInfo($id, $stdoff, $dayoff);
        $folder = new Id($id);

        $req = new GetMiniCal(
            $s, $e, [$folder], $tz
        );
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());
        $this->assertSame([$folder], $req->getFolders()->all());
        $this->assertSame($tz, $req->getTimezone());

        $req = new GetMiniCal(
            0, 0
        );
        $req->setStartTime($s)
            ->setEndTime($e)
            ->setFolders([$folder])
            ->addFolder($folder)
            ->setTimezone($tz);
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());
        $this->assertSame([$folder, $folder], $req->getFolders()->all());
        $this->assertSame($tz, $req->getTimezone());

        $req = new GetMiniCal(
            $s, $e, [$folder], $tz
        );
        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMiniCalRequest s="' . $s . '" e="' . $e . '">'
                .'<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                .'<folder id="' . $id . '" />'
            .'</GetMiniCalRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMiniCalRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                's' => $s,
                'e' => $e,
                'folder' => array(
                    array(
                        'id' => $id,
                    ),
                ),
                'tz' => array(
                    'id' => $id,
                    'stdoff' => $stdoff,
                    'dayoff' => $dayoff,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMiniCalApi()
    {
        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);
        $tz = new CalTZInfo($id, $stdoff, $dayoff);
        $folder = new Id($id);
        $this->api->getMiniCal(
            $s, $e, [$folder], $tz
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetMiniCalRequest s="' . $s . '" e="' . $e . '">'
                        .'<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                        .'<urn1:folder id="' . $id . '" />'
                    .'</urn1:GetMiniCalRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
