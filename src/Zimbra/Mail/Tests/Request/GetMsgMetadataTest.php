<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetMsgMetadata;
use Zimbra\Mail\Struct\IdsAttr;

/**
 * Testcase class for GetMsgMetadata.
 */
class GetMsgMetadataTest extends ZimbraMailApiTestCase
{
    public function testGetMsgMetadataRequest()
    {
        $ids = $this->faker->word;
        $m = new IdsAttr(
            $ids
        );
        $req = new GetMsgMetadata(
            $m
        );
        $this->assertSame($m, $req->getMsgIds());
        $req->setMsgIds($m);
        $this->assertSame($m, $req->getMsgIds());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMsgMetadataRequest>'
                .'<m ids="' . $ids . '" />'
            .'</GetMsgMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMsgMetadataRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'm' => array(
                    'ids' => $ids,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMsgMetadataApi()
    {
        $ids = $this->faker->word;
        $m = new IdsAttr(
            $ids
        );
        $this->api->getMsgMetadata(
            $m
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetMsgMetadataRequest>'
                        .'<urn1:m ids="' . $ids . '" />'
                    .'</urn1:GetMsgMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
