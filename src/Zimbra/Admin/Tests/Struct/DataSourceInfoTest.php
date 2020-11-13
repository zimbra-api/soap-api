<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\{Attr, DataSourceInfo};
use Zimbra\Enum\DataSourceType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DataSourceInfo.
 */
class DataSourceInfoTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dataSource name="' . $name . '" id="' . $id . '" type="' . DataSourceType::POP3() . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</dataSource>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ds, 'xml'));
        $this->assertEquals($ds, $this->serializer->deserialize($xml, DataSourceInfo::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
            'name' => $name,
            'id' => $id,
            'type' => (string) DataSourceType::POP3(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($ds, 'json'));
        $this->assertEquals($ds, $this->serializer->deserialize($json, DataSourceInfo::class, 'json'));
    }
}
