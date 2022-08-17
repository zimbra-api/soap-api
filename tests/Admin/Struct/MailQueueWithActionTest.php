<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\MailQueueWithAction;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Common\Enum\QueueAction;
use Zimbra\Common\Enum\QueueActionBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailQueueWithAction.
 */
class MailQueueWithActionTest extends ZimbraTestCase
{
    public function testMailQueueWithAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);
        $action = new MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());

        $queue = new StubMailQueueWithAction($action, $name);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($action, $queue->getAction());

        $queue = new StubMailQueueWithAction(new MailQueueAction($query));
        $queue->setAction($action)
              ->setName($name);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($action, $queue->getAction());

        $op = QueueAction::HOLD()->getValue();
        $by = QueueActionBy::QUERY()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:action op="$op" by="$by">
        <urn:query limit="$limit" offset="$offset">
            <urn:field name="$name">
                <urn:match value="$value" />
            </urn:field>
        </urn:query>
    </urn:action>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($queue, 'xml'));
        $this->assertEquals($queue, $this->serializer->deserialize($xml, StubMailQueueWithAction::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubMailQueueWithAction extends MailQueueWithAction
{
}
