<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct\Header;

use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\Header\AccountInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountInfo.
 */
class AccountInfoTest extends ZimbraTestCase
{
    public function testHeaderAccountInfo()
    {
        $value = $this->faker->word;
        $info = new AccountInfo(AccountBy::ID(), $value, FALSE);
        $this->assertEquals(AccountBy::ID(), $info->getBy());
        $this->assertFalse($info->getMountpointTraversed());
        $this->assertSame($value, $info->getValue());

        $info = new AccountInfo();
        $info->setBy(AccountBy::NAME())
             ->setMountpointTraversed(TRUE)
             ->setValue($value);
        $this->assertEquals(AccountBy::NAME(), $info->getBy());
        $this->assertTrue($info->getMountpointTraversed());
        $this->assertSame($value, $info->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result by="name" link="true">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, AccountInfo::class, 'xml'));
    }
}
