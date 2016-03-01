<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetComments;
use Zimbra\Mail\Struct\ParentId;

/**
 * Testcase class for GetComments.
 */
class GetCommentsTest extends ZimbraMailApiTestCase
{
    public function testGetCommentsRequest()
    {
        $parentId = $this->faker->uuid;
        $comment = new ParentId(
            $parentId
        );
        $req = new GetComments(
            $comment
        );
        $this->assertSame($comment, $req->getComment());

        $req = new GetComments(
            new ParentId('')
        );
        $req->setComment($comment);
        $this->assertSame($comment, $req->getComment());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCommentsRequest>'
                .'<comment parentId="' . $parentId . '" />'
            .'</GetCommentsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCommentsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'comment' => array(
                    'parentId' => $parentId,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCommentsApi()
    {
        $parentId = $this->faker->uuid;
        $comment = new ParentId(
            $parentId
        );

        $this->api->getComments(
            $comment
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetCommentsRequest>'
                        .'<urn1:comment parentId="' . $parentId . '" />'
                    .'</urn1:GetCommentsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
