<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{
    AddressType, MsgContent, SearchSortBy, SearchType, TaskStatus, WantRecipsSetting
};
use Zimbra\Common\Struct\{
    AttributeName, CursorInfo, SimpleSearchHit, TzOnsetInfo, WildcardExpansionQueryInfo
};

use Zimbra\Mail\Message\SearchEnvelope;
use Zimbra\Mail\Message\SearchBody;
use Zimbra\Mail\Message\SearchRequest;
use Zimbra\Mail\Message\SearchResponse;

use Zimbra\Mail\Struct\AppointmentHitInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\ChatHitInfo;
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Mail\Struct\ConversationHitInfo;
use Zimbra\Mail\Struct\ConversationMsgHitInfo;
use Zimbra\Mail\Struct\DocumentHitInfo;
use Zimbra\Mail\Struct\MessageHitInfo;
use Zimbra\Mail\Struct\MessagePartHitInfo;
use Zimbra\Mail\Struct\NoteHitInfo;
use Zimbra\Mail\Struct\Part;
use Zimbra\Mail\Struct\TaskHitInfo;
use Zimbra\Mail\Struct\WikiHitInfo;

use Zimbra\Mail\Struct\SearchQueryInfo;
use Zimbra\Mail\Struct\SuggestedQueryString;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Search.
 */
class SearchTest extends ZimbraTestCase
{
    public function testSearch()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

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
        $date = $this->faker->unixTime;

        $size = $this->faker->randomNumber;
        $folderId = $this->faker->uuid;
        $autoSendTime = $this->faker->unixTime;

        $string = $this->faker->word;
        $numExpanded = $this->faker->randomNumber;

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $calTz = new CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $header = new AttributeName($name);
        $cursor = new CursorInfo($id, $sortVal, $endSortVal, TRUE);

