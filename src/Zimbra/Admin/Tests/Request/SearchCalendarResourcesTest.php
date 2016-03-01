<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SearchCalendarResources;
use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Struct\EntrySearchFilterInfo as FilterInfo;

/**
 * Testcase class for SearchCalendarResources.
 */
class SearchCalendarResourcesTest extends ZimbraAdminApiTestCase
{
    public function testSearchCalendarResourcesRequest()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;
        $domain = $this->faker->word;
        $sortBy = $this->faker->word;
        $attrs = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $cond = new SingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new SingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new MultiCond(false, true, [$singleCond]);
        $conds = new MultiCond(true, false, [$cond, $multiConds]);
        $searchFilter = new FilterInfo($conds);
        
        $req = new SearchCalendarResources(
            $searchFilter, $limit, $offset, $domain, false, $sortBy, true, [$attrs]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($searchFilter, $req->getSearchFilter());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertFalse($req->getApplyCos());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertTrue($req->getSortAscending());

        $req->setSearchFilter($searchFilter)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setDomain($domain)
            ->setApplyCos(true)
            ->setSortBy($sortBy)
            ->setSortAscending(false);
        $this->assertEquals($searchFilter, $req->getSearchFilter());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertTrue($req->getApplyCos());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertFalse($req->getSortAscending());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchCalendarResourcesRequest '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'domain="' . $domain . '" '
                . 'applyCos="true" '
                . 'sortBy="' . $sortBy . '" '
                . 'sortAscending="false" '
                . 'attrs="' . $attrs . '">'
                . '<searchFilter>'
                    . '<conds not="true" or="false">'
                        . '<conds not="false" or="true">'
                            . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                        . '</conds>'
                        . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                    . '</conds>'
                . '</searchFilter>'
            . '</SearchCalendarResourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchCalendarResourcesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'limit' => $limit,
                'offset' => $offset,
                'domain' => $domain,
                'applyCos' => true,
                'sortBy' => $sortBy,
                'sortAscending' => false,
                'attrs' => $attrs,
                'searchFilter' => [
                    'conds' => [
                        'not' => true,
                        'or' => false,
                        'conds' => [
                            [
                                'not' => false,
                                'or' => true,
                                'cond' => [
                                    [
                                        'attr' => $attr,
                                        'op' => CondOp::GE()->value(),
                                        'value' => $value,
                                        'not' => false,
                                    ],
                                ],
                            ],
                        ],
                        'cond' => [
                            [
                                'attr' => $attr,
                                'op' => CondOp::EQ()->value(),
                                'value' => $value,
                                'not' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchCalendarResourcesApi()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;
        $domain = $this->faker->word;
        $sortBy = $this->faker->word;
        $attrs = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $cond = new SingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new SingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new MultiCond(false, true, [$singleCond]);
        $conds = new MultiCond(true, false, [$cond, $multiConds]);
        $searchFilter = new FilterInfo($conds);

        $this->api->searchCalendarResources(
            $searchFilter, $limit, $offset, $domain, true, $sortBy, false, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchCalendarResourcesRequest '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'domain="' . $domain . '" '
                        . 'applyCos="true" '
                        . 'sortBy="' . $sortBy . '" '
                        . 'sortAscending="false" '
                        . 'attrs="' . $attrs . '">'
                        . '<urn1:searchFilter>'
                            . '<urn1:conds not="true" or="false">'
                                . '<urn1:conds not="false" or="true">'
                                    . '<urn1:cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                                . '</urn1:conds>'
                                . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                            . '</urn1:conds>'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchCalendarResourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $searchFilter = new FilterInfo($cond);
        $this->api->searchCalendarResources(
            $searchFilter, $limit, $offset, $domain, true, $sortBy, false, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchCalendarResourcesRequest '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'domain="' . $domain . '" '
                        . 'applyCos="true" '
                        . 'sortBy="' . $sortBy . '" '
                        . 'sortAscending="false" '
                        . 'attrs="' . $attrs . '">'
                        . '<urn1:searchFilter>'
                            . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchCalendarResourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
