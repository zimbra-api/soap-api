<?php declare(strict_types=1);

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
        $xmpp = new XmppComponentSelector(XmppBy::ID(), $value);
        $this->assertEquals(XmppBy::ID(), $xmpp->getBy());
        $this->assertSame($value, $xmpp->getValue());

        $xmpp = new XmppComponentSelector(XmppBy::ID());
        $xmpp->setBy(XmppBy::NAME())
             ->setValue($value);
        $this->assertEquals(XmppBy::NAME(), $xmpp->getBy());
        $this->assertSame($value, $xmpp->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xmpp, 'xml'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($xml, XmppComponentSelector::class, 'xml'));

        $json = json_encode([
            'by' => (string) XmppBy::NAME(),
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($xmpp, 'json'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($json, XmppComponentSelector::class, 'json'));
    }
}
