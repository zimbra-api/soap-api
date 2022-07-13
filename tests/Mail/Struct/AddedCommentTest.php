<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AddedComment;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddedComment.
 */
class AddedCommentTest extends ZimbraTestCase
{
    public function testAddedComment()
    {
        $parentId = $this->faker->uuid;
        $text = $this->faker->text;

        $comment = new AddedComment($parentId, $text);
        $this->assertSame($parentId, $comment->getParentId());
        $this->assertSame($text, $comment->getText());

        $comment = new AddedComment();
        $comment->setParentId($parentId)
            ->setText($text);
        $this->assertSame($parentId, $comment->getParentId());
        $this->assertSame($text, $comment->getText());

        $xml = <<<EOT
<?xml version="1.0"?>
<result parentId="$parentId" text="$text" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($comment, 'xml'));
        $this->assertEquals($comment, $this->serializer->deserialize($xml, AddedComment::class, 'xml'));
    }
}
