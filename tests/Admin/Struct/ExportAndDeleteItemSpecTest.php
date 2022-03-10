<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ExportAndDeleteItemSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExportAndDeleteItemSpec.
 */
class ExportAndDeleteItemSpecTest extends ZimbraTestCase
{
    public function testExportAndDeleteItemSpec()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);

        $item = new ExportAndDeleteItemSpec($id, $version);
        $this->assertSame($id, $item->getId());
        $this->assertSame($version, $item->getVersion());

        $item = new ExportAndDeleteItemSpec(0, 0);
        $item->setId($id)
             ->setVersion($version);
        $this->assertSame($id, $item->getId());
        $this->assertSame($version, $item->getVersion());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" version="$version" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, ExportAndDeleteItemSpec::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'version' => $version,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($item, 'json'));
        $this->assertEquals($item, $this->serializer->deserialize($json, ExportAndDeleteItemSpec::class, 'json'));
    }
}
