<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAdminSavedSearches;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for GetAdminSavedSearches.
 */
class GetAdminSavedSearchesTest extends ZimbraAdminApiTestCase
{
    public function testGetAdminSavedSearchesRequest()
    {
        $name = $this->faker->word;
        $search = new NamedElement($name);
        $req = new GetAdminSavedSearches([$search]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$search], $req->getSearches()->all());

        $req->addSearch($search);
        $this->assertSame([$search, $search], $req->getSearches()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAdminSavedSearchesRequest>'
                . '<search name="' . $name . '" />'
                . '<search name="' . $name . '" />'
            . '</GetAdminSavedSearchesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAdminSavedSearchesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'search' => [
                    [
                        'name' => $name,
                    ],
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAdminSavedSearchesApi()
    {
        $name = $this->faker->word;
        $search = new NamedElement($name);

        $this->api->getAdminSavedSearches(
            [$search]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAdminSavedSearchesRequest>'
                        . '<urn1:search name="' . $name . '" />'
                    . '</urn1:GetAdminSavedSearchesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
