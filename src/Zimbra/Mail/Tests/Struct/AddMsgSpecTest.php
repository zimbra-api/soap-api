<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\AddMsgSpec;

/**
 * Testcase class for AddMsgSpec.
 */
class AddMsgSpecTest extends ZimbraMailTestCase
{
    public function testAddMsgSpec()
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
        $this->assertSame($content, $m->getContent());
        $this->assertSame($flags, $m->getFlags());
        $this->assertSame($tags, $m->getTags());
        $this->assertSame($tagNames, $m->getTagNames());
        $this->assertSame($folder, $m->getFolder());
        $this->assertTrue($m->getNoICal());
        $this->assertSame($dateReceived, $m->getDateReceived());
        $this->assertSame($attachmentId, $m->getAttachmentId());

        $m->setContent($content)
          ->setFlags($flags)
          ->setTags($tags)
          ->setTagNames($tagNames)
          ->setFolder($folder)
          ->setNoICal(true)
          ->setDateReceived($dateReceived)
          ->setAttachmentId($attachmentId);
        $this->assertSame($content, $m->getContent());
        $this->assertSame($flags, $m->getFlags());
        $this->assertSame($tags, $m->getTags());
        $this->assertSame($tagNames, $m->getTagNames());
        $this->assertSame($folder, $m->getFolder());
        $this->assertTrue($m->getNoICal());
        $this->assertSame($dateReceived, $m->getDateReceived());
        $this->assertSame($attachmentId, $m->getAttachmentId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<m f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" l="' . $folder . '" noICal="true" d="' . $dateReceived . '" aid="' . $attachmentId . '">'
                .'<content>' . $content . '</content>'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
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
        );
        $this->assertEquals($array, $m->toArray());
    }
}