        $request = new SearchRequest(
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
        $this->assertFalse($request->getWarmup());
        $request->setWarmup(TRUE);
        $this->assertTrue($request->getWarmup());

        $hit = new SimpleSearchHit($id, $sortField);
        $convHit = new ConversationHitInfo(
            $id, $sortField, [new ConversationMsgHitInfo(
                $id, $size, $folderId, $flags, $autoSendTime, $date
            )]
        );
        $msgHit = new MessageHitInfo(
            $id, $sortField, TRUE, [new Part($part)]
        );
        $chatHit = new ChatHitInfo(
            $id, $sortField, TRUE, [new Part($part)]
        );
        $mpHit = new MessagePartHitInfo($id, $sortField);
        $cnHit = new ContactInfo($id, $sortField);
        $noteHit = new NoteHitInfo($id, $sortField);
        $docHit = new DocumentHitInfo($id, $sortField);
        $wikiHit = new WikiHitInfo($id, $sortField);
        $apptHit = new AppointmentHitInfo($id, $sortField);
        $taskHit = new TaskHitInfo($id, $sortField);

        $queryInfo = new SearchQueryInfo(
            [new SuggestedQueryString($string)], [new WildcardExpansionQueryInfo($string, TRUE, $numExpanded)]
        );

        $response = new SearchResponse(
            $sortBy,
            $queryOffset,
            FALSE,
            $totalSize,
            [$hit],
            [$convHit],
            [$msgHit],
            [$chatHit],
            [$mpHit],
            [$cnHit],
            [$noteHit],
            [$docHit],
            [$wikiHit],
            [$apptHit],
            [$taskHit],
            $queryInfo
        );
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($queryOffset, $response->getQueryOffset());
        $this->assertFalse($response->getQueryMore());
        $this->assertSame($totalSize, $response->getTotalSize());
        $this->assertSame([$hit], $response->getSimpleHits());
        $this->assertSame([$convHit], $response->getConversationHits());
        $this->assertSame([$msgHit], $response->getMessageHits());
        $this->assertSame([$chatHit], $response->getChatHits());
        $this->assertSame([$mpHit], $response->getMessagePartHits());
        $this->assertSame([$cnHit], $response->getContactHits());
        $this->assertSame([$noteHit], $response->getNoteHits());
        $this->assertSame([$docHit], $response->getDocumentHits());
        $this->assertSame([$wikiHit], $response->getWikiHits());
        $this->assertSame([$apptHit], $response->getAppointmentHits());
        $this->assertSame([$taskHit], $response->getTaskHits());
        $this->assertSame($queryInfo, $response->getQueryInfo());
        $response = new SearchResponse();
        $response->setSortBy($sortBy)
            ->setQueryOffset($queryOffset)
            ->setQueryMore(TRUE)
            ->setTotalSize($totalSize)
            ->setSimpleHits([$hit])
            ->setConversationHits([$convHit])
            ->setMessageHits([$msgHit])
            ->setChatHits([$chatHit])
            ->setMessagePartHits([$mpHit])
            ->setContactHits([$cnHit])
            ->setNoteHits([$noteHit])
            ->setDocumentHits([$docHit])
            ->setWikiHits([$wikiHit])
            ->setAppointmentHits([$apptHit])
            ->setTaskHits([$taskHit])
            ->setQueryInfo($queryInfo);
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($queryOffset, $response->getQueryOffset());
        $this->assertTrue($response->getQueryMore());
        $this->assertSame($totalSize, $response->getTotalSize());
        $this->assertSame([$hit], $response->getSimpleHits());
        $this->assertSame([$convHit], $response->getConversationHits());
        $this->assertSame([$msgHit], $response->getMessageHits());
        $this->assertSame([$chatHit], $response->getChatHits());
        $this->assertSame([$mpHit], $response->getMessagePartHits());
        $this->assertSame([$cnHit], $response->getContactHits());
        $this->assertSame([$noteHit], $response->getNoteHits());
        $this->assertSame([$docHit], $response->getDocumentHits());
        $this->assertSame([$wikiHit], $response->getWikiHits());
        $this->assertSame([$apptHit], $response->getAppointmentHits());
        $this->assertSame([$taskHit], $response->getTaskHits());
        $this->assertSame($queryInfo, $response->getQueryInfo());

        $body = new SearchBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SearchBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SearchEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SearchEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SearchRequest warmup="true" includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="$taskStatus" calExpandInstStart="$calItemExpandStart" calExpandInstEnd="$calItemExpandEnd" inDumpster="true" types="$searchTypes" groupBy="$groupBy" quick="true" sortBy="dateDesc" fetch="$fetch" read="true" max="$maxInlinedLength" html="true" needExp="true" neuter="true" recip="2" prefetch="true" resultMode="$resultMode" fullConversation="true" field="$field" limit="$limit" offset="$offset" wantContent="original" memberOf="true">
            <urn:query>$query</urn:query>
            <urn:header n="$name" />
            <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
            </urn:tz>
            <urn:locale>$locale</urn:locale>
            <urn:cursor id="$id" sortVal="$sortVal" endSortVal="$endSortVal" includeOffset="true" />
        </urn:SearchRequest>
        <urn:SearchResponse sortBy="dateDesc" offset="$queryOffset" more="true" total="$totalSize">
            <urn:hit id="$id" sf="$sortField" />
            <urn:c sf="$sortField" id="$id">
                <urn:m id="$id" s="$size" l="$folderId" f="$flags" autoSendTime="$autoSendTime" d="$date" />
            </urn:c>
            <urn:m sf="$sortField" cm="true" id="$id">
                <urn:hp part="$part" />
            </urn:m>
            <urn:chat sf="$sortField" cm="true" id="$id">
                <urn:hp part="$part" />
            </urn:chat>
            <urn:mp sf="$sortField" id="$id" />
            <urn:cn sf="$sortField" id="$id" />
            <urn:note sf="$sortField" id="$id" />
            <urn:doc sf="$sortField" id="$id" />
            <urn:w sf="$sortField" id="$id" />
            <urn:appt sf="$sortField" id="$id" />
            <urn:task sf="$sortField" id="$id" />
            <urn:info>
                <urn:suggest>$string</urn:suggest>
                <urn:wildcard str="$string" expanded="true" numExpanded="$numExpanded" />
            </urn:info>
        </urn:SearchResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchEnvelope::class, 'xml'));
    }
}
