<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\XmppComponentSpec;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\ServerBy;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for XmppComponentSpec.
 */
class XmppComponentSpecTest extends ZimbraAdminTestCase
{
    public function testXmppComponentSpec()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $attr = new KeyValuePair($name, $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $server = new ServerSelector(ServerBy::NAME(), $value);

        $xmpp = new XmppComponentSpec($name, $domain, $server);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $xmpp->setName($name)
             ->setDomain($domain)
             ->setServer($server)
             ->addAttr($attr);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<xmppcomponent name="' . $name . '">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                . '<a n="' . $name . '">' . $value . '</a>'
            . '</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xmpp);

        $array = [
            'xmppcomponent' => [
                'name' => $name,
                'domain' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
                'a' => [
                    [
                        'n' => $name,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $xmpp->toArray());
    }
}
