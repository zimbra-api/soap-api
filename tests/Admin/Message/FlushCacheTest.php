<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\FlushCacheBody;
use Zimbra\Admin\Message\FlushCacheEnvelope;
use Zimbra\Admin\Message\FlushCacheRequest;
use Zimbra\Admin\Message\FlushCacheResponse;
use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Admin\Struct\CacheSelector;
use Zimbra\Common\Enum\CacheEntryBy;
use Zimbra\Common\Enum\CacheType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FlushCache.
 */
class FlushCacheTest extends ZimbraTestCase
{
    public function testFlushCache()
    {
        $value = $this->faker->word;
        $enums = $this->faker->randomElements(CacheType::cases(), mt_rand(1, count(CacheType::cases())));
        $types = implode(',', array_map(fn ($type) => $type->value, $enums));

        $entry = new CacheEntrySelector(CacheEntryBy::ID, $value);
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

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:FlushCacheRequest>
            <urn:cache type="$types" allServers="true" imapServers="true">
                <urn:entry by="id">$value</urn:entry>
            </urn:cache>
        </urn:FlushCacheRequest>
        <urn:FlushCacheResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FlushCacheEnvelope::class, 'xml'));
    }
}
