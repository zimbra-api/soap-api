<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\CreateIdentity;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Identity;

/**
 * Testcase class for CreateIdentity.
 */
class CreateIdentityTest extends ZimbraAccountApiTestCase
{
    public function testCreateIdentityRequest()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;

        $attr = new Attr($name, $value, true);
        $identity = new Identity($name, $id, [$attr]);

        $req = new CreateIdentity($identity);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($identity, $req->getIdentity());

        $req->setIdentity($identity);
        $this->assertSame($identity, $req->getIdentity());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateIdentityRequest>'
                . '<identity name="' . $name . '" id="' . $id . '">'
                    . '<a name="' . $name . '" pd="true">' . $value . '</a>'
                . '</identity>'
            . '</CreateIdentityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateIdentityRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'identity' => [
                    'name' => $name,
                    'id' => $id,
                    'a' => [
                        [
                            'name' => $name,
                            'pd' => true,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateIdentityApi()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $attr = new Attr($name, $value, true);
        $identity = new Identity($name, $id, [$attr]);

        $this->api->createIdentity(
            $identity
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:CreateIdentityRequest>'
                        . '<urn1:identity name="' . $name . '" id="' . $id . '">'
                            . '<urn1:a name="' . $name . '" pd="true">' . $value . '</urn1:a>'
                        . '</urn1:identity>'
                    . '</urn1:CreateIdentityRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
