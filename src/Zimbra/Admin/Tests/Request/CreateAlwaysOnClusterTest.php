<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateAlwaysOnCluster;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateAlwaysOnCluster.
 */
class CreateAlwaysOnClusterTest extends ZimbraAdminApiTestCase
{
    public function testCreateAlwaysOnClusterRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new CreateAlwaysOnCluster($name, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());

        $req->setName($name);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAlwaysOnClusterRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateAlwaysOnClusterRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateAlwaysOnClusterRequest' => [
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

    public function testCreateAlwaysOnClusterApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->createAlwaysOnCluster(
            $name, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateAlwaysOnClusterRequest name="' . $name . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateAlwaysOnClusterRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
