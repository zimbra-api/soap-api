<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ModifyConfig;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for ModifyConfig.
 */
class ModifyConfigTest extends ZimbraAdminApiTestCase
{
    public function testModifyConfigRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new ModifyConfig([$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyConfigRequest>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
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

    public function testModifyConfigApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->modifyConfig(
            [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyConfigRequest>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyConfigRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
