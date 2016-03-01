<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\QueryWaitSet;

/**
 * Testcase class for QueryWaitSet.
 */
class QueryWaitSetTest extends ZimbraAdminApiTestCase
{
    public function testQueryWaitSetRequest()
    {
        $waitSet = $this->faker->word;
        $req = new QueryWaitSet($waitSet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($waitSet, $req->getWaitSet());
        $req->setWaitSet($waitSet);
        $this->assertEquals($waitSet, $req->getWaitSet());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<QueryWaitSetRequest waitSet="' . $waitSet . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'QueryWaitSetRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'waitSet' => $waitSet,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testQueryWaitSetApi()
    {
        $waitSet = $this->faker->word;
        $this->api->queryWaitSet($waitSet);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:QueryWaitSetRequest waitSet="' . $waitSet . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
