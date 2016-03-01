<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RenameLDAPEntry;

/**
 * Testcase class for RenameLDAPEntry.
 */
class RenameLDAPEntryTest extends ZimbraAdminApiTestCase
{
    public function testRenameLDAPEntryRequest()
    {
        $dn = $this->faker->word;
        $newDn = $this->faker->word;

        $req = new RenameLDAPEntry($dn, $newDn);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($dn, $req->getDn());
        $this->assertEquals($newDn, $req->getNewDn());
        $req->setDn($dn)
            ->setNewDn($newDn);
        $this->assertEquals($dn, $req->getDn());
        $this->assertEquals($newDn, $req->getNewDn());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameLDAPEntryRequest dn="' . $dn . '" new_dn="' . $newDn . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameLDAPEntryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'dn' => $dn,
                'new_dn' => $newDn,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameLDAPEntryApi()
    {
        $dn = $this->faker->word;
        $newDn = $this->faker->word;
        $this->api->renameLDAPEntry($dn, $newDn);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameLDAPEntryRequest dn="' . $dn . '" new_dn="' . $newDn . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
