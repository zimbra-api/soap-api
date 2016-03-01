<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateCos;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateCos.
 */
class CreateCosTest extends ZimbraAdminApiTestCase
{
    public function testCreateCosRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new CreateCos($name, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());

        $req->setName($name);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCosRequest>'
                . '<name>' . $name . '</name>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
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

    public function testCreateCosApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->createCos(
            $name, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateCosRequest>'
                        . '<urn1:name>' . $name . '</urn1:name>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
