<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateLDAPEntry;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateLDAPEntry.
 */
class CreateLDAPEntryTest extends ZimbraAdminApiTestCase
{
    public function testCreateLDAPEntryRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $dn = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new CreateLDAPEntry($dn, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($dn, $req->getDn());

        $req->setDn($dn);
        $this->assertSame($dn, $req->getDn());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateLDAPEntryRequest dn="' . $dn . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateLDAPEntryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateLDAPEntryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'dn' => $dn,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateLDAPEntryApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $dn = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->createLDAPEntry(
            $dn, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateLDAPEntryRequest dn="' . $dn . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateLDAPEntryRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
