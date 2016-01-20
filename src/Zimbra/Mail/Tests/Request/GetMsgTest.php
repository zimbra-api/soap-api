<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetMsg;
use Zimbra\Mail\Struct\MsgSpec;
use Zimbra\Struct\AttributeName;

/**
 * Testcase class for GetMsg.
 */
class GetMsgTest extends ZimbraMailApiTestCase
{
    public function testGetMsgRequest()
    {
        $id = $this->faker->word;
        $part = $this->faker->word;
        $ridZ = $this->faker->iso8601;
        $name = $this->faker->word;
        $max = mt_rand(1, 10);
        $header = new AttributeName($name);
        $m = new MsgSpec(
            $id, $part, true, true, $max, true, true, $ridZ, true, [$header]
        );

        $req = new GetMsg(
            $m
        );
        $this->assertSame($m, $req->getMsg());
        $req->setMsg($m);
        $this->assertSame($m, $req->getMsg());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMsgRequest>'
                .'<m id="' . $id . '" part="' . $part . '" raw="true" read="true" max="' . $max . '" html="true" neuter="true" ridZ="' . $ridZ . '" needExp="true">'
                    .'<header n="' . $name . '" />'
                .'</m>'
            .'</GetMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMsgRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'm' => array(
                    'id' => $id,
                    'part' => $part,
                    'raw' => true,
                    'read' => true,
                    'max' => $max,
                    'html' => true,
                    'neuter' => true,
                    'ridZ' => $ridZ,
                    'needExp' => true,
                    'header' => array(
                        array(
                            'n' => $name,
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMsgApi()
    {
        $id = $this->faker->word;
        $part = $this->faker->word;
        $ridZ = $this->faker->iso8601;
        $name = $this->faker->word;
        $max = mt_rand(1, 10);
        $header = new AttributeName($name);
        $m = new MsgSpec(
            $id, $part, true, true, $max, true, true, $ridZ, true, [$header]
        );
        $this->api->getMsg(
            $m
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetMsgRequest>'
                        .'<urn1:m id="' . $id . '" part="' . $part . '" raw="true" read="true" max="' . $max . '" html="true" neuter="true" ridZ="' . $ridZ . '" needExp="true">'
                            .'<urn1:header n="' . $name . '" />'
                        .'</urn1:m>'
                    .'</urn1:GetMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
