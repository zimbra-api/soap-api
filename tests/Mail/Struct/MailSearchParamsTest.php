<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{MsgContent, SearchSortBy, SearchType, TaskStatus, WantRecipsSetting};
use Zimbra\Common\Struct\{AttributeName, CursorInfo, SearchParameters, TzOnsetInfo};

use Zimbra\Mail\Struct\MailSearchParams;
use Zimbra\Mail\Struct\CalTZInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailSearchParams.
 */
class MailSearchParamsTest extends ZimbraTestCase
{
    public function testMailSearchParams()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $includeTagDeleted = TRUE;
        $includeTagMuted = TRUE;
        $taskStatus = implode(',', $this->faker->randomElements(TaskStatus::values(), 3));
        $calItemExpandStart = $this->faker->randomNumber;
        $calItemExpandEnd = $this->faker->randomNumber;
        $query = $this->faker->word;
        $inDumpster = TRUE;
        $searchTypes = implode(',', $this->faker->randomElements(SearchType::values(), 3));
        $groupBy = implode(',', $this->faker->randomElements(SearchType::values(), 3));
        $quick = TRUE;
        $sortBy = SearchSortBy::DATE_DESC();
        $fetch = $this->faker->word;
        $markRead = TRUE;
        $maxInlinedLength = $this->faker->randomNumber;
        $wantHtml = TRUE;
        $needCanExpand = TRUE;
        $neuterImages = TRUE;
        $wantRecipients = WantRecipsSetting::PUT_BOTH();
        $prefetch = TRUE;
        $resultMode = $this->faker->randomElement(['NORMAL', 'IDS']);
        $fullConversation = TRUE;
        $field = $this->faker->word;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $locale = $this->faker->locale;
        $wantContent = MsgContent::ORIGINAL();
        $includeMemberOf = TRUE;

        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $standardTZName = $this->faker->word;
        $daylightTZName = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;

        $mon = $this->faker->numberBetween(1, 12);
        $hour = $this->faker->numberBetween(0, 23);
        $min = $this->faker->numberBetween(0, 59);
        $sec = $this->faker->numberBetween(0, 59);
        $mday = $this->faker->numberBetween(1, 31);
        $week = $this->faker->numberBetween(1, 4);
        $wkday = $this->faker->numberBetween(1, 7);

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $calTz = new CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $header = new AttributeName($name);
        $cursor = new CursorInfo($id, $sortVal, $endSortVal, TRUE);

        $params = new StubSearchParameters();
        $params->setIncludeTagDeleted($includeTagDeleted)
            ->setIncludeTagMuted($includeTagMuted)
            ->setAllowableTaskStatus($taskStatus)
            ->setCalItemExpandStart($calItemExpandStart)
            ->setCalItemExpandEnd($calItemExpandEnd)
            ->setQuery($query)
            ->setInDumpster($inDumpster)
            ->setSearchTypes($searchTypes)
            ->setGroupBy($groupBy)
            ->setQuick($quick)
            ->setSortBy($sortBy)
            ->setFetch($fetch)
            ->setMarkRead($markRead)
            ->setMaxInlinedLength($maxInlinedLength)
            ->setWantHtml($wantHtml)
            ->setNeedCanExpand($needCanExpand)
            ->setNeuterImages($neuterImages)
            ->setWantRecipients($wantRecipients)
            ->setPrefetch($prefetch)
            ->setResultMode($resultMode)
            ->setFullConversation($fullConversation)
            ->setField($field)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setHeaders([$header])
            ->addHeader($header)
            ->setCalTz($calTz)
            ->setLocale($locale)
            ->setCursor($cursor)
            ->setWantContent($wantContent)
            ->setIncludeMemberOf($includeMemberOf);

        $this->assertSame($includeTagDeleted, $params->getIncludeTagDeleted());
        $this->assertSame($includeTagMuted, $params->getIncludeTagMuted());
        $this->assertSame($taskStatus, $params->getAllowableTaskStatus());
        $this->assertSame($calItemExpandStart, $params->getCalItemExpandStart());
        $this->assertSame($calItemExpandEnd, $params->getCalItemExpandEnd());
        $this->assertSame($query, $params->getQuery());
        $this->assertSame($inDumpster, $params->getInDumpster());
        $this->assertSame($searchTypes, $params->getSearchTypes());
        $this->assertSame($groupBy, $params->getGroupBy());
        $this->assertSame($quick, $params->getQuick());
        $this->assertSame($sortBy, $params->getSortBy());
        $this->assertSame($fetch, $params->getFetch());
        $this->assertSame($markRead, $params->getMarkRead());
        $this->assertSame($maxInlinedLength, $params->getMaxInlinedLength());
        $this->assertSame($wantHtml, $params->getWantHtml());
        $this->assertSame($needCanExpand, $params->getNeedCanExpand());
        $this->assertSame($neuterImages, $params->getNeuterImages());
        $this->assertSame($wantRecipients, $params->getWantRecipients());
        $this->assertSame($prefetch, $params->getPrefetch());
        $this->assertSame($resultMode, $params->getResultMode());
        $this->assertSame($fullConversation, $params->getFullConversation());
        $this->assertSame($field, $params->getField());
        $this->assertSame($limit, $params->getLimit());
        $this->assertSame($offset, $params->getOffset());
        $this->assertSame([$header, $header], $params->getHeaders());
        $this->assertSame($calTz, $params->getCalTz());
        $this->assertSame($locale, $params->getLocale());
        $this->assertSame($cursor, $params->getCursor());
        $this->assertSame($wantContent, $params->getWantContent());
        $this->assertSame($includeMemberOf, $params->getIncludeMemberOf());

        $xml = <<<EOT
<?xml version="1.0"?>
<result includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="$taskStatus" calExpandInstStart="$calItemExpandStart" calExpandInstEnd="$calItemExpandEnd" inDumpster="true" types="$searchTypes" groupBy="$groupBy" quick="true" sortBy="dateDesc" fetch="$fetch" read="true" max="$maxInlinedLength" html="true" needExp="true" neuter="true" recip="2" prefetch="true" resultMode="$resultMode" fullConversation="true" field="$field" limit="$limit" offset="$offset" wantContent="original" memberOf="true" xmlns:urn="urn:zimbraMail">
    <urn:query>$query</urn:query>
    <urn:header n="$name" />
    <urn:header n="$name" />
    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
        <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
        <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
    </urn:tz>
    <urn:locale>$locale</urn:locale>
    <urn:cursor id="$id" sortVal="$sortVal" endSortVal="$endSortVal" includeOffset="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($params, 'xml'));
        $this->assertEquals($params, $this->serializer->deserialize($xml, StubSearchParameters::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubSearchParameters implements SearchParameters
{
    use MailSearchParams;
}
