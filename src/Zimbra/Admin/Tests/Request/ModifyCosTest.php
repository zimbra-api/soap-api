<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ModifyCos;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for ModifyCos.
 */
class ModifyCosTest extends ZimbraAdminApiTestCase
{
    public function testModifyCosRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;

        $attr = new KeyValuePair($key, $value);
        $req = new ModifyCos($id, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyCosRequest>'
                . '<id>' . $id . '</id>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
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

    public function testModifyCosApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $attr = new KeyValuePair($key, $value);

        $this->api->modifyCos(
            $id, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyCosRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
