<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Enum\DataSourceBy;

/**
 * Testcase class for SyncGalAccountDataSourceSpec.
 */
class SyncGalAccountDataSourceSpecTest extends ZimbraAdminTestCase
{
    public function testSyncGalAccountDataSourceSpec()
    {
        $value = $this->faker->word;

        $ds = new SyncGalAccountDataSourceSpec(DataSourceBy::ID(), $value, false, true);
        $this->assertSame('id', $ds->getBy()->value());
        $this->assertSame($value, $ds->getValue());
        $this->assertFalse($ds->getFullSync());
        $this->assertTrue($ds->getReset());

        $ds->setBy(DataSourceBy::NAME())
           ->setFullSync(true)
           ->setReset(false);
        $this->assertSame('name', $ds->getBy()->value());
        $this->assertTrue($ds->getFullSync());
        $this->assertFalse($ds->getReset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<datasource by="' . DataSourceBy::NAME() . '" fullSync="true" reset="false">' . $value . '</datasource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ds);

        $array = [
            'datasource' => [
                'by' => DataSourceBy::NAME()->value(),
                'fullSync' => true,
                'reset' => false,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $ds->toArray());
    }
}
