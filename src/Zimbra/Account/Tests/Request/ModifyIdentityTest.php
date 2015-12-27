<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\ModifyIdentity;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Identity;

/**
 * Testcase class for ModifyIdentity.
 */
class ModifyIdentityTest extends ZimbraAccountApiTestCase
{
    public function testModifyIdentityRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($name, $value, true);
        $identity = new Identity($name, $id, [$attr]);

        $req = new ModifyIdentity($identity);    
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($identity, $req->getIdentity());
        $req->setIdentity($identity);
        $this->assertSame($identity, $req->getIdentity());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyIdentityRequest>'
                . '<identity name="' . $name . '" id="' . $id . '">'
                    . '<a name="' . $name . '" pd="true">' . $value . '</a>'
                . '</identity>'
            . '</ModifyIdentityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyIdentityRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'identity' => [
                    'name' => $name,
                    'id' => $id,
                    'a' => [
                        [
                            'name' => $name,
                            '_content' => $value,
                            'pd' => true,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyIdentityApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $value = $this->faker->word;
        $attr = new Attr($name, $value, true);
        $identity = new Identity($name, $id, [$attr]);

        $this->api->modifyIdentity($identity);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyIdentityRequest>'
                        . '<urn1:identity name="' . $name . '" id="' . $id . '">'
                            . '<urn1:a name="' . $name . '" pd="true">' . $value . '</urn1:a>'
                        . '</urn1:identity>'
                    . '</urn1:ModifyIdentityRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
