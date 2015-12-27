<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetPrefs;
use Zimbra\Account\Struct\Pref;

/**
 * Testcase class for GetPrefs.
 */
class GetPrefsTest extends ZimbraAccountApiTestCase
{
    public function testGetPrefsRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $modified = mt_rand(0, 1000);

        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $modified);
        $req = new \Zimbra\Account\Request\GetPrefs([$pref]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$pref], $req->getPrefs()->all());

        $req->addPref($pref);
        $this->assertSame([$pref, $pref], $req->getPrefs()->all());
        $req->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetPrefsRequest>'
                . '<pref name="' . $name . '" modified="' . $modified . '">' . $value . '</pref>'
            . '</GetPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetPrefsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'pref' => [
                    [
                        'name' => $name,
                        'modified' => $modified,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetPrefsApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $modified = mt_rand(0, 1000);
        $pref = new Pref($name, $value, $modified);

        $this->api->getPrefs([$pref]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetPrefsRequest>'
                        . '<urn1:pref name="' . $name . '" modified="' . $modified . '">' . $value . '</urn1:pref>'
                    . '</urn1:GetPrefsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
