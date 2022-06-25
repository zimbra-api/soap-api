<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $domain = new DomainInfo($name, $id, [new Attr($key, $value)]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id">
    <a n="$key">$value</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($domain, 'xml'));
        $this->assertEquals($domain, $this->serializer->deserialize($xml, DomainInfo::class, 'xml'));
    }
}
