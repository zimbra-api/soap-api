<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\DataSourceSpecifier;
use Zimbra\Enum\DataSourceType;
use Zimbra\Struct\KeyValuePair;
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

        $ds = new DataSourceSpecifier(DataSourceType::IMAP()->value(), $name);
        $this->assertSame(DataSourceType::IMAP()->value(), $ds->getType());
        $this->assertSame($name, $ds->getName());

        $attr = new KeyValuePair($key, $value);
        $ds = new DataSourceSpecifier('', '');
        $ds->setType(DataSourceType::POP3()->value())
           ->setName($name)
           ->addAttr($attr);
        $this->assertSame(DataSourceType::POP3()->value(), $ds->getType());
        $this->assertSame($name, $ds->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dataSource type="' . DataSourceType::POP3() . '" name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</dataSource>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ds, 'xml'));

        $ds = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\DataSourceSpecifier', 'xml');
        $this->assertSame(DataSourceType::POP3()->value(), $ds->getType());
        $this->assertSame($name, $ds->getName());
        foreach ($ds->getAttrs() as $attr) {
            $this->assertInstanceOf('\Zimbra\Struct\KeyValuePair', $attr);
        }
    }
}
