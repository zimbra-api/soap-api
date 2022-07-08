<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ListDocumentRevisionsSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ListDocumentRevisionsSpec.
 */
class ListDocumentRevisionsSpecTest extends ZimbraTestCase
{
    public function testListDocumentRevisionsSpec()
    {
        $id = $this->faker->uuid;
        $version = $this->faker->randomNumber;
        $count = $this->faker->randomNumber;

        $spec = new ListDocumentRevisionsSpec(
            $id, $version, $count
        );
        $this->assertSame($id, $spec->getId());
        $this->assertSame($version, $spec->getVersion());
        $this->assertSame($count, $spec->getCount());

        $spec = new ListDocumentRevisionsSpec();
        $spec->setId($id)
            ->setVersion($version)
            ->setCount($count);
        $this->assertSame($id, $spec->getId());
        $this->assertSame($version, $spec->getVersion());
        $this->assertSame($count, $spec->getCount());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" ver="$version" count="$count" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, ListDocumentRevisionsSpec::class, 'xml'));
    }
}
