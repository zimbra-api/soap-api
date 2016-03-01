<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CheckGalConfig;
use Zimbra\Admin\Struct\LimitedQuery;
use Zimbra\Enum\GalConfigAction;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CheckGalConfig.
 */
class CheckGalConfigTest extends ZimbraAdminApiTestCase
{
    public function testCheckGalConfigRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $attr = new KeyValuePair($key, $value);
        $query = new LimitedQuery($limit, $value);

        $req = new CheckGalConfig($query, GalConfigAction::AUTOCOMPLETE(), [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($query, $req->getQuery());
        $this->assertTrue($req->getAction()->is('autocomplete'));

        $req->setQuery($query)
            ->setAction(GalConfigAction::SEARCH());
        $this->assertSame($query, $req->getQuery());
        $this->assertTrue($req->getAction()->is('search'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckGalConfigRequest>'
                . '<query limit="'. $limit . '">' . $value . '</query>'
                . '<action>' . GalConfigAction::SEARCH() . '</action>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckGalConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckGalConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'query' => [
                    'limit' => $limit,
                    '_content' => $value,
                ],
                'action' => 'search',
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

    public function testCheckGalConfigApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $attr = new KeyValuePair($key, $value);
        $query = new LimitedQuery($limit, $value);

        $this->api->checkGalConfig(
            $query, GalConfigAction::SEARCH(), [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckGalConfigRequest>'
                        . '<urn1:query limit="' . $limit . '">' . $value . '</urn1:query>'
                        . '<urn1:action>' . GalConfigAction::SEARCH() . '</urn1:action>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CheckGalConfigRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
