<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\VersionCheck;
use Zimbra\Enum\VersionCheckAction;

/**
 * Testcase class for VersionCheck.
 */
class VersionCheckTest extends ZimbraAdminApiTestCase
{
    public function testVersionCheckRequest()
    {
        $req = new \Zimbra\Admin\Request\VersionCheck(VersionCheckAction::STATUS());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('status', $req->getAction());
        $req->setAction(VersionCheckAction::CHECK());
        $this->assertEquals('check', $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<VersionCheckRequest '
                . 'action="' . VersionCheckAction::CHECK() . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VersionCheckRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => VersionCheckAction::CHECK()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVersionCheckApi()
    {
        $this->api->versionCheck(
            VersionCheckAction::CHECK()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:VersionCheckRequest '
                        . 'action="' . VersionCheckAction::CHECK() . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
