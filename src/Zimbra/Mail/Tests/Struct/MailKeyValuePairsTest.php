<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailKeyValuePairs;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for MailKeyValuePairs.
 */
class MailKeyValuePairsTest extends ZimbraMailTestCase
{
    public function testMailKeyValuePairs()
    {
        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $a = new KeyValuePair($key1, $value1);
        $b = new KeyValuePair($key2, $value2);

        $kpv = new MailKeyValuePairs([$a]);
        $this->assertSame([$a], $kpv->getKeyValuePairs()->all());

        $kpv->addKeyValuePair($b);
        $this->assertSame([$a, $b], $kpv->getKeyValuePairs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<kpv>'
                .'<a n="' . $key1 . '">' . $value1 . '</a>'
                .'<a n="' . $key2 . '">' . $value2 . '</a>'
            .'</kpv>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $kpv);

        $array = array(
            'kpv' => array(
                'a' => array(
                    array('n' => $key1, '_content' => $value1),
                    array('n' => $key2, '_content' => $value2),
                ),
            ),
        );
        $this->assertEquals($array, $kpv->toArray());
    }
}
