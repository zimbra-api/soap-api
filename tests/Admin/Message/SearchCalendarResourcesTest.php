<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SearchCalendarResourcesBody;
use Zimbra\Admin\Message\SearchCalendarResourcesEnvelope;
use Zimbra\Admin\Message\SearchCalendarResourcesRequest;
use Zimbra\Admin\Message\SearchCalendarResourcesResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Admin\Struct\{EntrySearchFilterInfo, EntrySearchFilterMultiCond, EntrySearchFilterSingleCond};
use Zimbra\Common\Enum\ConditionOperator as CondOp;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SearchCalendarResourcesTest.
 */
class SearchCalendarResourcesTest extends ZimbraTestCase
{
    public function testSearchCalendarResources()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $attr = $this->faker->word;
        $domain = $this->faker->domainName;
        $sortBy = $this->faker->word;
        $attrs = $this->faker->word;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $searchTotal = $this->faker->randomNumber;

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQUAL(), $value, TRUE);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GREATER_EQUAL(), $value, FALSE);
        $multiConds = new EntrySearchFilterMultiCond(FALSE, TRUE, [$singleCond]);
        $conds = new EntrySearchFilterMultiCond(TRUE, FALSE, [$cond, $multiConds]);
        $searchFilter = new EntrySearchFilterInfo($conds);

        $request = new SearchCalendarResourcesRequest(
            $searchFilter, $limit, $offset, $domain, FALSE, $sortBy, FALSE, $attrs
        );
        $this->assertSame($searchFilter, $request->getSearchFilter());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($domain, $request->getDomain());
        $this->assertFalse($request->getApplyCos());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertFalse($request->getSortAscending());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new SearchCalendarResourcesRequest();
        $request->setSearchFilter($searchFilter)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setDomain($domain)
            ->setApplyCos(TRUE)
            ->setSortBy($sortBy)
            ->setSortAscending(TRUE)
            ->setAttrs($attrs);
        $this->assertSame($searchFilter, $request->getSearchFilter());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($domain, $request->getDomain());
        $this->assertTrue($request->getApplyCos());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertTrue($request->getSortAscending());
        $this->assertSame($attrs, $request->getAttrs());

        $calResources = new CalendarResourceInfo($name, $id, [new Attr($key, $value)]);

        $response = new SearchCalendarResourcesResponse(
            FALSE, $searchTotal, [$calResources]
        );
        $this->assertFalse($response->getMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$calResources], $response->getCalResources());
        $response = new SearchCalendarResourcesResponse();
        $response->setMore(TRUE)
            ->setSearchTotal($searchTotal)
            ->setCalResources([$calResources]);
        $this->assertTrue($response->getMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$calResources], $response->getCalResources());

        $body = new SearchCalendarResourcesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SearchCalendarResourcesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SearchCalendarResourcesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SearchCalendarResourcesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SearchCalendarResourcesRequest limit="$limit" offset="$offset" domain="$domain" applyCos="true" sortBy="$sortBy" sortAscending="true" attrs="$attrs">
            <urn:searchFilter>
                <urn:conds not="true" or="false">
                    <urn:conds not="false" or="true">
                        <urn:cond attr="$attr" op="ge" value="$value" not="false" />
                    </urn:conds>
                    <urn:cond attr="$attr" op="eq" value="$value" not="true" />
                </urn:conds>
            </urn:searchFilter>
        </urn:SearchCalendarResourcesRequest>
        <urn:SearchCalendarResourcesResponse more="true" searchTotal="$searchTotal">
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:SearchCalendarResourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchCalendarResourcesEnvelope::class, 'xml'));
    }
}
