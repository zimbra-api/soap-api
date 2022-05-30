<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetLDAPEntriesBody;
use Zimbra\Admin\Message\GetLDAPEntriesEnvelope;
use Zimbra\Admin\Message\GetLDAPEntriesRequest;
use Zimbra\Admin\Message\GetLDAPEntriesResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\LDAPEntryInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetLDAPEntriesTest.
 */
class GetLDAPEntriesTest extends ZimbraTestCase
{
    public function testGetLDAPEntries()
    {
        $ldapSearchBase = $this->faker->word;
        $sortBy = $this->faker->word;
        $query = $this->faker->word;
        $limit = mt_rand(1, 100);
        $offset = mt_rand(1, 100);
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $LDAPEntry = new LDAPEntryInfo($name, [$attr]);

        $request = new GetLDAPEntriesRequest(
            $ldapSearchBase, $sortBy, FALSE, $limit, $offset, $query
        );
        $this->assertSame($ldapSearchBase, $request->getLdapSearchBase());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertFalse($request->getSortAscending());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($query, $request->getQuery());

        $request = new GetLDAPEntriesRequest('');
        $request->setLdapSearchBase($ldapSearchBase)
            ->setSortBy($sortBy)
            ->setSortAscending(TRUE)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setQuery($query);
        $this->assertSame($ldapSearchBase, $request->getLdapSearchBase());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertTrue($request->getSortAscending());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($query, $request->getQuery());

        $response = new GetLDAPEntriesResponse([$LDAPEntry]);
        $this->assertSame([$LDAPEntry], $response->getLDAPentries());

        $response = new GetLDAPEntriesResponse();
        $response->setLDAPentries([$LDAPEntry])
            ->addLDAPentry($LDAPEntry);
        $this->assertSame([$LDAPEntry, $LDAPEntry], $response->getLDAPentries());
        $response->setLDAPentries([$LDAPEntry]);

        $body = new GetLDAPEntriesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetLDAPEntriesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetLDAPEntriesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetLDAPEntriesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetLDAPEntriesRequest sortBy="$sortBy" sortAscending="true" limit="$limit" offset="$offset" query="$query">
            <ldapSearchBase>$ldapSearchBase</ldapSearchBase>
        </urn:GetLDAPEntriesRequest>
        <urn:GetLDAPEntriesResponse>
            <LDAPEntry name="$name">
                <a n="$key">$value</a>
            </LDAPEntry>
        </urn:GetLDAPEntriesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetLDAPEntriesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetLDAPEntriesRequest' => [
                    'ldapSearchBase' => [
                        '_content' => $ldapSearchBase,
                    ],
                    'sortBy' => $sortBy,
                    'sortAscending' => TRUE,
                    'limit' => $limit,
                    'offset' => $offset,
                    'query' => $query,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetLDAPEntriesResponse' => [
                    'LDAPEntry' => [
                        [
                            'name' => $name,
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetLDAPEntriesEnvelope::class, 'json'));
    }
}
