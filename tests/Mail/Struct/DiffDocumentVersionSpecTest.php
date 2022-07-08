<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DiffDocumentVersionSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DiffDocumentVersionSpec.
 */
class DiffDocumentVersionSpecTest extends ZimbraTestCase
{
    public function testDiffDocumentVersionSpec()
    {
        $id = $this->faker->uuid;
        $version1 = $this->faker->randomNumber;
        $version2 = $this->faker->randomNumber;

        $doc = new DiffDocumentVersionSpec(
            $id, $version1, $version2
        );
        $this->assertSame($id, $doc->getId());
        $this->assertSame($version1, $doc->getVersion1());
        $this->assertSame($version2, $doc->getVersion2());

        $doc = new DiffDocumentVersionSpec();
        $doc->setId($id)
            ->setVersion1($version1)
            ->setVersion2($version2);
        $this->assertSame($id, $doc->getId());
        $this->assertSame($version1, $doc->getVersion1());
        $this->assertSame($version2, $doc->getVersion2());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" v1="$version1" v2="$version2" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($doc, 'xml'));
        $this->assertEquals($doc, $this->serializer->deserialize($xml, DiffDocumentVersionSpec::class, 'xml'));
    }
}
