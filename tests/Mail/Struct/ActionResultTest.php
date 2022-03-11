<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ActionResult;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ActionResult.
 */
class ActionResultTest extends ZimbraTestCase
{
    public function testActionResult()
    {
        $id = $this->faker->uuid;
        $operation = $this->faker->word;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;

        $action = new ActionResult($id, $operation, $nonExistentIds, $newlyCreatedIds);
        $this->assertSame($id, $action->getId());
        $this->assertSame($operation, $action->getOperation());
        $this->assertSame($nonExistentIds, $action->getNonExistentIds());
        $this->assertSame($newlyCreatedIds, $action->getNewlyCreatedIds());

        $action = new ActionResult('', '');
        $action->setId($id)
            ->setOperation($operation)
            ->setNonExistentIds($nonExistentIds)
            ->setNewlyCreatedIds($newlyCreatedIds);
        $this->assertSame($id, $action->getId());
        $this->assertSame($operation, $action->getOperation());
        $this->assertSame($nonExistentIds, $action->getNonExistentIds());
        $this->assertSame($newlyCreatedIds, $action->getNewlyCreatedIds());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, ActionResult::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'op' => $operation,
            'nei' => $nonExistentIds,
            'nci' => $newlyCreatedIds,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, ActionResult::class, 'json'));
    }
}
