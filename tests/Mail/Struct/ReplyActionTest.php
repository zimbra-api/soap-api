<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $action = new StubReplyAction($index, $content, FALSE);
        $this->assertSame($content, $action->getContent());

        $action = new StubReplyAction($index);
        $action->setContent($content);
        $this->assertSame($content, $action->getContent());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" xmlns:urn="urn:zimbraMail">
    <urn:content>$content</urn:content>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubReplyAction::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubReplyAction extends ReplyAction
{
}
