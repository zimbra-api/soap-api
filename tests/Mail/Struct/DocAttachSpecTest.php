<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DocAttachSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DocAttachSpec.
 */
class DocAttachSpecTest extends ZimbraTestCase
{
    public function testDocAttachSpec()
    {
        $id = $this->faker->uuid;
        $path = $this->faker->word;
        $version = mt_rand(1, 100);

        $spec = new DocAttachSpec($path, $id, $version);
        $this->assertSame($id, $spec->getId());
        $this->assertSame($path, $spec->getPath());
        $this->assertSame($version, $spec->getVersion());

        $spec = new DocAttachSpec();
        $spec->setId($id)
            ->setPath($path)
            ->setVersion($version)
            ->setOptional(TRUE);
        $this->assertSame($id, $spec->getId());
        $this->assertSame($path, $spec->getPath());
        $this->assertSame($version, $spec->getVersion());

        $xml = <<<EOT
<?xml version="1.0"?>
<result path="$path" id="$id" ver="$version" optional="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, DocAttachSpec::class, 'xml'));
    }
}
