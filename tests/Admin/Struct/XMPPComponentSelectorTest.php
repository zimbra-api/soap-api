<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\XMPPComponentSelector;
use Zimbra\Common\Enum\XmppComponentBy as XmppBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for XMPPComponentSelector.
 */
class XMPPComponentSelectorTest extends ZimbraTestCase
{
    public function testXMPPComponentSelector()
    {
        $value = $this->faker->word;
        $xmpp = new XMPPComponentSelector(XmppBy::ID, $value);
        $this->assertEquals(XmppBy::ID, $xmpp->getBy());
        $this->assertSame($value, $xmpp->getValue());

        $xmpp = new XMPPComponentSelector();
        $xmpp->setBy(XmppBy::NAME)
             ->setValue($value);
        $this->assertEquals(XmppBy::NAME, $xmpp->getBy());
        $this->assertSame($value, $xmpp->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result by="name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xmpp, 'xml'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($xml, XMPPComponentSelector::class, 'xml'));
    }
}
