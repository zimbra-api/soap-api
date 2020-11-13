<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\{Attr, DataSourceSpecifier};
use Zimbra\Enum\DataSourceType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DataSourceSpecifier.
 */
class DataSourceSpecifierTest extends ZimbraStructTestCase
{
    public function testDataSourceSpecifier()
    {
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $ds = new DataSourceSpecifier(DataSourceType::IMAP(), $name);
        $this->assertEquals(DataSourceType::IMAP(), $ds->getType());
        $this->assertSame($name, $ds->getName());

        $attr = new Attr($key, $value);
        $ds = new DataSourceSpecifier(DataSourceType::IMAP(), '');
        $ds->setType(DataSourceType::POP3())
           ->setName($name)
           ->addAttr($attr);
        $this->assertEquals(DataSourceType::POP3(), $ds->getType());
        $this->assertSame($name, $ds->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dataSource type="' . DataSourceType::POP3() . '" name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</dataSource>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ds, 'xml'));
        $this->assertEquals($ds, $this->serializer->deserialize($xml, DataSourceSpecifier::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
            'type' => (string) DataSourceType::POP3(),
            'name' => $name,
        ]);
        $this->assertSame($json, $this->serializer->serialize($ds, 'json'));
        $this->assertEquals($ds, $this->serializer->deserialize($json, DataSourceSpecifier::class, 'json'));
    }
}
