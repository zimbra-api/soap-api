<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\ModifyZimletPrefs;
use Zimbra\Account\Struct\ZimletPrefsSpec;
use Zimbra\Enum\ZimletStatus;

/**
 * Testcase class for ModifyZimletPrefs.
 */
class ModifyZimletPrefsTest extends ZimbraAccountApiTestCase
{
    public function testModifyZimletPrefsRequest()
    {
        $name = $this->faker->word;
        $zimlet = new ZimletPrefsSpec($name, ZimletStatus::ENABLED());
        $req = new ModifyZimletPrefs([$zimlet]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$zimlet], $req->getZimlets()->all());

        $req->addZimlet($zimlet);
        $this->assertSame([$zimlet, $zimlet], $req->getZimlets()->all());
        $req->getZimlets()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyZimletPrefsRequest>'
                . '<zimlet name="' . $name . '" presence="' . ZimletStatus::ENABLED() . '" />'
            . '</ModifyZimletPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyZimletPrefsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'zimlet' => [
                    [
                        'name' => $name,
                        'presence' => ZimletStatus::ENABLED()->value(),
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyZimletPrefsApi()
    {
        $name = $this->faker->word;
        $zimlet = new ZimletPrefsSpec($name, ZimletStatus::ENABLED());

        $this->api->modifyZimletPrefs([$zimlet]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyZimletPrefsRequest>'
                        . '<urn1:zimlet name="' . $name . '" presence="' . ZimletStatus::ENABLED() . '" />'
                    . '</urn1:ModifyZimletPrefsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
