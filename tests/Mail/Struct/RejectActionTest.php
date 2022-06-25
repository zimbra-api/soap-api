<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RejectAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RejectAction.
 */
class RejectActionTest extends ZimbraTestCase
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index">$content</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, RejectAction::class, 'xml'));
    }
}
