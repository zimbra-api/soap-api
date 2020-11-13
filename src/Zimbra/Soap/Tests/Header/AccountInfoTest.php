<?php declare(strict_types=1);

namespace Zimbra\Soap\Tests\Header;

use Zimbra\Enum\AccountBy;
use Zimbra\Soap\Header\AccountInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountInfo.
 */
class AccountInfoTest extends ZimbraStructTestCase
{
    public function testHeaderAccountInfo()
    {
        $value = $this->faker->word;
        $info = new AccountInfo(AccountBy::ID(), FALSE, $value);
        $this->assertEquals(AccountBy::ID(), $info->getBy());
        $this->assertFalse($info->getMountpointTraversed());
        $this->assertSame($value, $info->getValue());

        $info = new AccountInfo(AccountBy::ID());
        $info->setBy(AccountBy::NAME())
             ->setMountpointTraversed(TRUE)
             ->setValue($value);
        $this->assertEquals(AccountBy::NAME(), $info->getBy());
        $this->assertTrue($info->getMountpointTraversed());
        $this->assertSame($value, $info->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account by="' . AccountBy::NAME() . '" link="true">' . $value . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, AccountInfo::class, 'xml'));

        $json = json_encode([
            'by' => (string) AccountBy::NAME(),
            'link' => TRUE,
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, AccountInfo::class, 'json'));
    }
}
