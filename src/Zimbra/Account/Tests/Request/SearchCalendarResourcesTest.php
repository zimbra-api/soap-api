<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\SearchCalendarResources;
use Zimbra\Struct\CursorInfo;
use Zimbra\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Struct\EntrySearchFilterInfo as FilterInfo;
use Zimbra\Enum\ConditionOperator as CondOp;

/**
 * Testcase class for SearchCalendarResources.
 */
class SearchCalendarResourcesTest extends ZimbraAccountApiTestCase
{
    public function testSearchCalendarResourcesRequest()
    {
        $id = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;
        $cursor = new CursorInfo($id, $sortVal, $endSortVal, true);

        $attr = $this->faker->word;
        $value = $this->faker->word;
        $cond = new SingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new SingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new MultiCond(false, true, [$singleCond]);
        $conds = new MultiCond(true, false, [$cond, $multiConds]);
        $filter = new FilterInfo($conds);

        $locale = $this->faker->word;
        $name = $this->faker->word;
        $sortBy = $this->faker->word;
        $galAcctId = $this->faker->word;
        $attrs = $this->faker->word;
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $req = new SearchCalendarResources(
            $locale, $cursor, $name, $filter, false, $sortBy, $limit, $offset, $galAcctId, [$attrs]
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($cursor, $req->getCursor());
        $this->assertSame($name, $req->getName());
        $this->assertSame($filter, $req->getSearchFilter());
        $this->assertFalse($req->getQuick());
        $this->assertSame($sortBy, $req->getSortBy());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame($galAcctId, $req->getGalAccountId());

        $req->setLocale($locale)
            ->setCursor($cursor)
            ->setName($name)
            ->setSearchFilter($filter)
            ->setQuick(true)
            ->setSortBy($sortBy)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setGalAccountId($galAcctId);
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($cursor, $req->getCursor());
        $this->assertSame($name, $req->getName());
        $this->assertSame($filter, $req->getSearchFilter());
        $this->assertTrue($req->getQuick());
        $this->assertSame($sortBy, $req->getSortBy());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame($galAcctId, $req->getGalAccountId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchCalendarResourcesRequest quick="true" sortBy="' . $sortBy . '" limit="' . $limit . '" offset="' . $offset . '" galAcctId="' . $galAcctId . '" attrs="' . $attrs . '">'
                . '<locale>' . $locale . '</locale>'
                . '<cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                . '<name>' . $name . '</name>'
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
                '_jsns' => 'urn:zimbraAccount',
                'name' => $name,
                'locale' => $locale,
                'quick' => true,
                'sortBy' => $sortBy,
                'limit' => $limit,
                'offset' => $offset,
                'galAcctId' => $galAcctId,
                'attrs' => $attrs,
                'cursor' => [
                    'id' => $id,
                    'sortVal' => $sortVal,
                    'endSortVal' => $endSortVal,
                    'includeOffset' => true,
                ],
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
        $id = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;
        $cursor = new CursorInfo($id, $sortVal, $endSortVal, true);

        $attr = $this->faker->word;
        $value = $this->faker->word;
        $cond = new SingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new SingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new MultiCond(false, true, [$singleCond]);
        $conds = new MultiCond(true, false, [$cond, $multiConds]);
        $filter = new FilterInfo($conds);

        $locale = $this->faker->word;
        $name = $this->faker->word;
        $sortBy = $this->faker->word;
        $galAcctId = $this->faker->word;
        $attrs = $this->faker->word;
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $this->api->searchCalendarResources(
            $locale, $cursor, $name, $filter, true, $sortBy, $limit, $offset, $galAcctId, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SearchCalendarResourcesRequest quick="true" sortBy="' . $sortBy . '" limit="' . $limit . '" offset="' . $offset . '" galAcctId="' . $galAcctId . '" attrs="' . $attrs . '">'
                        . '<urn1:locale>' . $locale . '</urn1:locale>'
                        . '<urn1:cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                        . '<urn1:name>' . $name . '</urn1:name>'
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

        $filter = new FilterInfo($cond);
        $this->api->searchCalendarResources(
            $locale, $cursor, $name, $filter, true, $sortBy, $limit, $offset, $galAcctId, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SearchCalendarResourcesRequest quick="true" sortBy="' . $sortBy . '" limit="' . $limit . '" offset="' . $offset . '" galAcctId="' . $galAcctId . '" attrs="' . $attrs . '">'
                        . '<urn1:locale>' . $locale . '</urn1:locale>'
                        . '<urn1:cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                        . '<urn1:name>' . $name . '</urn1:name>'
                        . '<urn1:searchFilter>'
                            . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchCalendarResourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
