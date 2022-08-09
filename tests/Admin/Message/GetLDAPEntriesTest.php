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
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $LDAPEntry = new LDAPEntryInfo($name, [new Attr($key, $value)]);

        $request = new GetLDAPEntriesRequest(
            $ldapSearchBase, $sortBy, FALSE, $limit, $offset, $query
        );
        $this->assertSame($ldapSearchBase, $request->getLdapSearchBase());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertFalse($request->getSortAscending());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($query, $request->getQuery());

        $request = new GetLDAPEntriesRequest();
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
        $this->assertSame([$LDAPEntry], $response->getLDAPEntries());
        $response = new GetLDAPEntriesResponse();
        $response->setLDAPEntries([$LDAPEntry]);
        $this->assertSame([$LDAPEntry], $response->getLDAPEntries());

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
            <urn:ldapSearchBase>$ldapSearchBase</urn:ldapSearchBase>
        </urn:GetLDAPEntriesRequest>
        <urn:GetLDAPEntriesResponse>
            <urn:LDAPEntry name="$name">
                <urn:a n="$key">$value</urn:a>
            </urn:LDAPEntry>
        </urn:GetLDAPEntriesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetLDAPEntriesEnvelope::class, 'xml'));
    }
}
