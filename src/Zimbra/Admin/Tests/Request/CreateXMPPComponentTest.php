<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateXMPPComponent;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Admin\Struct\XmppComponentSpec;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\ServerBy;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateXMPPComponent.
 */
class CreateXMPPComponentTest extends ZimbraAdminApiTestCase
{
    public function testCreateXMPPComponentRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $server = new ServerSelector(ServerBy::NAME(), $value);
        $xmpp = new XmppComponentSpec($name, $domain, $server, [$attr]);

        $req = new CreateXMPPComponent($xmpp);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($xmpp, $req->getComponent());

        $req->setComponent($xmpp);
        $this->assertSame($xmpp, $req->getComponent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateXMPPComponentRequest>'
                . '<xmppcomponent name="' . $name . '">'
                    . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                    . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</xmppcomponent>'
            . '</CreateXMPPComponentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateXMPPComponentRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'xmppcomponent' => [
                    'name' => $name,
                    'domain' => [
                        'by' => DomainBy::NAME()->value(),
                        '_content' => $value,
                    ],
                    'server' => [
                        'by' => ServerBy::NAME()->value(),
                        '_content' => $value,
                    ],
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateXMPPComponentApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $server = new ServerSelector(ServerBy::NAME(), $value);
        $xmpp = new XmppComponentSpec($name, $domain, $server, [$attr]);

        $this->api->createXMPPComponent(
            $xmpp
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateXMPPComponentRequest>'
                        . '<urn1:xmppcomponent name="' . $name . '">'
                            . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                            . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                            . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                        . '</urn1:xmppcomponent>'
                    . '</urn1:CreateXMPPComponentRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
