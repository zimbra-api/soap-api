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

        $result = new FolderActionResult(
            $id, $operation, $nonExistentIds, $newlyCreatedIds, $zimbraId, $displayName, $accessKey
        );
        $this->assertSame($zimbraId, $result->getZimbraId());
        $this->assertSame($displayName, $result->getDisplayName());
        $this->assertSame($accessKey, $result->getAccessKey());

        $result = new FolderActionResult($id, $operation, $nonExistentIds, $newlyCreatedIds);
        $result->setZimbraId($zimbraId)
            ->setDisplayName($displayName)
            ->setAccessKey($accessKey);
        $this->assertSame($zimbraId, $result->getZimbraId());
        $this->assertSame($displayName, $result->getDisplayName());
        $this->assertSame($accessKey, $result->getAccessKey());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" zid="$zimbraId" d="$displayName" key="$accessKey" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($result, 'xml'));
        $this->assertEquals($result, $this->serializer->deserialize($xml, FolderActionResult::class, 'xml'));
    }
}
