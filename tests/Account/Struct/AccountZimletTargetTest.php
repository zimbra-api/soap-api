<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountZimletTarget;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for AccountZimletTarget.
 */
class AccountZimletTargetTest extends ZimbraStructTestCase
{
    public function testAccountZimletTarget()
    {
        $value = $this->faker->word;
        $target = new AccountZimletTarget($value);
        $this->assertSame($value, $target->getValue());

        $target = new AccountZimletTarget('');
        $target->setValue($value);
        $this->assertSame($value, $target->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<target>$value</target>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, AccountZimletTarget::class, 'xml'));

        $json = json_encode([
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, AccountZimletTarget::class, 'json'));
    }
}
