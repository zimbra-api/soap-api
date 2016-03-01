<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\ModifyProperties;
use Zimbra\Account\Struct\Prop;

/**
 * Testcase class for ModifyProperties.
 */
class ModifyPropertiesTest extends ZimbraAccountApiTestCase
{
    public function testModifyPropertiesRequest()
    {
        $zimlet = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;

        $prop = new Prop($zimlet, $name, $value);
        $req = new ModifyProperties([$prop]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$prop], $req->getProps()->all());

        $req->addProp($prop);
        $this->assertSame([$prop, $prop], $req->getProps()->all());
        $req->getProps()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyPropertiesRequest>'
                . '<prop zimlet="' . $zimlet . '" name="' . $name . '">' . $value . '</prop>'
            . '</ModifyPropertiesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyPropertiesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'prop' => [
                    [
                        'zimlet' => $zimlet,
                        'name' => $name,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyPropertiesApi()
    {
        $zimlet = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $prop = new Prop($zimlet, $name, $value);

        $this->api->modifyProperties([$prop]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyPropertiesRequest>'
                        . '<urn1:prop zimlet="' . $zimlet . '" name="' . $name . '">' . $value . '</urn1:prop>'
                    . '</urn1:ModifyPropertiesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
