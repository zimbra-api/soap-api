<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MimePartInfo;

use Zimbra\Mail\Struct\MimePartAttachSpec;
use Zimbra\Mail\Struct\MsgAttachSpec;
use Zimbra\Mail\Struct\ContactAttachSpec;
use Zimbra\Mail\Struct\DocAttachSpec;
use Zimbra\Mail\Struct\AttachmentsInfo;

/**
 * Testcase class for MimePartInfo.
 */
class MimePartInfoTest extends ZimbraMailTestCase
{
    public function testMimePartInfo()
    {
        $mid = $this->faker->uuid;
        $part = $this->faker->word;
        $id = $this->faker->uuid;
        $path = $this->faker->word;
        $aid = $this->faker->uuid;
        $ct = $this->faker->word;
        $content = $this->faker->word;
        $ci = $this->faker->uuid;
        $ver = mt_rand(1, 10);

        $mp = new MimePartAttachSpec($mid, $part, true);
        $m = new MsgAttachSpec($id, false);
        $cn = new ContactAttachSpec($id, false);
        $doc = new DocAttachSpec($path, $id, $ver, true);
        $attach = new AttachmentsInfo($aid, [$mp, $m, $cn, $doc]);

        $info = new MimePartInfo(null, $ct, $content, $ci);

        $mpi = new MimePartInfo($attach, $ct, $content, $ci, [$info]);
        $this->assertSame([$info], $mpi->getMimeParts()->all());
        $this->assertSame($attach, $mpi->getAttachments());
        $this->assertSame($ct, $mpi->getContentType());
        $this->assertSame($content, $mpi->getContent());
        $this->assertSame($ci, $mpi->getContentId());

        $mpi->addMimePart($info)
            ->setAttachments($attach)
            ->setContentType($ct)
            ->setContent($content)
            ->setContentId($ci);
        $this->assertSame([$info, $info], $mpi->getMimeParts()->all());
        $this->assertSame($attach, $mpi->getAttachments());
        $this->assertSame($ct, $mpi->getContentType());
        $this->assertSame($content, $mpi->getContent());
        $this->assertSame($ci, $mpi->getContentId());

        $mpi = new MimePartInfo($attach, $ct, $content, $ci, [$info]);
        $xml = '<?xml version="1.0"?>' . "\n"
            .'<mp ct="' . $ct . '" content="' . $content . '" ci="' . $ci . '">'
                .'<attach aid="' . $aid . '">'
                    .'<mp optional="true" mid="' . $mid . '" part="' . $part . '" />'
                    .'<m optional="false" id="' . $id . '" />'
                    .'<cn optional="false" id="' . $id . '" />'
                    .'<doc optional="true" path="' . $path . '" id="' . $id . '" ver="' . $ver . '" />'
                .'</attach>'
                .'<mp ct="' . $ct . '" content="' . $content . '" ci="' . $ci . '" />'
            .'</mp>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mpi);

        $array = array(
            'mp' => array(
                'ct' => $ct,
                'content' => $content,
                'ci' => $ci,
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
                'mp' => array(
                    array(
                        'ct' => $ct,
                        'content' => $content,
                        'ci' => $ci,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $mpi->toArray());
    }
}
