<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\ModifyPrefs;
use Zimbra\Account\Struct\Pref;

/**
 * Testcase class for ModifyPrefs.
 */
class ModifyPrefsTest extends ZimbraAccountApiTestCase
{
    public function testModifyPrefsRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $modified = mt_rand(1, 1000);

        $pref = new Pref($name, $value, $modified);
        $req = new ModifyPrefs([$pref]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$pref], $req->getPrefs()->all());

        $req->addPref($pref);
        $this->assertSame([$pref, $pref], $req->getPrefs()->all());
        $req->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyPrefsRequest>'
                . '<pref name="' . $name . '" modified="' . $modified . '">' . $value . '</pref>'
            . '</ModifyPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyPrefsRequest' => [
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

    public function testModifyPrefsApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $modified = mt_rand(0, 1000);
        $pref = new Pref($name, $value, $modified);

        $this->api->modifyPrefs([$pref]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyPrefsRequest>'
                        . '<urn1:pref name="' . $name . '" modified="' . $modified . '">' . $value . '</urn1:pref>'
                    . '</urn1:ModifyPrefsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
