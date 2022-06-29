<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountZimletTarget;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountZimletTarget.
 */
class AccountZimletTargetTest extends ZimbraTestCase
{
    public function testAccountZimletTarget()
    {
        $value = $this->faker->word;
        $target = new AccountZimletTarget($value);
        $this->assertSame($value, $target->getValue());

        $target = new AccountZimletTarget();
        $target->setValue($value);
        $this->assertSame($value, $target->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, AccountZimletTarget::class, 'xml'));
    }
}
