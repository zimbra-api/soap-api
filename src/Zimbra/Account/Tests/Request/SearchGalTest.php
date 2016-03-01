<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\SearchGal;
use Zimbra\Struct\CursorInfo;
use Zimbra\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Struct\EntrySearchFilterInfo as FilterInfo;
use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Enum\GalSearchType as SearchType;
use Zimbra\Enum\MemberOfSelector as MemberOf;
use Zimbra\Enum\SortBy;

/**
 * Testcase class for SearchGal.
 */
class SearchGalTest extends ZimbraAccountApiTestCase
{
    public function testSearchGalRequest()
    {
        $id = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;
        $cursor = new CursorInfo($id,$sortVal, $endSortVal, true);

        $attr = $this->faker->word;
        $value = $this->faker->word;
        $cond = new SingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new SingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new MultiCond(false, true, [$singleCond]);
        $conds = new MultiCond(true, false, [$cond, $multiConds]);
        $filter = new FilterInfo($conds);

        $locale = $this->faker->word;
        $ref = $this->faker->word;
        $name = $this->faker->word;
        $galAcctId = $this->faker->word;
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $req = new SearchGal(
            $locale, $cursor, $filter, $ref, $name, SearchType::ALL(),
            true, false, MemberOf::ALL(), true, $galAcctId, false, SortBy::NONE(), $limit, $offset
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($cursor, $req->getCursor());
        $this->assertSame($filter, $req->getSearchFilter());
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($ref, $req->getRef());
        $this->assertSame($name, $req->getName());
        $this->assertSame('all', $req->getType()->value());
        $this->assertTrue($req->getNeedExp());
        $this->assertFalse($req->getNeedIsOwner());
        $this->assertSame('all', $req->getNeedIsMember()->value());
        $this->assertTrue($req->getNeedSMIMECerts());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertFalse($req->getQuick());
        $this->assertSame('none', $req->getSortBy()->value());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setLocale($locale)
            ->setCursor($cursor)
            ->setSearchFilter($filter)
            ->setRef($ref)
            ->setName($name)
            ->setType(SearchType::ACCOUNT())
            ->setNeedExp(true)
            ->setNeedIsOwner(true)
            ->setNeedIsMember(MemberOf::DIRECT_ONLY())
            ->setNeedSMIMECerts(true)
            ->setGalAccountId($galAcctId)
            ->setQuick(true)
            ->setSortBy(SortBy::DATE_ASC())
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($cursor, $req->getCursor());
        $this->assertSame($filter, $req->getSearchFilter());
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($ref, $req->getRef());
        $this->assertSame($name, $req->getName());
        $this->assertSame('account', $req->getType()->value());
        $this->assertTrue($req->getNeedExp());
        $this->assertTrue($req->getNeedIsOwner());
        $this->assertSame('directOnly', $req->getNeedIsMember()->value());
        $this->assertTrue($req->getNeedSMIMECerts());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertTrue($req->getQuick());
        $this->assertSame('dateAsc', $req->getSortBy()->value());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchGalRequest ref="' . $ref . '" name="' . $name . '" type="' . SearchType::ACCOUNT() . '" needExp="true" needIsOwner="true" needIsMember="' . MemberOf::DIRECT_ONLY() . '" needSMIMECerts="true" galAcctId="' . $galAcctId . '" quick="true" sortBy="' . SortBy::DATE_ASC() . '" limit="' . $limit . '" offset="' . $offset . '">'
                . '<locale>' . $locale . '</locale>'
                . '<cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                . '<searchFilter>'
                    . '<conds not="true" or="false">'
                        . '<conds not="false" or="true">'
                            . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                        . '</conds>'
                        . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                    . '</conds>'
                . '</searchFilter>'
            . '</SearchGalRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchGalRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'locale' => $locale,
                'ref' => $ref,
                'name' => $name,
                'type' => SearchType::ACCOUNT()->value(),
                'needExp' => true,
                'needIsOwner' => true,
                'needIsMember' => MemberOf::DIRECT_ONLY()->value(),
                'needSMIMECerts' => true,
                'galAcctId' => $galAcctId,
                'quick' => true,
                'sortBy' => SortBy::DATE_ASC()->value(),
                'limit' => $limit,
                'offset' => $offset,
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

    public function testSearchGalApi()
    {
        $id = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;
        $cursor = new CursorInfo($id,$sortVal, $endSortVal, true);

        $attr = $this->faker->word;
        $value = $this->faker->word;
        $cond = new SingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new SingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new MultiCond(false, true, [$singleCond]);
        $conds = new MultiCond(true, false, [$cond, $multiConds]);
        $filter = new FilterInfo($conds);

        $locale = $this->faker->word;
        $ref = $this->faker->word;
        $name = $this->faker->word;
        $galAcctId = $this->faker->word;
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $this->api->searchGal(
            $locale, $cursor, $filter, $ref, $name, SearchType::ALL(),
            true, false, MemberOf::ALL(), true, $galAcctId, false, SortBy::NONE(), $limit, $offset
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SearchGalRequest ref="' . $ref . '" name="' . $name . '" type="' . SearchType::ALL() . '" needExp="true" needIsOwner="false" needIsMember="' . MemberOf::ALL() . '" needSMIMECerts="true" galAcctId="' . $galAcctId . '" quick="false" sortBy="' . SortBy::NONE() . '" limit="' . $limit . '" offset="' . $offset . '">'
                        . '<urn1:locale>' . $locale . '</urn1:locale>'
                        . '<urn1:cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                        . '<urn1:searchFilter>'
                            . '<urn1:conds not="true" or="false">'
                                . '<urn1:conds not="false" or="true">'
                                    . '<urn1:cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                                . '</urn1:conds>'
                                . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                            . '</urn1:conds>'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchGalRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $filter = new FilterInfo($cond);
        $this->api->searchGal(
            $locale, $cursor, $filter, $ref, $name, SearchType::ALL(),
            true, false, MemberOf::ALL(), true, $galAcctId, false, SortBy::NONE(), $limit, $offset
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SearchGalRequest ref="' . $ref . '" name="' . $name . '" type="' . SearchType::ALL() . '" needExp="true" needIsOwner="false" needIsMember="' . MemberOf::ALL() . '" needSMIMECerts="true" galAcctId="' . $galAcctId . '" quick="false" sortBy="' . SortBy::NONE() . '" limit="' . $limit . '" offset="' . $offset . '">'
                        . '<urn1:locale>' . $locale . '</urn1:locale>'
                        . '<urn1:cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                        . '<urn1:searchFilter>'
                            . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchGalRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
