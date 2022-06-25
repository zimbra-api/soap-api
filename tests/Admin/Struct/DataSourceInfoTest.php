<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\{Attr, DataSourceInfo};
use Zimbra\Common\Enum\DataSourceType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DataSourceInfo.
 */
class DataSourceInfoTest extends ZimbraTestCase
{
    public function testDataSourceInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $ds = new DataSourceInfo($name, $id, DataSourceType::IMAP());
        $this->assertSame($name, $ds->getName());
        $this->assertSame($id, $ds->getId());
        $this->assertEquals(DataSourceType::IMAP(), $ds->getType());

        $attr = new Attr($key, $value);
        $ds = new DataSourceInfo('', '', DataSourceType::IMAP());
        $ds->setName($name)
           ->setId($id)
           ->setType(DataSourceType::POP3())
           ->addAttr($attr);
        $this->assertSame($name, $ds->getName());
        $this->assertSame($id, $ds->getId());
        $this->assertEquals(DataSourceType::POP3(), $ds->getType());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" type="pop3">
    <a n="$key">$value</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ds, 'xml'));
        $this->assertEquals($ds, $this->serializer->deserialize($xml, DataSourceInfo::class, 'xml'));
    }
}
