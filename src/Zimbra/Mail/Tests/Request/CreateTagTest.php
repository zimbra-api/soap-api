<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\CreateTag;
use Zimbra\Mail\Struct\TagSpec;

/**
 * Testcase class for CreateTag.
 */
class CreateTagTest extends ZimbraMailApiTestCase
{
    public function testCreateTagRequest()
    {
        $name = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = mt_rand(1, 127);
        $tag = new TagSpec(
            $name, $rgb, $color
        );

        $req = new \Zimbra\Mail\Request\CreateTag(
            $tag
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($tag, $req->getTag());
        $req->setTag($tag);
        $this->assertSame($tag, $req->getTag());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateTagRequest>'
                .'<tag name="' . $name . '" rgb="' . $rgb . '" color="' . $color . '" />'
            .'</CreateTagRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateTagRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'tag' => array(
	                'name' => $name,
	                'rgb' => $rgb,
	                'color' => $color,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateTagApi()
    {
        $name = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = mt_rand(1, 127);
        $tag = new TagSpec(
            $name, $rgb, $color
        );

        $this->api->createTag(
           $tag
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateTagRequest>'
                        .'<urn1:tag name="' . $name . '" rgb="' . $rgb . '" color="' . $color . '" />'
                    .'</urn1:CreateTagRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
