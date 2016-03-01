<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ModifyAdminSavedSearches;
use Zimbra\Struct\NamedValue;

/**
 * Testcase class for ModifyAdminSavedSearches.
 */
class ModifyAdminSavedSearchesTest extends ZimbraAdminApiTestCase
{
    public function testModifyAdminSavedSearchesRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $search = new NamedValue($name, $value);
        $req = new ModifyAdminSavedSearches([$search]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$search], $req->getSearches()->all());

        $req->addSearch($search);
        $this->assertSame([$search, $search], $req->getSearches()->all());
        $req->getSearches()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyAdminSavedSearchesRequest>'
                . '<search name="' . $name . '">' . $value . '</search>'
            . '</ModifyAdminSavedSearchesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyAdminSavedSearchesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'search' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyAdminSavedSearchesApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $search = new NamedValue($name, $value);

        $this->api->modifyAdminSavedSearches(
            [$search]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyAdminSavedSearchesRequest>'
                        . '<urn1:search name="' . $name . '">' . $value . '</urn1:search>'
                    . '</urn1:ModifyAdminSavedSearchesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
