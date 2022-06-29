<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for XMPPComponentInfo.
 */
class XMPPComponentInfoTest extends ZimbraTestCase
{
    public function testXMPPComponentInfo()
    {
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $domainName = $this->faker->domainName;
        $serverName = $this->faker->ipv4;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xmpp = new StubXMPPComponentInfo($name, $id, $domainName, $serverName);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($id, $xmpp->getId());
        $this->assertSame($domainName, $xmpp->getDomainName());
        $this->assertSame($serverName, $xmpp->getServerName());

        $xmpp = new StubXMPPComponentInfo();
        $xmpp->setName($name)
            ->setId($id)
            ->setDomainName($domainName)
            ->setServerName($serverName)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($id, $xmpp->getId());
        $this->assertSame($domainName, $xmpp->getDomainName());
        $this->assertSame($serverName, $xmpp->getServerName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" x-domainName="$domainName" x-serverName="$serverName" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xmpp, 'xml'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($xml, StubXMPPComponentInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubXMPPComponentInfo extends XMPPComponentInfo
{
}
