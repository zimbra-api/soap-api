<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateDistributionList;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateDistributionList.
 */
class CreateDistributionListTest extends ZimbraAdminApiTestCase
{
    public function testCreateDistributionListRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new CreateDistributionList($name, false, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($name, $req->getName());
        $this->assertFalse($req->getDynamic());

        $req->setName($name)
            ->setDynamic(true);
        $this->assertSame($name, $req->getName());
        $this->assertTrue($req->getDynamic());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDistributionListRequest name="' . $name . '" dynamic="true">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'dynamic' => true,
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

    public function testCreateDistributionListApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->createDistributionList(
            $name, true, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateDistributionListRequest name="' . $name . '" dynamic="true">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
