<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FolderActionResult;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FolderActionResult.
 */
class FolderActionResultTest extends ZimbraTestCase
{
    public function testFolderActionResult()
    {
        $id = $this->faker->uuid;
        $operation = $this->faker->word;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->text;

        $action = new FolderActionResult(
            $id, $operation, $nonExistentIds, $newlyCreatedIds, $zimbraId, $displayName, $accessKey
        );
        $this->assertSame($zimbraId, $action->getZimbraId());
        $this->assertSame($displayName, $action->getDisplayName());
        $this->assertSame($accessKey, $action->getAccessKey());

        $action = new FolderActionResult($id, $operation, $nonExistentIds, $newlyCreatedIds);
        $action->setZimbraId($zimbraId)
            ->setDisplayName($displayName)
            ->setAccessKey($accessKey);
        $this->assertSame($zimbraId, $action->getZimbraId());
        $this->assertSame($displayName, $action->getDisplayName());
        $this->assertSame($accessKey, $action->getAccessKey());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" zid="$zimbraId" d="$displayName" key="$accessKey" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, FolderActionResult::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'op' => $operation,
            'nei' => $nonExistentIds,
            'nci' => $newlyCreatedIds,
            'zid' => $zimbraId,
            'd' => $displayName,
            'key' => $accessKey,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, FolderActionResult::class, 'json'));
    }
}
