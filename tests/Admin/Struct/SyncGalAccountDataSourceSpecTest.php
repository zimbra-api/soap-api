<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Common\Enum\DataSourceBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SyncGalAccountDataSourceSpec.
 */
class SyncGalAccountDataSourceSpecTest extends ZimbraTestCase
{
    public function testSyncGalAccountDataSourceSpec()
    {
        $value = $this->faker->word;

        $ds = new SyncGalAccountDataSourceSpec(DataSourceBy::ID, $value, FALSE, TRUE);
        $this->assertEquals(DataSourceBy::ID, $ds->getBy());
        $this->assertSame($value, $ds->getValue());
        $this->assertFalse($ds->getFullSync());
        $this->assertTrue($ds->getReset());

        $ds = new SyncGalAccountDataSourceSpec();
        $ds->setBy(DataSourceBy::NAME)
           ->setValue($value)
           ->setFullSync(TRUE)
           ->setReset(FALSE);
        $this->assertEquals(DataSourceBy::NAME, $ds->getBy());
        $this->assertSame($value, $ds->getValue());
        $this->assertTrue($ds->getFullSync());
        $this->assertFalse($ds->getReset());

        $xml = <<<EOT
<?xml version="1.0"?>
<result by="name" fullSync="true" reset="false">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ds, 'xml'));
        $this->assertEquals($ds, $this->serializer->deserialize($xml, SyncGalAccountDataSourceSpec::class, 'xml'));
    }
}
