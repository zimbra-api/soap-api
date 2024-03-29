<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SearchAutoProvDirectoryBody;
use Zimbra\Admin\Message\SearchAutoProvDirectoryEnvelope;
use Zimbra\Admin\Message\SearchAutoProvDirectoryRequest;
use Zimbra\Admin\Message\SearchAutoProvDirectoryResponse;

use Zimbra\Admin\Struct\AutoProvDirectoryEntry;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Common\Enum\DomainBy;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SearchAutoProvDirectoryTest.
 */
class SearchAutoProvDirectoryTest extends ZimbraTestCase
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
        $maxResults = $this->faker->randomNumber;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $attrs = $this->faker->word;
        $searchTotal = $this->faker->randomNumber;
        $domain = new DomainSelector(DomainBy::NAME, $value);

        $request = new SearchAutoProvDirectoryRequest(
            $domain, $keyAttr, $query, $name, $maxResults, $limit, $offset, FALSE, $attrs
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

        $request = new SearchAutoProvDirectoryRequest(new DomainSelector());
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
        $response = new SearchAutoProvDirectoryResponse();
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
            <urn:domain by="name">$value</urn:domain>
        </urn:SearchAutoProvDirectoryRequest>
        <urn:SearchAutoProvDirectoryResponse more="true" searchTotal="$searchTotal">
            <urn:entry dn="$dn">
                <urn:a n="$key">$value</urn:a>
                <urn:key>$key</urn:key>
            </urn:entry>
        </urn:SearchAutoProvDirectoryResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchAutoProvDirectoryEnvelope::class, 'xml'));
    }
}
