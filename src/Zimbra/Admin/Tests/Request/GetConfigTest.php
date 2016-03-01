<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetConfig;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for GetConfig.
 */
class GetConfigTest extends ZimbraAdminApiTestCase
{
    public function testGetConfigRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new GetConfig($attr);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($attr, $req->getAttr());
        $req->setAttr($attr);
        $this->assertSame($attr, $req->getAttr());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetConfigRequest>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</GetConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'a' => [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetConfigApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->getConfig($attr);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetConfigRequest>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:GetConfigRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
