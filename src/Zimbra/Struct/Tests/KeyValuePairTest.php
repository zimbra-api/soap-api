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

        $kpv->setKey($key);
        $this->assertSame($key, $kpv->getKey());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a n="' . $key . '">' . $value . '</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $kpv);

        $array = [
            'a' => [
                'n' => $key,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $kpv->toArray());
    }
}
