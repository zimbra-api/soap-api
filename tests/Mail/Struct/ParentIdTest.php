<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ParentId;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ParentId.
 */
class ParentIdTest extends ZimbraTestCase
{
    public function testParentId()
    {
        $id = $this->faker->uuid;

        $parentId = new ParentId($id);
        $this->assertSame($id, $parentId->getParentId());

        $parentId = new ParentId('');
        $parentId->setParentId($id);
        $this->assertSame($id, $parentId->getParentId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result parentId="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($parentId, 'xml'));
        $this->assertEquals($parentId, $this->serializer->deserialize($xml, ParentId::class, 'xml'));
    }
}
