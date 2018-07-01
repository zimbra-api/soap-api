<?php

namespace Zimbra\Soap\Tests\Header;

use Zimbra\Soap\Header\UserAgentInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for UserAgentInfo.
 */
class UserAgentInfoTest extends ZimbraStructTestCase
{
    public function testHeaderUserAgentInfo()
    {
        $name = $this->faker->word;
        $version = $this->faker->word;

        $info = new UserAgentInfo($name, $version);
        $this->assertSame($name, $info->getName());
        $this->assertSame($version, $info->getVersion());

        $info = new UserAgentInfo();
        $info->setName($name)
             ->setVersion($version);
        $this->assertSame($name, $info->getName());
        $this->assertSame($version, $info->getVersion());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<userAgent name="' . $name . '" version="' . $version . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));

        $info = $this->serializer->deserialize($xml, 'Zimbra\Soap\Header\UserAgentInfo', 'xml');
        $this->assertSame($name, $info->getName());
        $this->assertSame($version, $info->getVersion());
    }
}
