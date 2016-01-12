<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\AddComment;
use Zimbra\Mail\Struct\AddedComment;

/**
 * Testcase class for AddComment.
 */
class AddCommentTest extends ZimbraMailApiTestCase
{
    public function testAddCommentRequest()
    {
        $parentId = $this->faker->word;
        $text = $this->faker->word;
        $comment = new AddedComment($parentId, $text);
        $req = new AddComment(
            $comment
        );
        $this->assertSame($comment, $req->getComment());

        $req->setComment($comment);
        $this->assertSame($comment, $req->getComment());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddCommentRequest>'
                .'<comment parentId="' . $parentId . '" text="' . $text . '" />'
            .'</AddCommentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddCommentRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'comment' => array(
                    'parentId' => $parentId,
                    'text' => $text,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddCommentApi()
    {
        $parentId = $this->faker->word;
        $text = $this->faker->word;
        $comment = new AddedComment($parentId, $text);
        $this->api->addComment(
            $comment
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AddCommentRequest>'
                        .'<urn1:comment parentId="' . $parentId . '" text="' . $text . '" />'
                    .'</urn1:AddCommentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
