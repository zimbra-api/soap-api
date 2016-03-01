<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetXMPPComponent;
use Zimbra\Admin\Struct\XmppComponentSelector;
use Zimbra\Enum\XmppComponentBy as XmppBy;

/**
 * Testcase class for GetXMPPComponent.
 */
class GetXMPPComponentTest extends ZimbraAdminApiTestCase
{
    public function testGetXMPPComponentRequest()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $xmpp = new XmppComponentSelector(XmppBy::NAME(), $value);
        $req = new GetXMPPComponent($xmpp, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($xmpp, $req->getComponent());

        $req->setComponent($xmpp);
        $this->assertSame($xmpp, $req->getComponent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetXMPPComponentRequest attrs="' . $attrs . '">'
                . '<xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</xmppcomponent>'
            . '</GetXMPPComponentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetXMPPComponentRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'xmppcomponent' => [
                    'by' => XmppBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetXMPPComponentApi()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;
        $xmpp = new XmppComponentSelector(XmppBy::NAME(), $value);

        $this->api->getXMPPComponent(
            $xmpp, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetXMPPComponentRequest attrs="' . $attrs . '">'
                        . '<urn1:xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</urn1:xmppcomponent>'
                    . '</urn1:GetXMPPComponentRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
