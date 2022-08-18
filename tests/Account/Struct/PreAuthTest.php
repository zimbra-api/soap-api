<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\PreAuth;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PreAuth.
 */
class PreAuthTest extends ZimbraTestCase
{
    public function testPreAuth()
    {
        $name = $this->faker->email;
        $preauthKey = $value = $this->faker->sha256;
        $timestamp = $this->faker->unixTime();
        $expire = $this->faker->randomNumber;

        $computeValue = hash_hmac(
            'sha1', $name . '|' . AccountBy::NAME->value . '|' . $expire . '|' . $timestamp, $preauthKey
        );
        $account = new AccountSelector(AccountBy::NAME, $name);

        $preauth = new PreAuth($account, $preauthKey, $timestamp, $expire);
        $this->assertSame($timestamp, $preauth->getTimestamp());
        $this->assertSame($expire, $preauth->getExpiresTimestamp());
        $this->assertSame($computeValue, $preauth->getValue());

        $preauth->setTimestamp($timestamp + 1000)
            ->setExpiresTimestamp($expire + 1000)
            ->setValue($value);
        $this->assertSame($timestamp + 1000, $preauth->getTimestamp());
        $this->assertSame($expire + 1000, $preauth->getExpiresTimestamp());
        $this->assertSame($value, $preauth->getValue());

        $preauth = new PreAuth($account, $preauthKey, $timestamp, $expire);
        $xml = <<<EOT
<?xml version="1.0"?>
<result timestamp="$timestamp" expires="$expire">$computeValue</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($preauth, 'xml'));
        $this->assertEquals($preauth, $this->serializer->deserialize($xml, PreAuth::class, 'xml'));
    }
}
