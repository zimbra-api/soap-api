<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\EndSession;

/**
 * Testcase class for EndSession.
 */
class EndSessionTest extends ZimbraAccountApiTestCase
{
    public function testEndSessionRequest()
    {
        $req = new EndSession(false);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertFalse($req->getLogoff());
        $req->setLogoff(true);
        $this->assertTrue($req->getLogoff());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<EndSessionRequest logoff="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'EndSessionRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'logoff' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testEndSessionApi()
    {
        $this->api->endSession(true);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:EndSessionRequest logoff="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
