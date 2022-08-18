<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SearchDirectoryBody;
use Zimbra\Admin\Message\SearchDirectoryEnvelope;
use Zimbra\Admin\Message\SearchDirectoryRequest;
use Zimbra\Admin\Message\SearchDirectoryResponse;

use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\AliasInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\GranteeInfo;

use Zimbra\Common\Enum\TargetType;
use Zimbra\Common\Enum\GranteeType;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SearchDirectoryTest.
 */
class SearchDirectoryTest extends ZimbraTestCase
{
    public function testSearchDirectory()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $member = $this->faker->word;
        $targetName = $this->faker->word;
        $targetType = TargetType::ACCOUNT;

        $query = $this->faker->word;
        $maxResults = $this->faker->randomNumber;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $domain = $this->faker->word;
        $attrs = $this->faker->word;
        $sortBy = $this->faker->word;
        $types = $this->faker->word;
        $searchTotal = $this->faker->randomNumber;
        $num = $this->faker->randomNumber;

        $request = new SearchDirectoryRequest(
            $query, $maxResults, $limit, $offset, $domain, FALSE, FALSE, $sortBy, $types, FALSE, FALSE, $attrs
        );
        $this->assertSame($query, $request->getQuery());
        $this->assertSame($maxResults, $request->getMaxResults());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($domain, $request->getDomain());
        $this->assertFalse($request->getApplyCos());
        $this->assertFalse($request->getApplyConfig());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertSame($types, $request->getTypes());
        $this->assertFalse($request->getSortAscending());
        $this->assertFalse($request->getCountOnly());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new SearchDirectoryRequest();
        $request->setQuery($query)
            ->setMaxResults($maxResults)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setDomain($domain)
            ->setApplyCos(TRUE)
            ->setApplyConfig(TRUE)
            ->setSortBy($sortBy)
            ->setTypes($types)
            ->setSortAscending(TRUE)
            ->setCountOnly(TRUE)
            ->setAttrs($attrs);
        $this->assertSame($query, $request->getQuery());
        $this->assertSame($maxResults, $request->getMaxResults());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($domain, $request->getDomain());
        $this->assertTrue($request->getApplyCos());
        $this->assertTrue($request->getApplyConfig());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertSame($types, $request->getTypes());
        $this->assertTrue($request->getSortAscending());
        $this->assertTrue($request->getCountOnly());
        $this->assertSame($attrs, $request->getAttrs());

        $calResource = new CalendarResourceInfo($name, $id, [new Attr($key, $value)]);
        $dl = new DistributionListInfo(
            $name, $id, [$member], [new Attr($key, $value)], [new GranteeInfo($id, $name, GranteeType::ALL)], TRUE
        );
        $alias = new AliasInfo($name, $id, $targetName, $targetType, [new Attr($key, $value)]);
        $account = new AccountInfo($name, $id, TRUE, [new Attr($key, $value)]);
        $domainInfo = new DomainInfo($name, $id, [new Attr($key, $value)]);
        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, FALSE)]);

        $response = new SearchDirectoryResponse(
            $num, FALSE, $searchTotal, [$calResource], [$dl], [$alias], [$account], [$domainInfo], [$cos]
        );
        $this->assertSame($num, $response->getNum());
        $this->assertFalse($response->isMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$calResource], $response->getCalendarResources());
        $this->assertSame([$dl], $response->getDistributionLists());
        $this->assertSame([$alias], $response->getAliases());
        $this->assertSame([$account], $response->getAccounts());
        $this->assertSame([$domainInfo], $response->getDomains());
        $this->assertSame([$cos], $response->getCOSes());
        $response = new SearchDirectoryResponse();
        $response->setMore(TRUE)
            ->setNum($num)
            ->setSearchTotal($searchTotal)
            ->setCalendarResources([$calResource])
            ->setDistributionLists([$dl])
            ->setAliases([$alias])
            ->setAccounts([$account])
            ->setDomains([$domainInfo])
            ->setCOSes([$cos]);
        $this->assertSame($num, $response->getNum());
        $this->assertTrue($response->isMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$calResource], $response->getCalendarResources());
        $this->assertSame([$dl], $response->getDistributionLists());
        $this->assertSame([$alias], $response->getAliases());
        $this->assertSame([$account], $response->getAccounts());
        $this->assertSame([$domainInfo], $response->getDomains());
        $this->assertSame([$cos], $response->getCOSes());

        $body = new SearchDirectoryBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SearchDirectoryBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SearchDirectoryEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SearchDirectoryEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SearchDirectoryRequest query="$query" maxResults="$maxResults" limit="$limit" offset="$offset" domain="$domain" applyCos="true" applyConfig="true" sortBy="$sortBy" types="$types" sortAscending="true" countOnly="true" attrs="$attrs" />
        <urn:SearchDirectoryResponse num="$num" more="true" searchTotal="$searchTotal">
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:a n="$key">$value</urn:a>
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="all" />
                </urn:owners>
            </urn:dl>
            <urn:alias name="$name" id="$id" targetName="$targetName" type="account">
                <urn:a n="$key">$value</urn:a>
            </urn:alias>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="false">$value</urn:a>
            </urn:cos>
        </urn:SearchDirectoryResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchDirectoryEnvelope::class, 'xml'));
    }
}
