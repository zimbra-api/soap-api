<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\TagAction;

/**
 * Testcase class for TagAction.
 */
class TagActionTest extends ZimbraMailTestCase
{
    public function testTagAction()
    {
        $index = mt_rand(1, 10);
        $tagName = $this->faker->word;
        $actionTag = new TagAction(
            $index, $tagName
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionTag);
        $this->assertSame($tagName, $actionTag->getTag());

        $actionTag = new TagAction(
            $index
        );
        $actionTag->setTag($tagName);
        $this->assertSame($tagName, $actionTag->getTag());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionTag index="' . $index . '" tagName="' . $tagName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionTag);

        $array = array(
            'actionTag' => array(
                'index' => $index,
                'tagName' => $tagName,
            ),
        );
        $this->assertEquals($array, $actionTag->toArray());
    }
}
