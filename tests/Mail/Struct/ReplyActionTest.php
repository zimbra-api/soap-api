<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ReplyAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ReplyAction.
 */
class ReplyActionTest extends ZimbraTestCase
{
    public function testReplyAction()
    {
        $index = mt_rand(1, 99);
        $content = $this->faker->word;

        $action = new ReplyAction($index, $content, FALSE);
        $this->assertSame($content, $action->getContent());

        $action = new ReplyAction($index);
        $action->setContent($content);
        $this->assertSame($content, $action->getContent());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index">
    <content>$content</content>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, ReplyAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'content' => [
                '_content' => $content,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, ReplyAction::class, 'json'));
    }
}
