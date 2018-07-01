<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\XmppComponentSelector;
use Zimbra\Enum\XmppComponentBy as XmppBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for XmppComponentSelector.
 */
class XmppComponentSelectorTest extends ZimbraStructTestCase
{
    public function testXmppComponentSelector()
    {
        $value = $this->faker->word;
        $xmpp = new XmppComponentSelector(XmppBy::ID()->value(), $value);
        $this->assertSame(XmppBy::ID()->value(), $xmpp->getBy());
        $this->assertSame($value, $xmpp->getValue());

        $xmpp = new XmppComponentSelector('');
        $xmpp->setBy(XmppBy::NAME()->value())
             ->setValue($value);
        $this->assertSame(XmppBy::NAME()->value(), $xmpp->getBy());
        $this->assertSame($value, $xmpp->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xmpp, 'xml'));

        $xmpp = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\XmppComponentSelector', 'xml');
        $this->assertSame(XmppBy::NAME()->value(), $xmpp->getBy());
        $this->assertSame($value, $xmpp->getValue());
    }
}
