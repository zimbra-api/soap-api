<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ExportAndDeleteItemSpec;
use Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExportAndDeleteMailboxSpec.
 */
class ExportAndDeleteMailboxSpecTest extends ZimbraTestCase
{
    public function testExportAndDeleteMailboxSpec()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);
        $item1 = new ExportAndDeleteItemSpec($id, $version);
        $item2 = new ExportAndDeleteItemSpec($version, $id);

        $mbox = new StubExportAndDeleteMailboxSpec($id, [$item1]);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$item1], $mbox->getItems());

        $mbox = new StubExportAndDeleteMailboxSpec();
        $mbox->setId($id)
             ->setItems([$item1])
             ->addItem($item2);

        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$item1, $item2], $mbox->getItems());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" xmlns:urn="urn:zimbraAdmin">
    <urn:item id="$id" version="$version" />
    <urn:item id="$version" version="$id" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, StubExportAndDeleteMailboxSpec::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubExportAndDeleteMailboxSpec extends ExportAndDeleteMailboxSpec
{
}
