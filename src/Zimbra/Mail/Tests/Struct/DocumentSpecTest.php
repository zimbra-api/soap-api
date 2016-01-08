<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DocumentSpec;
use Zimbra\Mail\Struct\MessagePartSpec;
use Zimbra\Mail\Struct\IdVersion;
use Zimbra\Struct\Id;

/**
 * Testcase class for DocumentSpec.
 */
class DocumentSpecTest extends ZimbraMailTestCase
{
    public function testDocumentSpec()
    {
        $id = $this->faker->word;
        $part = $this->faker->word;
        $ver = mt_rand(1, 100);

        $upload = new Id($id);
        $m = new MessagePartSpec(
            $id, $part
        );
        $docVer = new IdVersion(
            $id, $ver
        );

        $name = $this->faker->word;
        $ct = $this->faker->word;
        $desc = $this->faker->word;
        $folder = $this->faker->word;
        $content = $this->faker->word;
        $flags = $this->faker->word;

        $doc = new DocumentSpec(
            $name, $ct, $desc, $folder, $id, $ver, $content, true, $flags, $upload, $m, $docVer
        );
        $this->assertSame($upload, $doc->getUpload());
        $this->assertSame($m, $doc->getMessagePart());
        $this->assertSame($docVer, $doc->getDocRevision());
        $this->assertSame($name, $doc->getName());
        $this->assertSame($ct, $doc->getContentType());
        $this->assertSame($desc, $doc->getDescription());
        $this->assertSame($folder, $doc->getFolderId());
        $this->assertSame($id, $doc->getId());
        $this->assertSame($ver, $doc->getVersion());
        $this->assertSame($content, $doc->getContent());
        $this->assertTrue($doc->getDescEnabled());
        $this->assertSame($flags, $doc->getFlags());

        $doc->setUpload($upload)
            ->setMessagePart($m)
            ->setDocRevision($docVer)
            ->setName($name)
            ->setContentType($ct)
            ->setDescription($desc)
            ->setFolderId($folder)
            ->setId($id)
            ->setVersion($ver)
            ->setContent($content)
            ->setDescEnabled(true)
            ->setFlags($flags);
        $this->assertSame($upload, $doc->getUpload());
        $this->assertSame($m, $doc->getMessagePart());
        $this->assertSame($docVer, $doc->getDocRevision());
        $this->assertSame($name, $doc->getName());
        $this->assertSame($ct, $doc->getContentType());
        $this->assertSame($desc, $doc->getDescription());
        $this->assertSame($folder, $doc->getFolderId());
        $this->assertSame($id, $doc->getId());
        $this->assertSame($ver, $doc->getVersion());
        $this->assertSame($content, $doc->getContent());
        $this->assertTrue($doc->getDescEnabled());
        $this->assertSame($flags, $doc->getFlags());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<doc name="' . $name . '" ct="' . $ct . '" desc="' . $desc . '" l="' . $folder . '" id="' . $id . '" ver="' . $ver . '" content="' . $content . '" descEnabled="true" f="' . $flags . '">'
                .'<upload id="' . $id . '" />'
                .'<m id="' . $id . '" part="' . $part . '" />'
                .'<doc id="' . $id . '" ver="' . $ver . '" />'
            .'</doc>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'name' => $name,
                'ct' => $ct,
                'desc' => $desc,
                'l' => $folder,
                'id' => $id,
                'ver' => $ver,
                'content' => $content,
                'descEnabled' => true,
                'f' => $flags,
                'upload' => array(
                    'id' => $id,
                ),
                'm' => array(
                    'id' => $id,
                    'part' => $part,
                ),
                'doc' => array(
                    'id' => $id,
                    'ver' => $ver,
                ),
            )
        );
        $this->assertEquals($array, $doc->toArray());
    }
}
