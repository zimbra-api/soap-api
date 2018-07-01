<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\XmppComponentSpec;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\ServerBy;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for XmppComponentSpec.
 */
class XmppComponentSpecTest extends ZimbraStructTestCase
{
    public function testXmppComponentSpec()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $attr = new KeyValuePair($name, $value);
        $domain = new DomainSelector(DomainBy::NAME()->value(), $value);
        $server = new ServerSelector(ServerBy::NAME()->value(), $value);

        $xmpp = new XmppComponentSpec($name, $domain, $server);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $xmpp = new XmppComponentSpec('', new DomainSelector(''), new ServerSelector(''));
        $xmpp->setName($name)
             ->setDomain($domain)
             ->setServer($server)
             ->addAttr($attr);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<xmppcomponent name="' . $name . '">'
                . '<a n="' . $name . '">' . $value . '</a>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
            . '</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xmpp, 'xml'));

        $xmpp = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\XmppComponentSpec', 'xml');
        $domain = $xmpp->getDomain();
        $server = $xmpp->getServer();
        $attr = $xmpp->getAttrs()[0];

        $this->assertSame($name, $xmpp->getName());
        $this->assertSame(DomainBy::NAME()->value(), $domain->getBy());
        $this->assertSame($value, $domain->getValue());
        $this->assertSame(ServerBy::NAME()->value(), $server->getBy());
        $this->assertSame($value, $server->getValue());
        $this->assertSame($name, $attr->getKey());
        $this->assertSame($value, $attr->getValue());
    }
}
