<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\{Attr, DomainSelector, ServerSelector, XMPPComponentSpec};
use Zimbra\Enum\{DomainBy, ServerBy};
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
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $server = new ServerSelector(ServerBy::NAME(), $value);

        $xmpp = new XMPPComponentSpec($name, $domain, $server);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $xmpp = new XMPPComponentSpec('', new DomainSelector(DomainBy::ID()), new ServerSelector(ServerBy::ID()));
        $xmpp->setName($name)
             ->setDomain($domain)
             ->setServer($server)
             ->addAttr($attr);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $by = DomainBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<xmppcomponent name="$name">
    <a n="$name">$value</a>
    <domain by="$by">$value</domain>
    <server by="$by">$value</server>
</xmppcomponent>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xmpp, 'xml'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($xml, XMPPComponentSpec::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $name,
                    '_content' => $value,
                ],
            ],
            'name' => $name,
            'domain' => [
                'by' => $by,
                '_content' => $value,
            ],
            'server' => [
                'by' => $by,
                '_content' => $value,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($xmpp, 'json'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($json, XMPPComponentSpec::class, 'json'));
    }
}
