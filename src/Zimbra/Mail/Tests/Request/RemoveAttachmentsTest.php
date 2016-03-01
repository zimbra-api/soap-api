<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\RemoveAttachments;
use Zimbra\Mail\Struct\MsgPartIds;

/**
 * Testcase class for RemoveAttachments.
 */
class RemoveAttachmentsTest extends ZimbraMailApiTestCase
{
    public function testRemoveAttachmentsRequest()
    {
        $id = $this->faker->uuid;
        $part = $this->faker->word;
        $m = new MsgPartIds(
            $id, $part
        );

        $req = new RemoveAttachments(
            $m
        );
        $this->assertSame($m, $req->getMsg());

        $req = new RemoveAttachments(
            new MsgPartIds('', '')
        );
        $req->setMsg($m);
        $this->assertSame($m, $req->getMsg());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RemoveAttachmentsRequest>'
                .'<m id="' . $id . '" part="' . $part . '" />'
            .'</RemoveAttachmentsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RemoveAttachmentsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'm' => array(
                    'id' => $id,
                    'part' => $part,
                )
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveAttachmentsApi()
    {
        $id = $this->faker->uuid;
        $part = $this->faker->word;
        $m = new MsgPartIds(
            $id, $part
        );
        $this->api->removeAttachments(
            $m
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:RemoveAttachmentsRequest>'
                        .'<urn1:m id="' . $id . '" part="' . $part . '" />'
                    .'</urn1:RemoveAttachmentsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
