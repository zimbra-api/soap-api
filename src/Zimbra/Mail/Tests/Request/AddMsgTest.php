<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\AddMsg;
use Zimbra\Mail\Struct\AddMsgSpec;

/**
 * Testcase class for AddMsg.
 */
class AddMsgTest extends ZimbraMailApiTestCase
{
    public function testAddMsgRequest()
    {
        $content = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $folder = $this->faker->word;
        $dateReceived = mt_rand(1, 100);
        $attachmentId = $this->faker->uuid;
        $m = new AddMsgSpec(
            $content, $flags, $tags, $tagNames, $folder, true, $dateReceived, $attachmentId
        );

        $req = new AddMsg(
            $m, false
        );
        $this->assertSame($m, $req->getMsg());
        $this->assertFalse($req->getFilterSent());

        $req->setMsg($m)
            ->setFilterSent(true);
        $this->assertSame($m, $req->getMsg());
        $this->assertTrue($req->getFilterSent());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddMsgRequest filterSent="true">'
                .'<m f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" l="' . $folder . '" noICal="true" d="' . $dateReceived . '" aid="' . $attachmentId . '">'
                    .'<content>' . $content . '</content>'
                .'</m>'
            .'</AddMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddMsgRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'filterSent' => true,
                'm' => array(
                    'content' => $content,
                    'f' => $flags,
                    't' => $tags,
                    'tn' => $tagNames,
                    'l' => $folder,
                    'noICal' => true,
                    'd' => $dateReceived,
                    'aid' => $attachmentId,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddMsgApi()
    {
        $content = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $folder = $this->faker->word;
        $dateReceived = mt_rand(1, 100);
        $attachmentId = $this->faker->uuid;
        $m = new AddMsgSpec(
            $content, $flags, $tags, $tagNames, $folder, true, $dateReceived, $attachmentId
        );

        $this->api->addMsg(
            $m, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AddMsgRequest filterSent="true">'
                        .'<urn1:m f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" l="' . $folder . '" noICal="true" d="' . $dateReceived . '" aid="' . $attachmentId . '">'
                            .'<urn1:content>' . $content . '</urn1:content>'
                        .'</urn1:m>'
                    .'</urn1:AddMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
