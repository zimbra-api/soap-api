<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\LDAPEntryInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for LDAPEntryInfo.
 */
class LDAPEntryInfoTest extends ZimbraTestCase
{
    public function testLDAPEntryInfo()
    {
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $ldap = new StubLDAPEntryInfo($name, [$attr]);
        $this->assertSame($name, $ldap->getName());

        $ldap = new StubLDAPEntryInfo('', [$attr]);
        $ldap->setName($name);
        $this->assertSame($name, $ldap->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ldap, 'xml'));
        $this->assertEquals($ldap, $this->serializer->deserialize($xml, StubLDAPEntryInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubLDAPEntryInfo extends LDAPEntryInfo
{
}
