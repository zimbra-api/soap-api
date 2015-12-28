<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\DataSourceSpecifier;
use Zimbra\Enum\DataSourceType;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for DataSourceSpecifier.
 */
class DataSourceSpecifierTest extends ZimbraAdminTestCase
{
    public function testDataSourceSpecifier()
    {
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $ds = new DataSourceSpecifier(DataSourceType::IMAP(), $name);
        $this->assertTrue($ds->getType()->is('imap'));
        $this->assertSame($name, $ds->getName());

        $attr = new KeyValuePair($key, $value);
        $ds->setType(DataSourceType::POP3())
           ->setName($name)
           ->addAttr($attr);
        $this->assertTrue($ds->getType()->is('pop3'));
        $this->assertSame($name, $ds->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dataSource type="' . DataSourceType::POP3() . '" name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</dataSource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ds);

        $array = [
            'dataSource' => [
                'type' => DataSourceType::POP3()->value(),
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $ds->toArray());
    }
}
