<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\GetConv;
use Zimbra\Mail\Struct\ConversationSpec;
use Zimbra\Struct\AttributeName;

/**
 * Testcase class for GetConv.
 */
class GetConvTest extends ZimbraMailApiTestCase
{
    public function testGetConvRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $fetch = $this->faker->word;
        $max = mt_rand(1, 100);
        $header = new AttributeName($name);
        $c = new ConversationSpec(
            $id, $fetch, true, $max, true, [$header]
        );

        $req = new GetConv(
            $c
        );
        $this->assertSame($c, $req->getConversation());

        $req->setConversation($c);
        $this->assertSame($c, $req->getConversation());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetConvRequest>'
                .'<c id="' . $id . '" fetch="' . $fetch . '" html="true" max="' . $max . '" needExp="true">'
                    .'<header n="' . $name . '" />'
                .'</c>'
            .'</GetConvRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetConvRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'c' => array(
                    'id' => $id,
                    'fetch' => $fetch,
                    'html' => true,
                    'max' => $max,
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

    public function testGetConvApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $fetch = $this->faker->word;
        $max = mt_rand(1, 100);
        $header = new AttributeName($name);
        $c = new ConversationSpec(
            $id, $fetch, true, $max, true, [$header]
        );

        $this->api->getConv(
            $c
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetConvRequest>'
                        .'<urn1:c id="' . $id . '" fetch="' . $fetch . '" html="true" max="' . $max . '" needExp="true">'
                            .'<urn1:header n="' . $name . '" />'
                        .'</urn1:c>'
                    .'</urn1:GetConvRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
