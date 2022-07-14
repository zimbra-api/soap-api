<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{
    AddressType, MsgContent, SearchSortBy, SearchType, TaskStatus, WantRecipsSetting
};
use Zimbra\Common\Struct\{
    AttributeName, CursorInfo, TzOnsetInfo, WildcardExpansionQueryInfo
};

use Zimbra\Mail\Message\SearchConvEnvelope;
use Zimbra\Mail\Message\SearchConvBody;
use Zimbra\Mail\Message\SearchConvRequest;
use Zimbra\Mail\Message\SearchConvResponse;

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\MessageHitInfo;
use Zimbra\Mail\Struct\Part;
use Zimbra\Mail\Struct\NestedSearchConversation;

use Zimbra\Mail\Struct\SearchQueryInfo;
use Zimbra\Mail\Struct\SuggestedQueryString;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SearchConv.
 */
class SearchConvTest extends ZimbraTestCase
{
    public function testSearchConv()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $conversationId = $this->faker->uuid;

        $taskStatus = implode(',', $this->faker->randomElements(TaskStatus::values(), 3));
        $calItemExpandStart = $this->faker->randomNumber;
        $calItemExpandEnd = $this->faker->randomNumber;
        $query = $this->faker->word;
        $searchTypes = implode(',', $this->faker->randomElements(SearchType::values(), 3));
        $groupBy = implode(',', $this->faker->randomElements(SearchType::values(), 3));
        $sortBy = SearchSortBy::DATE_DESC();
        $fetch = $this->faker->word;
        $maxInlinedLength = $this->faker->randomNumber;
        $wantRecipients = WantRecipsSetting::PUT_BOTH();
        $resultMode = $this->faker->randomElement(['NORMAL', 'IDS']);
        $field = $this->faker->word;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $locale = $this->faker->locale;
        $wantContent = MsgContent::ORIGINAL();

        $queryOffset = $this->faker->randomNumber;
        $totalSize = $this->faker->randomNumber;
        $sortField = $this->faker->word;
        $part = $this->faker->word;

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

        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $date = $this->faker->unixTime;

        $size = $this->faker->randomNumber;
        $folderId = $this->faker->uuid;
        $autoSendTime = $this->faker->unixTime;

        $string = $this->faker->word;
        $numExpanded = $this->faker->randomNumber;
        $num = $this->faker->randomNumber;

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $calTz = new CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $header = new AttributeName($name);
        $cursor = new CursorInfo($id, $sortVal, $endSortVal, TRUE);

        $request = new SearchConvRequest(
            $id,
            $query,
            TRUE,
            $searchTypes,
            $groupBy,
            $calItemExpandStart,
            $calItemExpandEnd,
            TRUE,
            $sortBy,
            TRUE,
            TRUE,
            $taskStatus,
            $fetch,
            TRUE,
            $maxInlinedLength,
            TRUE,
            TRUE,
            TRUE,
            $wantRecipients,
            TRUE,
            $resultMode,
            TRUE,
            $field,
            $limit,
            $offset,
            [$header],
            $calTz,
            $locale,
            $cursor,
            $wantContent,
            TRUE,
            FALSE
        );
        $this->assertSame($id, $request->getConversationId());
        $this->assertFalse($request->getNestMessages());
        $request->setConversationId($conversationId)
            ->setNestMessages(TRUE);
        $this->assertSame($conversationId, $request->getConversationId());
        $this->assertTrue($request->getNestMessages());

        $msgHit = new MessageHitInfo(
            $id, $sortField, TRUE, [new Part($part)]
        );
        $queryInfo = new SearchQueryInfo(
            [new SuggestedQueryString($string)], [new WildcardExpansionQueryInfo($string, TRUE, $numExpanded)]
        );
        $conversation = new NestedSearchConversation(
            $id, $num, $totalSize, $flags, $tags, $tagNames, [$msgHit], $queryInfo
        );

        $response = new SearchConvResponse(
            $sortBy,
            $queryOffset,
            FALSE,
            $conversation,
            [$msgHit],
            $queryInfo
        );
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($queryOffset, $response->getQueryOffset());
        $this->assertFalse($response->getQueryMore());
        $this->assertSame($conversation, $response->getConversation());
        $this->assertSame([$msgHit], $response->getMessages());
        $this->assertSame($queryInfo, $response->getQueryInfo());
        $response = new SearchConvResponse();
        $response->setSortBy($sortBy)
            ->setQueryOffset($queryOffset)
            ->setQueryMore(TRUE)
            ->setConversation($conversation)
            ->setMessages([$msgHit])
            ->setQueryInfo($queryInfo);
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($queryOffset, $response->getQueryOffset());
        $this->assertTrue($response->getQueryMore());
        $this->assertSame($conversation, $response->getConversation());
        $this->assertSame([$msgHit], $response->getMessages());
        $this->assertSame($queryInfo, $response->getQueryInfo());

        $body = new SearchConvBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SearchConvBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SearchConvEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SearchConvEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SearchConvRequest cid="$conversationId" nest="true" includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="$taskStatus" calExpandInstStart="$calItemExpandStart" calExpandInstEnd="$calItemExpandEnd" inDumpster="true" types="$searchTypes" groupBy="$groupBy" quick="true" sortBy="dateDesc" fetch="$fetch" read="true" max="$maxInlinedLength" html="true" needExp="true" neuter="true" recip="2" prefetch="true" resultMode="$resultMode" fullConversation="true" field="$field" limit="$limit" offset="$offset" wantContent="original" memberOf="true">
            <urn:query>$query</urn:query>
            <urn:header n="$name" />
            <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
            </urn:tz>
            <urn:locale>$locale</urn:locale>
            <urn:cursor id="$id" sortVal="$sortVal" endSortVal="$endSortVal" includeOffset="true" />
        </urn:SearchConvRequest>
        <urn:SearchConvResponse sortBy="dateDesc" offset="$queryOffset" more="true">
            <urn:c id="$id" n="$num" total="$totalSize" f="$flags" t="$tags" tn="$tagNames">
                <urn:m sf="$sortField" cm="true" id="$id">
                    <urn:hp part="$part" />
                </urn:m>
                <urn:info>
                    <urn:suggest>$string</urn:suggest>
                    <urn:wildcard str="$string" expanded="true" numExpanded="$numExpanded" />
                </urn:info>
            </urn:c>
            <urn:m sf="$sortField" cm="true" id="$id">
                <urn:hp part="$part" />
            </urn:m>
            <urn:info>
                <urn:suggest>$string</urn:suggest>
                <urn:wildcard str="$string" expanded="true" numExpanded="$numExpanded" />
            </urn:info>
        </urn:SearchConvResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchConvEnvelope::class, 'xml'));
    }
}
