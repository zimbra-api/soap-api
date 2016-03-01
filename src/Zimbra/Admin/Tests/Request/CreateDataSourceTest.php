<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateDataSource;
use Zimbra\Admin\Struct\DataSourceSpecifier;
use Zimbra\Enum\DataSourceType;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateDataSource.
 */
class CreateDataSourceTest extends ZimbraAdminApiTestCase
{
    public function testCreateDataSourceRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $dataSource = new DataSourceSpecifier(DataSourceType::POP3(), $name, [$attr]);

        $req = new CreateDataSource($id, $dataSource);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $req->setId($id)
            ->setDataSource($dataSource);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDataSourceRequest id="' . $id . '">'
                . '<dataSource type="' . DataSourceType::POP3() . '" name="' . $name . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</dataSource>'
            . '</CreateDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateDataSourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'dataSource' => [
                    'type' => DataSourceType::POP3(),
                    'name' => $name,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDataSourceApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;
        $attr = new KeyValuePair($key, $value);
        $dataSource = new DataSourceSpecifier(DataSourceType::POP3(), $name, [$attr]);

        $this->api->createDataSource(
            $id, $dataSource
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateDataSourceRequest id="' . $id . '">'
                        . '<urn1:dataSource type="' . DataSourceType::POP3() . '" name="' . $name . '">'
                            . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                        . '</urn1:dataSource>'
                    . '</urn1:CreateDataSourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
