<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ModifyDataSource;
use Zimbra\Struct\Id;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for ModifyDataSource.
 */
class ModifyDataSourceTest extends ZimbraAdminApiTestCase
{
    public function testModifyDataSourceRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;

        $dataSource = new Id($id);
        $attr = new KeyValuePair($key, $value);
        $req = new ModifyDataSource($id, $dataSource, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $req->setId($id)
            ->setDataSource($dataSource);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyDataSourceRequest id="' . $id . '">'
                . '<dataSource id="' . $id . '" />'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyDataSourceRequest' => [
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

    public function testModifyDataSourceApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $dataSource = new Id($id);
        $attr = new KeyValuePair($key, $value);

        $this->api->modifyDataSource(
            $id, $dataSource, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyDataSourceRequest id="' . $id . '">'
                        . '<urn1:dataSource id="' . $id . '" />'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyDataSourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
