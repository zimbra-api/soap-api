<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\BulkOperation;
use Zimbra\Mail\Struct\BulkAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BulkAction.
 */
class BulkActionTest extends ZimbraTestCase
{
    public function testBulkAction()
    {
        $op = BulkOperation::MOVE;
        $folder = $this->faker->uuid;

        $action = new BulkAction(
            $op, $folder
        );
        $this->assertSame($op, $action->getOp());
        $this->assertSame($folder, $action->getFolder());

        $action = new BulkAction();
        $action->setOp($op)
            ->setFolder($folder);
        $this->assertSame($op, $action->getOp());
        $this->assertSame($folder, $action->getFolder());

        $xml = <<<EOT
<?xml version="1.0"?>
<result op="move" l="$folder" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, BulkAction::class, 'xml'));
    }
}
