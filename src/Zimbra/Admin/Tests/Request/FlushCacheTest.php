<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\FlushCache;
use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Admin\Struct\CacheSelector;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Enum\CacheType;

/**
 * Testcase class for FlushCache.
 */
class FlushCacheTest extends ZimbraAdminApiTestCase
{
    public function testFlushCacheRequest()
    {
        $value = $this->faker->word;
        $enums = $this->faker->randomElements(CacheType::enums(), mt_rand(1, count(CacheType::enums())));
        $types = implode(',', $enums);

        $entry = new CacheEntrySelector(CacheEntryBy::NAME(), $value);
        $cache = new CacheSelector($types, true, [$entry]);

        $req = new FlushCache($cache);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cache, $req->getCache());
        $req->setCache($cache);
        $this->assertSame($cache, $req->getCache());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<FlushCacheRequest>'
                . '<cache type="' . $types . '" allServers="true">'
                    . '<entry by="' . CacheEntryBy::NAME() . '">' . $value . '</entry>'
                . '</cache>'
            . '</FlushCacheRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'FlushCacheRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cache' => [
                    'type' => $types,
                    'allServers' => true,
                    'entry' => [
                        [
                            'by' => CacheEntryBy::NAME()->value(),
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testFlushCacheApi()
    {
        $value = $this->faker->word;
        $enums = $this->faker->randomElements(CacheType::enums(), mt_rand(1, count(CacheType::enums())));
        $types = implode(',', $enums);

        $entry = new CacheEntrySelector(CacheEntryBy::NAME(), $value);
        $cache = new CacheSelector($types, true, [$entry]);

        $this->api->flushCache(
            $cache
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:FlushCacheRequest>'
                        . '<urn1:cache type="' . $types . '" allServers="true">'
                            . '<urn1:entry by="' . CacheEntryBy::NAME() . '">' . $value . '</urn1:entry>'
                        . '</urn1:cache>'
                    . '</urn1:FlushCacheRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
