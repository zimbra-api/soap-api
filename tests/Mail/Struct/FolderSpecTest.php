<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FolderSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FolderSpec.
 */
class FolderSpecTest extends ZimbraTestCase
{
    public function testFolderSpec()
    {
        $folder = $this->faker->uuid;

        $spec = new FolderSpec($folder);
        $this->assertSame($folder, $spec->getFolder());
        $spec = new FolderSpec('');
        $spec->setFolder($folder);

        $this->assertSame($folder, $spec->getFolder());

        $xml = <<<EOT
<?xml version="1.0"?>
<result l="$folder" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, FolderSpec::class, 'xml'));
    }
}
