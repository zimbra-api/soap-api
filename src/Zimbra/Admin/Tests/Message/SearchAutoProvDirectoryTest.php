<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\SearchAutoProvDirectoryBody;
use Zimbra\Admin\Message\SearchAutoProvDirectoryEnvelope;
use Zimbra\Admin\Message\SearchAutoProvDirectoryRequest;
use Zimbra\Admin\Message\SearchAutoProvDirectoryResponse;

use Zimbra\Admin\Struct\AutoProvDirectoryEntry;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SearchAutoProvDirectoryTest.
 */
class SearchAutoProvDirectoryTest extends ZimbraStructTestCase
{
    public function testSearchAutoProvDirectory()
    {
        $dn = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $keyAttr = $this->faker->word;

        $query = $this->faker->word;
        $maxResults = mt_rand(1, 100);
        $limit = mt_rand(1, 100);
        $offset = mt_rand(1, 100);
        $attrs = $this->faker->word;
        $searchTotal = mt_rand(1, 100);
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $request = new SearchAutoProvDirectoryRequest(
            $keyAttr, $domain, $query, $name, $maxResults, $limit, $offset, FALSE, $attrs
        );
        $this->assertSame($keyAttr, $request->getKeyAttr());
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($query, $request->getQuery());
        $this->assertSame($name, $request->getName());
        $this->assertSame($maxResults, $request->getMaxResults());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertFalse($request->isRefresh());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new SearchAutoProvDirectoryRequest('', new DomainSelector(DomainBy::NAME(), ''));
        $request->setKeyAttr($keyAttr)
            ->setDomain($domain)
            ->setQuery($query)
            ->setName($name)
            ->setMaxResults($maxResults)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setRefresh(TRUE)
            ->setAttrs($attrs);
        $this->assertSame($keyAttr, $request->getKeyAttr());
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($query, $request->getQuery());
        $this->assertSame($name, $request->getName());
        $this->assertSame($maxResults, $request->getMaxResults());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertTrue($request->isRefresh());
        $this->assertSame($attrs, $request->getAttrs());

        $entry = new AutoProvDirectoryEntry($dn, [$key], [new KeyValuePair($key, $value)]);

        $response = new SearchAutoProvDirectoryResponse(
            FALSE, $searchTotal, [$entry]
        );
        $this->assertFalse($response->getMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$entry], $response->getEntries());
        $response = new SearchAutoProvDirectoryResponse(FALSE, 0);
        $response->setMore(TRUE)
            ->setSearchTotal($searchTotal)
            ->setEntries([$entry]);
        $this->assertTrue($response->getMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$entry], $response->getEntries());

        $body = new SearchAutoProvDirectoryBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SearchAutoProvDirectoryBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SearchAutoProvDirectoryEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SearchAutoProvDirectoryEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SearchAutoProvDirectoryRequest keyAttr="$keyAttr" query="$query" name="$name" maxResults="$maxResults" limit="$limit" offset="$offset" refresh="true" attrs="$attrs">
            <domain by="name">$value</domain>
        </urn:SearchAutoProvDirectoryRequest>
        <urn:SearchAutoProvDirectoryResponse more="true" searchTotal="$searchTotal">
            <entry dn="$dn">
                <a n="$key">$value</a>
                <key>$key</key>
            </entry>
        </urn:SearchAutoProvDirectoryResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchAutoProvDirectoryEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'SearchAutoProvDirectoryRequest' => [
                    'keyAttr' => $keyAttr,
                    'query' => $query,
                    'name' => $name,
                    'maxResults' => $maxResults,
                    'limit' => $limit,
                    'offset' => $offset,
                    'refresh' => TRUE,
                    'attrs' => $attrs,
                    'domain' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'SearchAutoProvDirectoryResponse' => [
                    'more' => TRUE,
                    'searchTotal' => $searchTotal,
                    'entry' => [
                        [
                            'dn' => $dn,
                            'key' => [
                                [
                                    '_content' => $key,
                                ],
                            ],
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, SearchAutoProvDirectoryEnvelope::class, 'json'));
    }
}
