<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\{Attr, DomainSelector, ServerSelector, XMPPComponentSpec};
use Zimbra\Common\Enum\{DomainBy, ServerBy};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for XMPPComponentSpec.
 */
class XMPPComponentSpecTest extends ZimbraTestCase
{
    public function testXMPPComponentSpec()
    {
        $name = $this->faker->word;
        $value= $this->faker->word;

        $attr = new Attr($name, $value);
        $domain = new DomainSelector(DomainBy::NAME, $value);
        $server = new ServerSelector(ServerBy::NAME, $value);

        $xmpp = new StubXMPPComponentSpec($domain, $server, $name);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $xmpp = new StubXMPPComponentSpec(new DomainSelector(), new ServerSelector());
        $xmpp->setName($name)
             ->setDomain($domain)
             ->setServer($server)
             ->addAttr($attr);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $by = DomainBy::NAME->value;
        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$name">$value</urn:a>
    <urn:domain by="$by">$value</urn:domain>
    <urn:server by="$by">$value</urn:server>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xmpp, 'xml'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($xml, StubXMPPComponentSpec::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubXMPPComponentSpec extends XMPPComponentSpec
{
}
