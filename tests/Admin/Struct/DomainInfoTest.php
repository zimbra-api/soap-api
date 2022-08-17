<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DomainInfo.
 */
class DomainInfoTest extends ZimbraTestCase
{
    public function testDomainInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $domain = new StubDomainInfo($name, $id, [new Attr($key, $value)]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($domain, 'xml'));
        $this->assertEquals($domain, $this->serializer->deserialize($xml, StubDomainInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubDomainInfo extends DomainInfo
{
}
