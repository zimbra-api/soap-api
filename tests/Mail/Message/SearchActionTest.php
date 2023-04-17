<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{
    AddressType, BulkOperation, MsgContent, SearchSortBy, SearchType, TaskStatus, WantRecipsSetting
};
use Zimbra\Common\Struct\{
    AttributeName, CursorInfo, TzOnsetInfo
};

use Zimbra\Mail\Message\SearchActionEnvelope;
use Zimbra\Mail\Message\SearchActionBody;
use Zimbra\Mail\Message\SearchActionRequest;
use Zimbra\Mail\Message\SearchActionResponse;
use Zimbra\Mail\Message\SearchRequest;

use Zimbra\Mail\Struct\BulkAction;
use Zimbra\Mail\Struct\CalTZInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SearchAction.
 */
class SearchActionTest extends ZimbraTestCase
{
    public function testSearchAction()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $taskStatus = implode(',', array_map(fn ($status) => $status->value, $this->faker->randomElements(TaskStatus::cases(), 3)));
        $calItemExpandStart = $this->faker->randomNumber;
        $calItemExpandEnd = $this->faker->randomNumber;
        $query = $this->faker->word;
        $searchTypes = implode(',', array_map(fn ($type) => $type->value, $this->faker->randomElements(SearchType::cases(), 3)));
        $groupBy = implode(',', array_map(fn ($by) => $by->value, $this->faker->randomElements(SearchType::cases(), 3)));
        $sortBy = SearchSortBy::DATE_DESC;
        $fetch = $this->faker->word;
        $maxInlinedLength = $this->faker->randomNumber;
        $wantRecipients = WantRecipsSetting::PUT_BOTH;
        $resultMode = $this->faker->randomElement(['NORMAL', 'IDS']);
        $field = $this->faker->word;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $locale = $this->faker->locale;
        $wantContent = MsgContent::ORIGINAL;

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

        $op = BulkOperation::MOVE;
        $folder = $this->faker->uuid;

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $calTz = new CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $header = new AttributeName($name);
        $cursor = new CursorInfo($id, $sortVal, $endSortVal, TRUE);
        $searchRequest = new SearchRequest(
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
            TRUE
        );
        $bulkAction = new BulkAction(
            $op, $folder
        );

        $request = new SearchActionRequest($searchRequest, $bulkAction);
        $this->assertSame($searchRequest, $request->getSearchRequest());
        $this->assertSame($bulkAction, $request->getBulkAction());
        $request = new SearchActionRequest(new SearchRequest(), new BulkAction());
        $request->setSearchRequest($searchRequest)
            ->setBulkAction($bulkAction);
        $this->assertSame($searchRequest, $request->getSearchRequest());
        $this->assertSame($bulkAction, $request->getBulkAction());

        $response = new SearchActionResponse();

        $body = new SearchActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SearchActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SearchActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SearchActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SearchActionRequest>
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
            <urn:BulkAction op="move" l="$folder" />
        </urn:SearchActionRequest>
        <urn:SearchActionResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchActionEnvelope::class, 'xml'));
    }
}
