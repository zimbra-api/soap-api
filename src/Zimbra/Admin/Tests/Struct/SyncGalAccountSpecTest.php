<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\SyncGalAccountSpec;
use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Enum\DataSourceBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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

        $ds1 = new SyncGalAccountDataSourceSpec(DataSourceBy::ID()->value(), $value1, true, false);
        $ds2 = new SyncGalAccountDataSourceSpec(DataSourceBy::NAME()->value(), $value2, false, true);

        $sync = new SyncGalAccountSpec($id, [$ds1]);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1], $sync->getDataSources());

        $sync = new SyncGalAccountSpec('', [$ds1]);
        $sync->setId($id)
             ->addDataSource($ds2);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1, $ds2], $sync->getDataSources());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account id="' . $id . '">'
                . '<datasource by="' . DataSourceBy::ID() . '" fullSync="true" reset="false">' . $value1 . '</datasource>'
                . '<datasource by="' . DataSourceBy::NAME() . '" fullSync="false" reset="true">' . $value2 . '</datasource>'
            . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($sync, 'xml'));

        $sync = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\SyncGalAccountSpec', 'xml');
        $ds1 = $sync->getDataSources()[0];
        $ds2 = $sync->getDataSources()[1];

        $this->assertSame($value1, $ds1->getValue());
        $this->assertTrue($ds1->getFullSync());
        $this->assertFalse($ds1->getReset());

        $this->assertSame($value2, $ds2->getValue());
        $this->assertFalse($ds2->getFullSync());
        $this->assertTrue($ds2->getReset());
    }
}
