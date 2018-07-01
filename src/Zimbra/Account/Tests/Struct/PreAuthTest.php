<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\PreAuth;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for PreAuth.
 */
class PreAuthTest extends ZimbraStructTestCase
{
    public function testPreAuth()
    {
        $now = $this->faker->unixTime();
        $value = $this->faker->word;
        $expire = mt_rand(0, 1000);

        $pre = new PreAuth($now, $value, $expire);
        $this->assertSame($now, $pre->getTimestamp());
        $this->assertSame($value, $pre->getValue());
        $this->assertSame($expire, $pre->getExpiresTimestamp());

        $pre->setTimestamp($now + 1000)
            ->setExpiresTimestamp($expire);
        $this->assertSame($now + 1000, $pre->getTimestamp());
        $this->assertSame($expire, $pre->getExpiresTimestamp());

        $preauth = 'account' . '|name|' . $pre->getExpiresTimestamp() . '|' . $pre->getTimestamp();
        $computeValue = hash_hmac('sha1', $preauth, $value);
        $this->assertSame($computeValue, $pre->computeValue('account', $value)->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<preauth timestamp="' . ($now + 1000) . '" expiresTimestamp="' . $expire . '">' . $computeValue . '</preauth>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($pre, 'xml'));

        $pre = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\PreAuth', 'xml');
        $this->assertSame($now + 1000, $pre->getTimestamp());
        $this->assertSame($expire, $pre->getExpiresTimestamp());
        $this->assertSame($computeValue, $pre->getValue());
    }
}
