<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\PurgeAccountCalendarCache;

/**
 * Testcase class for PurgeAccountCalendarCache.
 */
class PurgeAccountCalendarCacheTest extends ZimbraAdminApiTestCase
{
    public function testPurgeAccountCalendarCacheRequest()
    {
        $id = $this->faker->word;
        $req = new PurgeAccountCalendarCache($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $req->setId($id);
        $this->assertEquals($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PurgeAccountCalendarCacheRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PurgeAccountCalendarCacheRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeAccountCalendarCacheApi()
    {
        $id = $this->faker->word;
        $this->api->purgeAccountCalendarCache($id);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PurgeAccountCalendarCacheRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
