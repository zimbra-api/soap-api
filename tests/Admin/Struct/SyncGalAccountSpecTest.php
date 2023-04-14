<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\SyncGalAccountSpec;
use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Common\Enum\DataSourceBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SyncGalAccountSpec.
 */
class SyncGalAccountSpecTest extends ZimbraTestCase
{
    public function testSyncGalAccountSpec()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $id = $this->faker->uuid;

        $ds1 = new SyncGalAccountDataSourceSpec(DataSourceBy::NAME, $value1, TRUE, FALSE);
        $ds2 = new SyncGalAccountDataSourceSpec(DataSourceBy::NAME, $value2, FALSE, TRUE);

        $sync = new StubSyncGalAccountSpec($id, [$ds1]);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1], $sync->getDataSources());

        $sync = new StubSyncGalAccountSpec();
        $sync->setId($id)
             ->setDataSources([$ds1])
             ->addDataSource($ds2);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1, $ds2], $sync->getDataSources());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" xmlns:urn="urn:zimbraAdmin">
    <urn:datasource by="name" fullSync="true" reset="false">$value1</urn:datasource>
    <urn:datasource by="name" fullSync="false" reset="true">$value2</urn:datasource>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($sync, 'xml'));
        $this->assertEquals($sync, $this->serializer->deserialize($xml, StubSyncGalAccountSpec::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubSyncGalAccountSpec extends SyncGalAccountSpec
{
}
