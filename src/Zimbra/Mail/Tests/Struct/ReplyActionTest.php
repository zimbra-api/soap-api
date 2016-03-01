<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ReplyAction;

/**
 * Testcase class for ReplyAction.
 */
class ReplyActionTest extends ZimbraMailTestCase
{
    public function testReplyAction()
    {
        $index = mt_rand(1, 10);
        $content = $this->faker->word;

        $action = new ReplyAction(
            $index, $content
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $action);
        $this->assertSame($content, $action->getContent());

        $action = new ReplyAction(
            $index
        );
        $action->setContent($content);
        $this->assertSame($content, $action->getContent());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionReply index="' . $index . '">'
                .'<content>' . $content . '</content>'
            .'</actionReply>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'actionReply' => array(
                'index' => $index,
                'content' => $content,
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }
}
