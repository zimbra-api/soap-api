<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\SearchCalendarResourcesBody;
use Zimbra\Account\Message\SearchCalendarResourcesEnvelope;
use Zimbra\Account\Message\SearchCalendarResourcesRequest;
use Zimbra\Account\Message\SearchCalendarResourcesResponse;

use Zimbra\Account\Struct\CalendarResourceInfo;
use Zimbra\Account\Struct\{EntrySearchFilterInfo, EntrySearchFilterMultiCond, EntrySearchFilterSingleCond};

use Zimbra\Common\Enum\ConditionOperator as CondOp;

use Zimbra\Common\Struct\CursorInfo;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;


/**
 * Testcase class for SearchCalendarResourcesTest.
 */
class SearchCalendarResourcesTest extends ZimbraTestCase
{
    public function testSearchCalendarResources()
    {
        $sortBy = $this->faker->word;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $locale = $this->faker->word;
        $galAccountId = $this->faker->uuid;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $attr = $this->faker->word;
        $attrs = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;

        $cursor = new CursorInfo($id, $sortVal, $endSortVal, TRUE);

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, TRUE);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, FALSE);
        $multiConds = new EntrySearchFilterMultiCond(FALSE, TRUE, [$singleCond]);
        $conds = new EntrySearchFilterMultiCond(TRUE, FALSE, [$cond, $multiConds]);
        $searchFilter = new EntrySearchFilterInfo($conds);

        $request = new SearchCalendarResourcesRequest(
            $cursor, $searchFilter, FALSE, $sortBy, $limit, $offset, $locale, $galAccountId, $name, $attrs
        );
        $this->assertSame($cursor, $request->getCursor());
        $this->assertSame($searchFilter, $request->getSearchFilter());
        $this->assertFalse($request->getQuick());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($locale, $request->getLocale());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertSame($name, $request->getName());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new SearchCalendarResourcesRequest();
        $request->setCursor($cursor)
            ->setSearchFilter($searchFilter)
            ->setQuick(TRUE)
            ->setSortBy($sortBy)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setLocale($locale)
            ->setGalAccountId($galAccountId)
            ->setName($name)
            ->setAttrs($attrs);
        $this->assertSame($cursor, $request->getCursor());
        $this->assertSame($searchFilter, $request->getSearchFilter());
        $this->assertTrue($request->getQuick());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($locale, $request->getLocale());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertSame($name, $request->getName());
        $this->assertSame($attrs, $request->getAttrs());

        $calResource = new CalendarResourceInfo($name, $id, [new KeyValuePair($key, $value)]);

        $response = new SearchCalendarResourcesResponse($sortBy, $offset, FALSE, FALSE, [$calResource]);
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($offset, $response->getOffset());
        $this->assertFalse($response->getMore());
        $this->assertFalse($response->getPagingSupported());
        $this->assertSame([$calResource], $response->getCalendarResources());

        $response = new SearchCalendarResourcesResponse();
        $response->setCalendarResources([$calResource])
            ->setSortBy($sortBy)
            ->setOffset($offset)
            ->setMore(TRUE)
            ->setPagingSupported(TRUE);
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($offset, $response->getOffset());
        $this->assertTrue($response->getMore());
        $this->assertTrue($response->getPagingSupported());
        $this->assertSame([$calResource], $response->getCalendarResources());

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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:SearchCalendarResourcesRequest quick="true" sortBy="$sortBy" limit="$limit" offset="$offset" galAcctId="$galAccountId" attrs="$attrs">
            <urn:locale>$locale</urn:locale>
            <urn:cursor id="$id" sortVal="$sortVal" endSortVal="$endSortVal" includeOffset="true" />
            <urn:name>$name</urn:name>
            <urn:searchFilter>
                <urn:conds not="true" or="false">
                    <urn:conds not="false" or="true">
                        <urn:cond attr="$attr" op="ge" value="$value" not="false" />
                    </urn:conds>
                    <urn:cond attr="$attr" op="eq" value="$value" not="true" />
                </urn:conds>
            </urn:searchFilter>
        </urn:SearchCalendarResourcesRequest>
        <urn:SearchCalendarResourcesResponse sortBy="$sortBy" offset="$offset" more="true" paginationSupported="true">
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
