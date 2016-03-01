<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\SearchType;
use Zimbra\Mail\Request\CreateMountpoint;
use Zimbra\Mail\Struct\NewMountpointSpec;

/**
 * Testcase class for CreateMountpoint.
 */
class CreateMountpointTest extends ZimbraMailApiTestCase
{
    public function testCreateMountpointRequest()
    {
        $name = $this->faker->word;
        $f = $this->faker->uuid;
        $rgb = $this->faker->hexcolor;
        $url = $this->faker->word;
        $l = $this->faker->word;
        $zid = $this->faker->uuid;
        $owner = $this->faker->word;
        $path = $this->faker->word;
        $color = mt_rand(1, 127);
        $rid = mt_rand(1, 10);
        $link = new NewMountpointSpec(
            $name, SearchType::TASK(), $f, $color, $rgb, $url, $l, true, true, $zid, $owner, $rid, $path
        );

        $req = new CreateMountpoint(
            $link
        );
        $this->assertSame($link, $req->getFolder());
        $req->setFolder($link);
        $this->assertSame($link, $req->getFolder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateMountpointRequest>'
                .'<link name="' . $name . '" view="' . SearchType::TASK() . '" f="' . $f . '" color="' . $color . '" rgb="' . $rgb . '" url="' . $url . '" l="' . $l . '" fie="true" reminder="true" zid="' . $zid . '" owner="' . $owner . '" rid="' . $rid . '" path="' . $path . '" />'
            .'</CreateMountpointRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateMountpointRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'link' => array(
                    'name' => $name,
                    'view' => SearchType::TASK()->value(),
                    'f' => $f,
                    'color' => $color,
                    'rgb' => $rgb,
                    'url' => $url,
                    'l' => $l,
                    'fie' => true,
                    'reminder' => true,
                    'zid' => $zid,
                    'owner' => $owner,
                    'rid' => $rid,
                    'path' => $path,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateMountpointApi()
    {
        $name = $this->faker->word;
        $f = $this->faker->uuid;
        $rgb = $this->faker->hexcolor;
        $url = $this->faker->word;
        $l = $this->faker->word;
        $zid = $this->faker->uuid;
        $owner = $this->faker->word;
        $path = $this->faker->word;
        $color = mt_rand(1, 127);
        $rid = mt_rand(1, 10);
        $link = new NewMountpointSpec(
            $name, SearchType::TASK(), $f, $color, $rgb, $url, $l, true, true, $zid, $owner, $rid, $path
        );

        $this->api->createMountpoint(
           $link
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateMountpointRequest>'
                        .'<urn1:link name="' . $name . '" view="' . SearchType::TASK() . '" f="' . $f . '" color="' . $color . '" rgb="' . $rgb . '" url="' . $url . '" l="' . $l . '" fie="true" reminder="true" zid="' . $zid . '" owner="' . $owner . '" rid="' . $rid . '" path="' . $path . '" />'
                    .'</urn1:CreateMountpointRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
