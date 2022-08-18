<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Enum\TargetType;

use Zimbra\Mail\Struct\TargetSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TargetSpec.
 */
class TargetSpecTest extends ZimbraTestCase
{
    public function testTargetSpec()
    {
        $targetType = TargetType::ACCOUNT;
        $accountBy = AccountBy::NAME;
        $value = $this->faker->email;

        $target = new TargetSpec($targetType, $accountBy, $value);
        $this->assertSame($targetType, $target->getTargetType());
        $this->assertSame($accountBy, $target->getAccountBy());
        $this->assertSame($value, $target->getValue());

        $target = new TargetSpec(TargetType::ACCOUNT, AccountBy::NAME);
        $target->setTargetType($targetType)
            ->setAccountBy($accountBy)
            ->setValue($value);
        $this->assertSame($targetType, $target->getTargetType());
        $this->assertSame($accountBy, $target->getAccountBy());
        $this->assertSame($value, $target->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="account" by="name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, TargetSpec::class, 'xml'));
    }
}
