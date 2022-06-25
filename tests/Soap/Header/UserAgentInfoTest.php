<?php declare(strict_types=1);

namespace Zimbra\Tests\Soap\Header;

use Zimbra\Soap\Header\UserAgentInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for UserAgentInfo.
 */
class UserAgentInfoTest extends ZimbraTestCase
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" version="$version" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, UserAgentInfo::class, 'xml'));
    }
}
