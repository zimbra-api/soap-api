<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Common\Enum\QueueAction;
use Zimbra\Common\Enum\QueueActionBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailQueueAction.
 */
class MailQueueActionTest extends ZimbraTestCase
{
    public function testMailQueueAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);
        $action = new StubMailQueueAction($query, QueueAction::REQUEUE(), QueueActionBy::ID());

        $this->assertSame($query, $action->getQuery());
        $this->assertEquals(QueueAction::REQUEUE(), $action->getOp());
        $this->assertEquals(QueueActionBy::ID(), $action->getBy());

        $action = new StubMailQueueAction(new QueueQuery());
        $action->setQuery($query)
               ->setOp(QueueAction::HOLD())
               ->setBy(QueueActionBy::QUERY());

        $this->assertSame($query, $action->getQuery());
        $this->assertEquals(QueueAction::HOLD(), $action->getOp());
        $this->assertEquals(QueueActionBy::QUERY(), $action->getBy());

        $op = QueueAction::HOLD()->getValue();
        $by = QueueActionBy::QUERY()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result op="$op" by="$by" xmlns:urn="urn:zimbraAdmin">
    <urn:query limit="$limit" offset="$offset">
        <urn:field name="$name">
            <urn:match value="$value" />
        </urn:field>
    </urn:query>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubMailQueueAction::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubMailQueueAction extends MailQueueAction
{
}
