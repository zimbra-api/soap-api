<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ErejectAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ErejectAction.
 */
class ErejectActionTest extends ZimbraTestCase
{
    public function testErejectAction()
    {
        $index = mt_rand(1, 99);
        $content = $this->faker->word;

        $action = new ErejectAction($index, $content);
        $this->assertSame($content, $action->getContent());

        $action = new ErejectAction($index);
        $action->setContent($content);
        $this->assertSame($content, $action->getContent());

        $xml = <<<EOT
<?xml version="1.0"?>
<actionEreject index="$index">$content</actionEreject>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, ErejectAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            '_content' => $content,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, ErejectAction::class, 'json'));
    }
}
