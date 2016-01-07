<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\AddedComment;

/**
 * Testcase class for AddedComment.
 */
class AddedCommentTest extends ZimbraMailTestCase
{
    public function testAddedComment()
    {
        $parentId = $this->faker->word;
        $text = $this->faker->word;

        $comment = new AddedComment($parentId, $text);
        $this->assertSame($parentId, $comment->getParentId());
        $this->assertSame($text, $comment->getText());

        $comment->setParentId($parentId)
                ->setText($text);
        $this->assertSame($parentId, $comment->getParentId());
        $this->assertSame($text, $comment->getText());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<comment parentId="' . $parentId . '" text="' . $text . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comment);

        $array = array(
            'comment' => array(
                'parentId' => $parentId,
                'text' => $text,
            ),
        );
        $this->assertEquals($array, $comment->toArray());
    }
}
