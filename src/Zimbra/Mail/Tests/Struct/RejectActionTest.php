<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\RejectAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RejectAction.
 */
class RejectActionTest extends ZimbraStructTestCase
{
    public function testRejectAction()
    {
        $index = mt_rand(1, 99);
        $content = $this->faker->word;

        $action = new RejectAction($index, $content);
        $this->assertSame($content, $action->getContent());

        $action = new RejectAction($index);
        $action->setContent($content);
        $this->assertSame($content, $action->getContent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<actionReject index="' . $index . '">'
                . $content
            . '</actionReject>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, RejectAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            '_content' => $content,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, RejectAction::class, 'json'));
    }
}
