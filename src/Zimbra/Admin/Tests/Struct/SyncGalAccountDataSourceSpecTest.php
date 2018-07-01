<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Enum\DataSourceBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SyncGalAccountDataSourceSpec.
 */
class SyncGalAccountDataSourceSpecTest extends ZimbraStructTestCase
{
    public function testSyncGalAccountDataSourceSpec()
    {
        $value = $this->faker->word;

        $ds = new SyncGalAccountDataSourceSpec(DataSourceBy::ID()->value(), $value, false, true);
        $this->assertSame(DataSourceBy::ID()->value(), $ds->getBy());
        $this->assertSame($value, $ds->getValue());
        $this->assertFalse($ds->getFullSync());
        $this->assertTrue($ds->getReset());

        $ds = new SyncGalAccountDataSourceSpec(DataSourceBy::ID()->value(), '', false, true);
        $ds->setBy(DataSourceBy::NAME()->value())
           ->setValue($value)
           ->setFullSync(true)
           ->setReset(false);
        $this->assertSame(DataSourceBy::NAME()->value(), $ds->getBy());
        $this->assertSame($value, $ds->getValue());
        $this->assertTrue($ds->getFullSync());
        $this->assertFalse($ds->getReset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<datasource by="' . DataSourceBy::NAME() . '" fullSync="true" reset="false">' . $value . '</datasource>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ds, 'xml'));

        $ds = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec', 'xml');
        $this->assertSame(DataSourceBy::NAME()->value(), $ds->getBy());
        $this->assertSame($value, $ds->getValue());
        $this->assertTrue($ds->getFullSync());
        $this->assertFalse($ds->getReset());
    }
}
