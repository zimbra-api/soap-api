<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateServer;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateServer.
 */
class CreateServerTest extends ZimbraAdminApiTestCase
{
    public function testCreateServerRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new CreateServer($name, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());

        $req->getName($name);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateServerRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateServerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateServerRequest' => [
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

    public function testCreateServerApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->createServer(
            $name, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateServerRequest name="' . $name . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateServerRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
