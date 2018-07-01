<?php

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
        $info = new AccountInfo(AccountBy::ID()->value(), false, $value);
        $this->assertSame(AccountBy::ID()->value(), $info->getBy());
        $this->assertFalse($info->getMountpointTraversed());
        $this->assertSame($value, $info->getValue());

        $info = new AccountInfo(AccountBy::ID()->value());
        $info->setBy(AccountBy::NAME()->value())
             ->setMountpointTraversed(true)
             ->setValue($value);
        $this->assertSame(AccountBy::NAME()->value(), $info->getBy());
        $this->assertTrue($info->getMountpointTraversed());
        $this->assertSame($value, $info->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account by="' . AccountBy::NAME() . '" link="true">' . $value . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));

        $info = $this->serializer->deserialize($xml, 'Zimbra\Soap\Header\AccountInfo', 'xml');
        $this->assertSame(AccountBy::NAME()->value(), $info->getBy());
        $this->assertTrue($info->getMountpointTraversed());
        $this->assertSame($value, $info->getValue());
    }
}
