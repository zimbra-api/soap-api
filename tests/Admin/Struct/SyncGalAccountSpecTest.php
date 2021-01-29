<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\SyncGalAccountSpec;
use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Enum\DataSourceBy;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for SyncGalAccountSpec.
 */
class SyncGalAccountSpecTest extends ZimbraStructTestCase
{
    public function testSyncGalAccountSpec()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $id = $this->faker->uuid;

        $ds1 = new SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), $value1, TRUE, FALSE);
        $ds2 = new SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), $value2, FALSE, TRUE);

        $sync = new SyncGalAccountSpec($id, [$ds1]);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1], $sync->getDataSources());

        $sync = new SyncGalAccountSpec('', [$ds1]);
        $sync->setId($id)
             ->addDataSource($ds2);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1, $ds2], $sync->getDataSources());

        $xml = <<<EOT
<?xml version="1.0"?>
<account id="$id">
    <datasource by="name" fullSync="true" reset="false">$value1</datasource>
    <datasource by="name" fullSync="false" reset="true">$value2</datasource>
</account>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($sync, 'xml'));
        $this->assertEquals($sync, $this->serializer->deserialize($xml, SyncGalAccountSpec::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'datasource' => [
                [
                    'by' => 'name',
                    'fullSync' => TRUE,
                    'reset' => FALSE,
                    '_content' => $value1,
                ],
                [
                    'by' => 'name',
                    'fullSync' => FALSE,
                    'reset' => TRUE,
                    '_content' => $value2,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($sync, 'json'));
        $this->assertEquals($sync, $this->serializer->deserialize($json, SyncGalAccountSpec::class, 'json'));
    }
}
