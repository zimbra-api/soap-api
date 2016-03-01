<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\SortBy;
use Zimbra\Mail\Request\Search;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Struct\AttributeName;
use Zimbra\Struct\CursorInfo;

/**
 * Testcase class for Search.
 */
class SearchTest extends ZimbraMailApiTestCase
{
    public function testSearchRequest()
    {
        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $name = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;

        $header = new AttributeName($name);
        $tz = new CalTZInfo($id, $stdoff, $dayoff);
        $cursor = new CursorInfo($id, $sortVal, $endSortVal, true);

        $query = $this->faker->word;
        $locale = $this->faker->word;
        $status = $this->faker->word;
        $start = mt_rand(1, 10);
        $end = mt_rand(1, 10);
        $types = $this->faker->word;
        $groupBy = $this->faker->word;
        $fetch = $this->faker->word;
        $max = mt_rand(1, 10);
        $resultMode = $this->faker->word;
        $field = $this->faker->word;
        $limit = mt_rand(1, 10);
        $offset = mt_rand(1, 10);

        $req = new Search(
            true,
            $query,
            [$header],
            $tz,
            $locale,
            $cursor,
            true,
            true,
            $status,
            $start,
            $end,
            true,
            $types,
            $groupBy,
            true,
            SortBy::NONE(),
            $fetch,
            true,
            $max,
            true,
            true,
            true,
            true,
            true,
            $resultMode,
            true,
            $field,
            $limit,
            $offset
        );
        $this->assertTrue($req->getWarmup());
        $this->assertSame($query, $req->getQuery());
        $this->assertSame([$header], $req->getHeaders()->all());
        $this->assertSame($tz, $req->getCalTz());
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($cursor, $req->getCursor());
        $this->assertTrue($req->getIncludeTagDeleted());
        $this->assertTrue($req->getIncludeTagMuted());
        $this->assertSame($status, $req->getAllowableTaskStatus());
        $this->assertSame($start, $req->getCalExpandInstStart());
        $this->assertSame($end, $req->getCalExpandInstEnd());
        $this->assertTrue($req->getInDumpster());
        $this->assertSame($types, $req->getSearchTypes());
        $this->assertSame($groupBy, $req->getGroupBy());
        $this->assertTrue($req->getQuick());
        $this->assertTrue($req->getSortBy()->is('none'));
        $this->assertSame($fetch, $req->getFetch());
        $this->assertTrue($req->getMarkRead());
        $this->assertSame($max, $req->getMaxInlinedLength());
        $this->assertTrue($req->getWantHtml());
        $this->assertTrue($req->getNeedCanExpand());
        $this->assertTrue($req->getNeuterImages());
        $this->assertTrue($req->getWantRecipients());
        $this->assertTrue($req->getPrefetch());
        $this->assertSame($resultMode, $req->getResultMode());
        $this->assertTrue($req->getFullConversation());
        $this->assertSame($field, $req->getField());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req = new Search();
        $req->setWarmup(true)
            ->setQuery($query)
            ->setHeaders([$header])
            ->addHeader($header)
            ->setCalTz($tz)
            ->setLocale($locale)
            ->setCursor($cursor)
            ->setIncludeTagDeleted(true)
            ->setIncludeTagMuted(true)
            ->setAllowableTaskStatus($status)
            ->setCalExpandInstStart($start)
            ->setCalExpandInstEnd($end)
            ->setInDumpster(true)
            ->setSearchTypes($types)
            ->setGroupBy($groupBy)
            ->setQuick(true)
            ->setSortBy(SortBy::NONE())
            ->setFetch($fetch)
            ->setMarkRead(true)
            ->setMaxInlinedLength($max)
            ->setWantHtml(true)
            ->setNeedCanExpand(true)
            ->setNeuterImages(true)
            ->setWantRecipients(true)
            ->setPrefetch(true)
            ->setResultMode($resultMode)
            ->setFullConversation(true)
            ->setField($field)
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertTrue($req->getWarmup());
        $this->assertSame($query, $req->getQuery());
        $this->assertSame([$header, $header], $req->getHeaders()->all());
        $this->assertSame($tz, $req->getCalTz());
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($cursor, $req->getCursor());
        $this->assertTrue($req->getIncludeTagDeleted());
        $this->assertTrue($req->getIncludeTagMuted());
        $this->assertSame($status, $req->getAllowableTaskStatus());
        $this->assertSame($start, $req->getCalExpandInstStart());
        $this->assertSame($end, $req->getCalExpandInstEnd());
        $this->assertTrue($req->getInDumpster());
        $this->assertSame($types, $req->getSearchTypes());
        $this->assertSame($groupBy, $req->getGroupBy());
        $this->assertTrue($req->getQuick());
        $this->assertTrue($req->getSortBy()->is('none'));
        $this->assertSame($fetch, $req->getFetch());
        $this->assertTrue($req->getMarkRead());
        $this->assertSame($max, $req->getMaxInlinedLength());
        $this->assertTrue($req->getWantHtml());
        $this->assertTrue($req->getNeedCanExpand());
        $this->assertTrue($req->getNeuterImages());
        $this->assertTrue($req->getWantRecipients());
        $this->assertTrue($req->getPrefetch());
        $this->assertSame($resultMode, $req->getResultMode());
        $this->assertTrue($req->getFullConversation());
        $this->assertSame($field, $req->getField());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req = new Search(
            true,
            $query,
            [$header],
            $tz,
            $locale,
            $cursor,
            true,
            true,
            $status,
            $start,
            $end,
            true,
            $types,
            $groupBy,
            true,
            SortBy::NONE(),
            $fetch,
            true,
            $max,
            true,
            true,
            true,
            true,
            true,
            $resultMode,
            true,
            $field,
            $limit,
            $offset
        );
        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchRequest warmup="true" includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="' . $status . '" calExpandInstStart="' . $start . '" calExpandInstEnd="' . $end . '" inDumpster="true" types="' . $types . '" groupBy="' . $groupBy . '" quick="true" sortBy="' . SortBy::NONE() . '" fetch="' . $fetch . '" read="true" max="' . $max . '" html="true" needExp="true" neuter="true" recip="true" prefetch="true" resultMode="' . $resultMode . '" fullConversation="true" field="' . $field . '" limit="' . $limit . '" offset="' . $offset . '">'
                .'<query>' . $query . '</query>'
                .'<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                .'<locale>' . $locale . '</locale>'
                .'<cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                .'<header n="' . $name . '" />'
            .'</SearchRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'warmup' => true,
                'query' => $query,
                'locale' => $locale,
                'includeTagDeleted' => true,
                'includeTagMuted' => true,
                'allowableTaskStatus' => $status,
                'calExpandInstStart' => $start,
                'calExpandInstEnd' => $end,
                'inDumpster' => true,
                'types' => $types,
                'groupBy' => $groupBy,
                'quick' => true,
                'sortBy' => SortBy::NONE()->value(),
                'fetch' => $fetch,
                'read' => true,
                'max' => $max,
                'html' => true,
                'needExp' => true,
                'neuter' => true,
                'recip' => true,
                'prefetch' => true,
                'resultMode' => $resultMode,
                'fullConversation' => true,
                'field' => $field,
                'limit' => $limit,
                'offset' => $offset,
                'header' => array(
                    array(
                        'n' => $name,
                    ),
                ),
                'tz' => array(
                    'id' => $id,
                    'stdoff' => $stdoff,
                    'dayoff' => $dayoff,
                ),
                'cursor' => array(
                    'id' => $id,
                    'sortVal' => $sortVal,
                    'endSortVal' => $endSortVal,
                    'includeOffset' => true,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchApi()
    {
        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $name = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;

        $header = new AttributeName($name);
        $tz = new CalTZInfo($id, $stdoff, $dayoff);
        $cursor = new CursorInfo($id, $sortVal, $endSortVal, true);

        $query = $this->faker->word;
        $locale = $this->faker->word;
        $status = $this->faker->word;
        $start = mt_rand(1, 10);
        $end = mt_rand(1, 10);
        $types = $this->faker->word;
        $groupBy = $this->faker->word;
        $fetch = $this->faker->word;
        $max = mt_rand(1, 10);
        $resultMode = $this->faker->word;
        $field = $this->faker->word;
        $limit = mt_rand(1, 10);
        $offset = mt_rand(1, 10);

        $this->api->search(
            true,
            $query,
            [$header],
            $tz,
            $locale,
            $cursor,
            true,
            true,
            $status,
            $start,
            $end,
            true,
            $types,
            $groupBy,
            true,
            SortBy::NONE(),
            $fetch,
            true,
            $max,
            true,
            true,
            true,
            true,
            true,
            $resultMode,
            true,
            $field,
            $limit,
            $offset
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SearchRequest warmup="true" includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="' . $status . '" calExpandInstStart="' . $start . '" calExpandInstEnd="' . $end . '" inDumpster="true" types="' . $types . '" groupBy="' . $groupBy . '" quick="true" sortBy="' . SortBy::NONE() . '" fetch="' . $fetch . '" read="true" max="' . $max . '" html="true" needExp="true" neuter="true" recip="true" prefetch="true" resultMode="' . $resultMode . '" fullConversation="true" field="' . $field . '" limit="' . $limit . '" offset="' . $offset . '">'
                        .'<urn1:query>' . $query . '</urn1:query>'
                        .'<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                        .'<urn1:locale>' . $locale . '</urn1:locale>'
                        .'<urn1:cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                        .'<urn1:header n="' . $name . '" />'
                    .'</urn1:SearchRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
