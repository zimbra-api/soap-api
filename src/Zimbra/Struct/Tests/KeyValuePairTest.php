<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for KeyValuePair.
 */
class KeyValuePairTest extends ZimbraStructTestCase
{
    public function testKeyValuePair()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $kpv = new KeyValuePair($key, $value);
        $this->assertSame($key, $kpv->getKey());
        $this->assertSame($value, $kpv->getValue());

        $kpv = new KeyValuePair('', '');
        $kpv->setKey($key)
            ->setValue($value);
        $this->assertSame($key, $kpv->getKey());
        $this->assertSame($value, $kpv->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a n="' . $key . '">' . $value . '</a>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($kpv, 'xml'));

        $kpv = $this->serializer->deserialize($xml, 'Zimbra\Struct\KeyValuePair', 'xml');
        $this->assertSame($key, $kpv->getKey());
        $this->assertSame($value, $kpv->getValue());
    }
}
