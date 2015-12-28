<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteDataSource;
use Zimbra\Struct\Id;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for DeleteDataSource.
 */
class DeleteDataSourceTest extends ZimbraAdminApiTestCase
{
    public function testDeleteDataSourceRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $dataSource = new Id($id);

        $req = new DeleteDataSource($id, $dataSource, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $req->setId($id)
            ->setDataSource($dataSource);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());


        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteDataSourceRequest id="' . $id . '">'
                . '<dataSource id="' . $id . '" />'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</DeleteDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteDataSourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'dataSource' => [
                    'id' => $id,
                ],
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

    public function testDeleteDataSourceApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->word;
        $attr = new KeyValuePair($key, $value);
        $dataSource = new Id($id);

        $this->api->deleteDataSource(
            $id, $dataSource, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteDataSourceRequest id="' . $id . '">'
                        . '<urn1:dataSource id="' . $id . '" />'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:DeleteDataSourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
