<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\ContactAttachSpec;
use Zimbra\Mail\Struct\DocAttachSpec;
use Zimbra\Mail\Struct\MimePartAttachSpec;
use Zimbra\Mail\Struct\MsgAttachSpec;

/**
 * Testcase class for AttachmentsInfo.
 */
class AttachmentsInfoTest extends ZimbraMailTestCase
{
    public function testAttachmentsInfo()
    {
        $id = $this->faker->word;
        $aid = $this->faker->word;
        $mid = $this->faker->word;
        $part = $this->faker->word;
        $path = $this->faker->word;
        $ver = mt_rand(0, 10);

        $mp = new MimePartAttachSpec($mid, $part, true);
        $m = new MsgAttachSpec($id, false);
        $cn = new ContactAttachSpec($id, false);
        $doc = new DocAttachSpec($path, $id, $ver, true);
        $attach = new AttachmentsInfo($aid, [$mp, $m, $cn, $doc]);
        $this->assertSame($aid, $attach->getAttachmentId());
        $this->assertSame([$mp, $m, $cn, $doc], $attach->getAttachments()->all());

        $attach->setAttachmentId($aid)
            ->setAttachments([$mp, $m, $cn]);
        $this->assertSame($aid, $attach->getAttachmentId());
        $this->assertSame([$mp, $m, $cn], $attach->getAttachments()->all());
        $attach->addAttachment($doc);
        $this->assertSame([$mp, $m, $cn, $doc], $attach->getAttachments()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<attach aid="' . $aid . '">'
                .'<mp mid="' . $mid . '" part="' . $part . '" optional="true" />'
                .'<m id="' . $id . '" optional="false" />'
                .'<cn id="' . $id . '" optional="false" />'
                .'<doc path="' . $path . '" id="' . $id . '" ver="' . $ver . '" optional="true" />'
            .'</attach>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attach);

        $array = array(
            'attach' => array(
                'aid' => $aid,
                'mp' => array(
                    'mid' => $mid,
                    'part' => $part,
                    'optional' => true,
                ),
                'm' => array(
                    'id' => $id,
                    'optional' => false,
                ),
                'cn' => array(
                    'id' => $id,
                    'optional' => false,
                ),
                'doc' => array(
                    'path' => $path,
                    'id' => $id,
                    'ver' => $ver,
                    'optional' => true,
                ),
            ),
        );
        $this->assertEquals($array, $attach->toArray());
    }
}
