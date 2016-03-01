<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetDataSources;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for GetDataSources.
 */
class GetDataSourcesTest extends ZimbraAdminApiTestCase
{
    public function testGetDataSourcesRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->word;
        $attr = new KeyValuePair($key, $value);
        $req = new GetDataSources($id, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDataSourcesRequest id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</GetDataSourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDataSourcesRequest' => [
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

    public function testGetDataSourcesApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->getDataSources($id, [$attr]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDataSourcesRequest id="' . $id . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:GetDataSourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
