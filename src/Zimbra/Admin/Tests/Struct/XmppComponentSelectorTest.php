<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\XmppComponentSelector;
use Zimbra\Enum\XmppComponentBy as XmppBy;

/**
 * Testcase class for XmppComponentSelector.
 */
class XmppComponentSelectorTest extends ZimbraAdminTestCase
{
    public function testXmppComponentSelector()
    {
        $value = $this->faker->word;
        $xmpp = new XmppComponentSelector(XmppBy::ID(), $value);
        $this->assertTrue($xmpp->getBy()->is('id'));
        $this->assertSame($value, $xmpp->getValue());

        $xmpp->setBy(XmppBy::NAME());
        $this->assertTrue($xmpp->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xmpp);

        $array = [
            'xmppcomponent' => [
                'by' => XmppBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $xmpp->toArray());
    }
}
