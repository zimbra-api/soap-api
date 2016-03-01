<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteXMPPComponent;
use Zimbra\Admin\Struct\XmppComponentSelector;
use Zimbra\Enum\XmppComponentBy as XmppBy;

/**
 * Testcase class for DeleteXMPPComponent.
 */
class DeleteXMPPComponentTest extends ZimbraAdminApiTestCase
{
    public function testDeleteXMPPComponentRequest()
    {
        $value = $this->faker->word;
        $xmpp = new XmppComponentSelector(XmppBy::NAME(), $value);
        $req = new DeleteXMPPComponent($xmpp);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($xmpp, $req->getComponent());

        $req->setComponent($xmpp);
        $this->assertSame($xmpp, $req->getComponent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteXMPPComponentRequest>'
                . '<xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</xmppcomponent>'
            . '</DeleteXMPPComponentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteXMPPComponentRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'xmppcomponent' => [
                    'by' => XmppBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteXMPPComponentApi()
    {
        $value = $this->faker->word;
        $xmpp = new XmppComponentSelector(XmppBy::NAME(), $value);

        $this->api->deleteXMPPComponent(
            $xmpp
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteXMPPComponentRequest>'
                        . '<urn1:xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</urn1:xmppcomponent>'
                    . '</urn1:DeleteXMPPComponentRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
