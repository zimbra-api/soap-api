<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\TagAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TagAction.
 */
class TagActionTest extends ZimbraStructTestCase
{
    public function testTagAction()
    {
        $index = $this->faker->numberBetween(1, 99);
        $tag = $this->faker->word;

        $action = new TagAction($index, $tag, FALSE);
        $this->assertSame($tag, $action->getTag());

        $action = new TagAction($index);
        $action->setTag($tag);
        $this->assertSame($tag, $action->getTag());

        $xml = <<<EOT
<?xml version="1.0"?>
<actionTag index="$index" tagName="$tag" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, TagAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'tagName' => $tag,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, TagAction::class, 'json'));
    }
}
