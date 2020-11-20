<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\FlushCacheBody;
use Zimbra\Admin\Message\FlushCacheEnvelope;
use Zimbra\Admin\Message\FlushCacheRequest;
use Zimbra\Admin\Message\FlushCacheResponse;
use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Admin\Struct\CacheSelector;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Enum\CacheType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FlushCache.
 */
class FlushCacheTest extends ZimbraStructTestCase
{
    public function testFlushCache()
    {
        $value = $this->faker->word;
        $enums = $this->faker->randomElements(CacheType::toArray(), mt_rand(1, count(CacheType::toArray())));
        $types = implode(',', $enums);

        $entry = new CacheEntrySelector(CacheEntryBy::ID(), $value);
        $cache = new CacheSelector($types, TRUE, TRUE, [$entry]);

        $request = new FlushCacheRequest($cache);
        $this->assertSame($cache, $request->getCache());
        $request = new FlushCacheRequest();
        $request->setCache($cache);
        $this->assertSame($cache, $request->getCache());

        $response = new FlushCacheResponse();

        $body = new FlushCacheBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new FlushCacheBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new FlushCacheEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FlushCacheEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:FlushCacheRequest>'
                        . '<cache type="' . $types . '" allServers="true" imapServers="true">'
                            . '<entry by="' . CacheEntryBy::ID() . '">' . $value . '</entry>'
                        . '</cache>'
                    . '</urn:FlushCacheRequest>'
                    . '<urn:FlushCacheResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FlushCacheEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'FlushCacheRequest' => [
                    'cache' => [
                        'entry' => [
                            [
                                'by' => (string) CacheEntryBy::ID(),
                                '_content' => $value,
                            ],
                        ],
                        'type' => $types,
                        'allServers' => TRUE,
                        'imapServers' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'FlushCacheResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, FlushCacheEnvelope::class, 'json'));
    }
}
