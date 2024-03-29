<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for KeyValuePair.
 */
class KeyValuePairTest extends ZimbraTestCase
{
    public function testKeyValuePair()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $kpv = new KeyValuePair($key, $value);
        $this->assertSame($key, $kpv->getKey());
        $this->assertSame($value, $kpv->getValue());

        $kpv = new KeyValuePair();
        $kpv->setKey($key)
            ->setValue($value);
        $this->assertSame($key, $kpv->getKey());
        $this->assertSame($value, $kpv->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$key">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($kpv, 'xml'));
        $this->assertEquals($kpv, $this->serializer->deserialize($xml, KeyValuePair::class, 'xml'));
    }
}
