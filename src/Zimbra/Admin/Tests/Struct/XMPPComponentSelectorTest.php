<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\XMPPComponentSelector;
use Zimbra\Enum\XmppComponentBy as XmppBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for XMPPComponentSelector.
 */
class XMPPComponentSelectorTest extends ZimbraStructTestCase
{
    public function testXMPPComponentSelector()
    {
        $value = $this->faker->word;
        $xmpp = new XMPPComponentSelector(XmppBy::ID(), $value);
        $this->assertEquals(XmppBy::ID(), $xmpp->getBy());
        $this->assertSame($value, $xmpp->getValue());

        $xmpp = new XMPPComponentSelector(XmppBy::ID());
        $xmpp->setBy(XmppBy::NAME())
             ->setValue($value);
        $this->assertEquals(XmppBy::NAME(), $xmpp->getBy());
        $this->assertSame($value, $xmpp->getValue());

        $by = XmppBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<xmppcomponent by="$by">$value</xmppcomponent>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xmpp, 'xml'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($xml, XMPPComponentSelector::class, 'xml'));

        $json = json_encode([
            'by' => $by,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($xmpp, 'json'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($json, XMPPComponentSelector::class, 'json'));
    }
}
