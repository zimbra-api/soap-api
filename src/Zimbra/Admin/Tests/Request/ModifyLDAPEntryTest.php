<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ModifyLDAPEntry;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for ModifyLDAPEntry.
 */
class ModifyLDAPEntryTest extends ZimbraAdminApiTestCase
{
    public function testModifyLDAPEntryRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $dn = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new ModifyLDAPEntry($dn, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($dn, $req->getDn());

        $req->setDn($dn);
        $this->assertSame($dn, $req->getDn());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyLDAPEntryRequest dn="' . $dn . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyLDAPEntryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyLDAPEntryRequest' => [
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

    public function testModifyLDAPEntryApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $dn = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->modifyLDAPEntry(
            $dn, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyLDAPEntryRequest dn="' . $dn . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyLDAPEntryRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
