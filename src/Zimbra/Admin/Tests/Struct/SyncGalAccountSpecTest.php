<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\SyncGalAccountSpec;
use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Enum\DataSourceBy;

/**
 * Testcase class for SyncGalAccountSpec.
 */
class SyncGalAccountSpecTest extends ZimbraAdminTestCase
{
    public function testSyncGalAccountSpec()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $id = $this->faker->uuid;

        $ds1 = new SyncGalAccountDataSourceSpec(DataSourceBy::ID(), $value1, true, false);
        $ds2 = new SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), $value2, false, true);

        $sync = new SyncGalAccountSpec($id, [$ds1]);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1], $sync->getDataSources()->all());

        $sync->setId($id)
             ->addDataSource($ds2);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1, $ds2], $sync->getDataSources()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account id="' . $id . '">'
                . '<datasource by="' . DataSourceBy::ID() . '" fullSync="true" reset="false">' . $value1 . '</datasource>'
                . '<datasource by="' . DataSourceBy::NAME() . '" fullSync="false" reset="true">' . $value2 . '</datasource>'
            . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $sync);

        $array = [
            'account' => [
                'id' => $id,
                'datasource' => [
                    [
                        'by' => DataSourceBy::ID()->value(),
                        'fullSync' => true,
                        'reset' => false,
                        '_content' => $value1,
                    ],
                    [
                        'by' => DataSourceBy::NAME()->value(),
                        'fullSync' => false,
                        'reset' => true,
                        '_content' => $value2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $sync->toArray());
    }
}
