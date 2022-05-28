<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SearchCalendarResourcesBody;
use Zimbra\Admin\Message\SearchCalendarResourcesEnvelope;
use Zimbra\Admin\Message\SearchCalendarResourcesRequest;
use Zimbra\Admin\Message\SearchCalendarResourcesResponse;

use Zimbra\Common\SerializerFactory;
use Zimbra\Admin\SerializerHandler;

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
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

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
        $limit = mt_rand(1, 100);
        $offset = mt_rand(1, 100);
        $searchTotal = mt_rand(1, 100);

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, TRUE);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, FALSE);
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
        $response = new SearchCalendarResourcesResponse(FALSE, 0);
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
            <searchFilter>
                <conds not="true" or="false">
                    <conds not="false" or="true">
                        <cond attr="$attr" op="ge" value="$value" not="false" />
                    </conds>
                    <cond attr="$attr" op="eq" value="$value" not="true" />
                </conds>
            </searchFilter>
        </urn:SearchCalendarResourcesRequest>
        <urn:SearchCalendarResourcesResponse more="true" searchTotal="$searchTotal">
            <calresource name="$name" id="$id">
                <a n="$key">$value</a>
            </calresource>
        </urn:SearchCalendarResourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchCalendarResourcesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'SearchCalendarResourcesRequest' => [
                    'limit' => $limit,
                    'offset' => $offset,
                    'domain' => $domain,
                    'applyCos' => TRUE,
                    'sortBy' => $sortBy,
                    'sortAscending' => TRUE,
                    'attrs' => $attrs,
                    'searchFilter' => [
                        'conds' => [
                            'not' => TRUE,
                            'or' => FALSE,
                            'conds' => [
                                [
                                    'not' => FALSE,
                                    'or' => TRUE,
                                    'cond' => [
                                        [
                                            'attr' => $attr,
                                            'op' => 'ge',
                                            'value' => $value,
                                            'not' => FALSE,
                                        ],
                                    ],
                                ],
                            ],
                            'cond' => [
                                [
                                    'attr' => $attr,
                                    'op' => 'eq',
                                    'value' => $value,
                                    'not' => TRUE,
                                ],
                            ],
                        ]
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'SearchCalendarResourcesResponse' => [
                    'more' => TRUE,
                    'searchTotal' => $searchTotal,
                    'calresource' => [
                        [
                            'name' => $name,
                            'id' => $id,
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, SearchCalendarResourcesEnvelope::class, 'json'));
    }
}
