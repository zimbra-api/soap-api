<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ServerWithQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\MailQueueWithAction;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Common\Enum\QueueActionBy;
use Zimbra\Common\Enum\QueueAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ServerWithQueueAction.
 */
class ServerWithQueueActionTest extends ZimbraTestCase
{
    public function testServerWithQueueAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $query = new QueueQuery(
            [new QueueQueryField($name, [new ValueAttrib($value)])], $limit, $offset
        );
        $action = new MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new MailQueueWithAction($action, $name);

        $server = new StubServerWithQueueAction($queue, $name);
        $this->assertSame($name, $server->getName());
        $this->assertSame($queue, $server->getQueue());

        $server = new StubServerWithQueueAction(new MailQueueWithAction($action));
        $server->setName($name)
               ->setQueue($queue);
        $this->assertSame($name, $server->getName());
        $this->assertSame($queue, $server->getQueue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:queue name="$name">
        <urn:action op="hold" by="query">
            <urn:query limit="$limit" offset="$offset">
                <urn:field name="$name">
                    <urn:match value="$value" />
                </urn:field>
            </urn:query>
        </urn:action>
    </urn:queue>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, StubServerWithQueueAction::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubServerWithQueueAction extends ServerWithQueueAction
{
}
