<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DataSourceUsage;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DataSourceUsage.
 */
class DataSourceUsageTest extends ZimbraTestCase
{
    public function testDataSourceUsage()
    {
        $id = $this->faker->uuid;
        $usage = $this->faker->randomNumber;

        $dsUsage = new DataSourceUsage(
            $id, $usage
        );
        $this->assertSame($id, $dsUsage->getId());
        $this->assertSame($usage, $dsUsage->getUsage());

        $dsUsage = new DataSourceUsage('', 0);
        $dsUsage->setId($id)
            ->setUsage($usage);
        $this->assertSame($id, $dsUsage->getId());
        $this->assertSame($usage, $dsUsage->getUsage());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" usage="$usage" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dsUsage, 'xml'));
        $this->assertEquals($dsUsage, $this->serializer->deserialize($xml, DataSourceUsage::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'usage' => $usage,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dsUsage, 'json'));
        $this->assertEquals($dsUsage, $this->serializer->deserialize($json, DataSourceUsage::class, 'json'));
    }
}
