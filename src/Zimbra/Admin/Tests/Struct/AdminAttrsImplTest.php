<?php

namespace Zimbra\Admin\Tests\Struct;

use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Struct\Tests\ZimbraStructTestCase;
use Zimbra\Admin\Struct\AdminAttrsImpl;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for AdminAttrsImpl.
 */
class AdminAttrsImplTest extends ZimbraStructTestCase
{
    public function testAdminAttrsImpl()
    {
        $stub = new StubAdminAttrsImpl();

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;
        $key3 = $this->faker->word;
        $value3 = $this->faker->word;

        $attr1 = new KeyValuePair($key1, $value1);
        $attr2 = new KeyValuePair($key2, $value2);
        $attr3 = new KeyValuePair($key3, $value3);
        $stub->setAttrs([$attr1, $attr2])->addAttr($attr3);
        foreach ($stub->getAttrs() as $attr) {
            $this->assertInstanceOf('\Zimbra\Struct\KeyValuePair', $attr);
        }

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<stub>'
                . '<a n="' . $key1 . '">' . $value1 . '</a>'
                . '<a n="' . $key2 . '">' . $value2 . '</a>'
                . '<a n="' . $key3 . '">' . $value3 . '</a>'
            . '</stub>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));

        $stub = $this->serializer->deserialize($xml, 'Zimbra\Admin\Tests\Struct\StubAdminAttrsImpl', 'xml');
        foreach ($stub->getAttrs() as $attr) {
            $this->assertInstanceOf('\Zimbra\Struct\KeyValuePair', $attr);
        }
    }
}

/**
 * @XmlRoot(name="stub")
 */
class StubAdminAttrsImpl extends AdminAttrsImpl
{
}
