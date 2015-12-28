<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteLDAPEntry;

/**
 * Testcase class for DeleteLDAPEntry.
 */
class DeleteLDAPEntryTest extends ZimbraAdminApiTestCase
{
    public function testDeleteLDAPEntryRequest()
    {
        $dn = $this->faker->word;
        $req = new DeleteLDAPEntry($dn);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($dn, $req->getDn());

        $req->setDn($dn);
        $this->assertSame($dn, $req->getDn());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteLDAPEntryRequest dn="' . $dn  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteLDAPEntryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'dn' => $dn,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteLDAPEntryApi()
    {
        $dn = $this->faker->word;
        $this->api->deleteLDAPEntry(
            $dn
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteLDAPEntryRequest dn="' . $dn . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
