<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\AccountKeyValuePairs;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

use JMS\Serializer\Annotation\XmlRoot;

/**
 * Testcase class for AccountKeyValuePairs.
 */
class AccountKeyValuePairsTest extends ZimbraStructTestCase
{
    public function testAccountKeyValuePairs()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $attrs = new MockAccountKeyValuePairs();

        $attrs->addAttr($attr);
        $this->assertSame([$attr], $attrs->getAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));

        $attrs = $this->serializer->deserialize($xml, 'Zimbra\Account\Tests\Struct\MockAccountKeyValuePairs', 'xml');
        $attr = $attrs->getAttrs()[0];
        $this->assertSame($key, $attr->getKey());
        $this->assertSame($value, $attr->getValue());
    }
}

/** @XmlRoot(name="attrs") */
class MockAccountKeyValuePairs extends AccountKeyValuePairs
{
}
