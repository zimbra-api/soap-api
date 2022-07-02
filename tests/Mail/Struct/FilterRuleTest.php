<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\FilterCondition;
use Zimbra\Common\Enum\Importance;
use Zimbra\Common\Enum\DateComparison;
use Zimbra\Common\Enum\LoggingLevel;
use Zimbra\Common\Enum\NumberComparison;
use Zimbra\Common\Enum\{MatchType, RelationalComparator};
use Zimbra\Common\Enum\{AddressPart, ComparisonComparator, CountComparison, StringComparison, ValueComparison};

use Zimbra\Mail\Struct\FilterVariable;
use Zimbra\Mail\Struct\FilterVariables;
use Zimbra\Mail\Struct\AddressBookTest;
use Zimbra\Mail\Struct\AddressTest;
use Zimbra\Mail\Struct\EnvelopeTest;
use Zimbra\Mail\Struct\AttachmentTest;
use Zimbra\Mail\Struct\BodyTest;
use Zimbra\Mail\Struct\BulkTest;
use Zimbra\Mail\Struct\ContactRankingTest;
use Zimbra\Mail\Struct\ConversationTest;
use Zimbra\Mail\Struct\CurrentDayOfWeekTest;
use Zimbra\Mail\Struct\CurrentTimeTest;
use Zimbra\Mail\Struct\DateTest;
use Zimbra\Mail\Struct\FacebookTest;
use Zimbra\Mail\Struct\FlaggedTest;
use Zimbra\Mail\Struct\HeaderExistsTest;
use Zimbra\Mail\Struct\HeaderTest;
use Zimbra\Mail\Struct\ImportanceTest;
use Zimbra\Mail\Struct\InviteTest;
use Zimbra\Mail\Struct\LinkedInTest;
use Zimbra\Mail\Struct\ListTest;
use Zimbra\Mail\Struct\MeTest;
use Zimbra\Mail\Struct\MimeHeaderTest;
use Zimbra\Mail\Struct\SizeTest;
use Zimbra\Mail\Struct\SocialcastTest;
use Zimbra\Mail\Struct\TrueTest;
use Zimbra\Mail\Struct\TwitterTest;
use Zimbra\Mail\Struct\CommunityRequestsTest;
use Zimbra\Mail\Struct\CommunityContentTest;
use Zimbra\Mail\Struct\CommunityConnectionsTest;
use Zimbra\Mail\Struct\FilterTests;

use Zimbra\Mail\Struct\KeepAction;
use Zimbra\Mail\Struct\DiscardAction;
use Zimbra\Mail\Struct\FileIntoAction;
use Zimbra\Mail\Struct\FlagAction;
use Zimbra\Mail\Struct\TagAction;
use Zimbra\Mail\Struct\RedirectAction;
use Zimbra\Mail\Struct\ReplyAction;
use Zimbra\Mail\Struct\NotifyAction;
use Zimbra\Mail\Struct\RFCCompliantNotifyAction;
use Zimbra\Mail\Struct\StopAction;
use Zimbra\Mail\Struct\RejectAction;
use Zimbra\Mail\Struct\ErejectAction;
use Zimbra\Mail\Struct\LogAction;
use Zimbra\Mail\Struct\AddheaderAction;
use Zimbra\Mail\Struct\DeleteheaderAction;
use Zimbra\Mail\Struct\ReplaceheaderAction;
use Zimbra\Mail\Struct\EditheaderTest;

use Zimbra\Mail\Struct\NestedRule;
use Zimbra\Mail\Struct\FilterRule;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FilterRule.
 */
class FilterRuleTest extends ZimbraTestCase
{
    public function testFilterRule()
    {
        $index = $this->faker->randomNumber;
        $header = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $where = $this->faker->word;
        $time = $this->faker->time;
        $date = $this->faker->unixTime;
        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $method = $this->faker->word;
        $size = $this->faker->word;
        $folder = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $subject = $this->faker->word;
        $maxBodySize = $this->faker->randomNumber;
        $origHeaders = $this->faker->word;
        $from = $this->faker->word;
        $importance = $this->faker->word;
        $options = $this->faker->word;
        $message = $this->faker->word;
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;
        $offset = $this->faker->randomNumber;
        $newName = $this->faker->word;
        $newValue = $this->faker->word;

        $filterVariables = new FilterVariables($index, [new FilterVariable($name, $value)]);

        $addressBookTest = new AddressBookTest(
            $index, TRUE, $header
        );
        $addressTest = new AddressTest(
            $index, TRUE, $header, AddressPart::ALL(), StringComparison::IS(), TRUE, $value, ValueComparison::EQUAL(), CountComparison::EQUAL(), ComparisonComparator::OCTET()
        );
        $envelopeTest = new EnvelopeTest(
            $index, TRUE, $header, AddressPart::ALL(), StringComparison::IS(), TRUE, $value, ValueComparison::EQUAL(), CountComparison::EQUAL(), ComparisonComparator::OCTET()
        );
        $attachmentTest = new AttachmentTest(
            $index, TRUE
        );
        $bodyTest = new BodyTest(
            $index, TRUE, $value, TRUE
        );
        $bulkTest = new BulkTest(
            $index, TRUE
        );
        $contactRankingTest = new ContactRankingTest(
            $index, TRUE, $header
        );
        $conversationTest = new ConversationTest(
            $index, TRUE, $where
        );
        $currentDayOfWeekTest = new CurrentDayOfWeekTest(
            $index, TRUE, $value
        );
        $currentTimeTest = new CurrentTimeTest(
            $index, TRUE, DateComparison::BEFORE(), $time
        );
        $dateTest = new DateTest(
            $index, TRUE, DateComparison::BEFORE(), $date
        );
        $facebookTest = new FacebookTest(
            $index, TRUE
        );
        $flaggedTest = new FlaggedTest(
            $index, TRUE, $flag
        );
        $headerExistsTest = new HeaderExistsTest(
            $index, TRUE, $header
        );
        $headerTest = new HeaderTest(
            $index, TRUE, $header, StringComparison::IS(), ValueComparison::EQUAL(), CountComparison::EQUAL(), ComparisonComparator::OCTET(), $value, TRUE
        );
        $importanceTest = new ImportanceTest(
            $index, TRUE, Importance::HIGH()
        );
        $inviteTest = new InviteTest(
            $index, TRUE, [$method]
        );
        $linkedinTest = new LinkedInTest(
            $index, TRUE
        );
        $listTest = new ListTest(
            $index, TRUE
        );
        $meTest = new MeTest(
            $index, TRUE, $header
        );
        $mimeHeaderTest = new MimeHeaderTest(
            $index, TRUE, $header, StringComparison::IS(), $value, TRUE
        );
        $sizeTest = new SizeTest(
            $index, TRUE, NumberComparison::OVER(), $size
        );
        $socialcastTest = new SocialcastTest(
            $index, TRUE
        );
        $trueTest = new TrueTest(
            $index, TRUE
        );
        $twitterTest = new TwitterTest(
            $index, TRUE
        );
        $communityRequestsTest = new CommunityRequestsTest(
            $index, TRUE
        );
        $communityContentTest = new CommunityContentTest(
            $index, TRUE
        );
        $communityConnectionsTest = new CommunityConnectionsTest(
            $index, TRUE
        );
        $filterTests = new FilterTests(
            FilterCondition::ALL_OF(), [
                $addressBookTest,
                $addressTest,
                $envelopeTest,
                $attachmentTest,
                $bodyTest,
                $bulkTest,
                $contactRankingTest,
                $conversationTest,
                $currentDayOfWeekTest,
                $currentTimeTest,
                $dateTest,
                $facebookTest,
                $flaggedTest,
                $headerExistsTest,
                $headerTest,
                $importanceTest,
                $inviteTest,
                $linkedinTest,
                $listTest,
                $meTest,
                $mimeHeaderTest,
                $sizeTest,
                $socialcastTest,
                $trueTest,
                $twitterTest,
                $communityRequestsTest,
                $communityContentTest,
                $communityConnectionsTest,
            ]
        );

        $actionKeep = new KeepAction($index);
        $actionDiscard = new DiscardAction($index);
        $actionFileInto = new FileIntoAction($index, $folder, TRUE);
        $actionFlag = new FlagAction($index, $flag);
        $actionTag = new TagAction($index, $tag, TRUE);
        $actionRedirect = new RedirectAction($index, $address, TRUE);
        $actionReply = new ReplyAction($index, $content, TRUE);
        $actionNotify = new NotifyAction($index, $address, $subject, $maxBodySize, $content, $origHeaders);
        $actionRFCCompliantNotify = new RFCCompliantNotifyAction($index, $from, $importance, $options, $message, $method);
        $actionStop = new StopAction($index);
        $actionReject = new RejectAction($index, $content);
        $actionEreject = new ErejectAction($index, $content);
        $actionLog = new LogAction($index, LoggingLevel::INFO(), $content);
        $actionAddheader = new AddheaderAction($index, $headerName, $headerValue, TRUE);
        $actionDeleteheader = new DeleteheaderAction(
            $index, TRUE, $offset
            , new EditheaderTest(MatchType::IS(), TRUE, TRUE, RelationalComparator::EQUAL(), ComparisonComparator::OCTET(), $headerName, [$headerValue])
        );
        $actionReplaceheader = new ReplaceheaderAction(
            $index, TRUE, $offset,
            new EditheaderTest(MatchType::IS(), TRUE, TRUE, RelationalComparator::EQUAL(), ComparisonComparator::OCTET(), $headerName, [$headerValue]),
            $newName, $newValue
        );

        $child = new NestedRule(new FilterTests(FilterCondition::ALL_OF()));
        $filterRule = new StubFilterRule($filterTests, $name, FALSE, $filterVariables, [
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ], $child);
        $this->assertSame($name, $filterRule->getName());
        $this->assertFalse($filterRule->isActive());
        $this->assertSame($filterTests, $filterRule->getFilterTests());
        $this->assertSame($filterVariables, $filterRule->getFilterVariables());
        $this->assertSame([
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ], array_values($filterRule->getFilterActions()));
        $this->assertSame($child, $filterRule->getChild());

        $filterRule = new StubFilterRule(new FilterTests());
        $filterRule->setName($name)
            ->setActive(TRUE)
            ->setFilterTests($filterTests)
            ->setFilterVariables($filterVariables)
            ->setChild($child)
            ->setFilterActions([
                $filterVariables,
                $actionKeep,
                $actionDiscard,
                $actionFileInto,
                $actionFlag,
                $actionTag,
                $actionRedirect,
                $actionReply,
                $actionNotify,
                $actionRFCCompliantNotify,
                $actionStop,
                $actionReject,
                $actionEreject,
                $actionLog,
            ])
            ->addFilterAction($actionAddheader)
            ->addFilterAction($actionDeleteheader)
            ->addFilterAction($actionReplaceheader);
        $this->assertSame($name, $filterRule->getName());
        $this->assertTrue($filterRule->isActive());
        $this->assertSame($filterTests, $filterRule->getFilterTests());
        $this->assertSame($filterVariables, $filterRule->getFilterVariables());
        $this->assertSame([
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ], array_values($filterRule->getFilterActions()));
        $this->assertSame($child, $filterRule->getChild());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" active="true" xmlns:urn="urn:zimbraMail">
    <urn:filterVariables index="$index">
        <urn:filterVariable name="$name" value="$value" />
    </urn:filterVariables>
    <urn:filterTests condition="allof">
        <urn:addressBookTest index="$index" negative="true" header="$header"/>
        <urn:addressTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet"/>
        <urn:envelopeTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet"/>
        <urn:attachmentTest index="$index" negative="true"/>
        <urn:bodyTest index="$index" negative="true" value="$value" caseSensitive="true"/>
        <urn:bulkTest index="$index" negative="true"/>
        <urn:contactRankingTest index="$index" negative="true" header="$header"/>
        <urn:conversationTest index="$index" negative="true" where="$where"/>
        <urn:currentDayOfWeekTest index="$index" negative="true" value="$value"/>
        <urn:currentTimeTest index="$index" negative="true" dateComparison="before" time="$time"/>
        <urn:dateTest index="$index" negative="true" dateComparison="before" date="$date"/>
        <urn:facebookTest index="$index" negative="true"/>
        <urn:flaggedTest index="$index" negative="true" flagName="$flag"/>
        <urn:headerExistsTest index="$index" negative="true" header="$header"/>
        <urn:headerTest index="$index" negative="true" header="$header" stringComparison="is" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" value="$value" caseSensitive="true"/>
        <urn:importanceTest index="$index" negative="true" imp="high"/>
        <urn:inviteTest index="$index" negative="true">
            <urn:method>$method</urn:method>
        </urn:inviteTest>
        <urn:linkedinTest index="$index" negative="true"/>
        <urn:listTest index="$index" negative="true"/>
        <urn:meTest index="$index" negative="true" header="$header"/>
        <urn:mimeHeaderTest index="$index" negative="true" header="$header" stringComparison="is" value="$value" caseSensitive="true"/>
        <urn:sizeTest index="$index" negative="true" numberComparison="over" s="$size"/>
        <urn:socialcastTest index="$index" negative="true"/>
        <urn:trueTest index="$index" negative="true"/>
        <urn:twitterTest index="$index" negative="true"/>
        <urn:communityRequestsTest index="$index" negative="true"/>
        <urn:communityContentTest index="$index" negative="true"/>
        <urn:communityConnectionsTest index="$index" negative="true"/>
    </urn:filterTests>
    <urn:filterActions>
        <urn:filterVariables index="$index">
            <urn:filterVariable name="$name" value="$value" />
        </urn:filterVariables>
        <urn:actionKeep index="$index" />
        <urn:actionDiscard index="$index" />
        <urn:actionFileInto index="$index" folderPath="$folder" copy="true" />
        <urn:actionFlag index="$index" flagName="$flag" />
        <urn:actionTag index="$index" tagName="$tag" />
        <urn:actionRedirect index="$index" a="$address" copy="true" />
        <urn:actionReply index="$index">
            <urn:content>$content</urn:content>
        </urn:actionReply>
        <urn:actionNotify index="$index" a="$address" su="$subject" maxBodySize="$maxBodySize" origHeaders="$origHeaders">
            <urn:content>$content</urn:content>
        </urn:actionNotify>
        <urn:actionRFCCompliantNotify index="$index" from="$from" importance="$importance" options="$options" message="$message">
            <urn:method>$method</urn:method>
        </urn:actionRFCCompliantNotify>
        <urn:actionStop index="$index" />
        <urn:actionReject index="$index">$content</urn:actionReject>
        <urn:actionEreject index="$index">$content</urn:actionEreject>
        <urn:actionLog index="$index" level="info">$content</urn:actionLog>
        <urn:actionAddheader index="$index" last="true">
            <urn:headerName>$headerName</urn:headerName>
            <urn:headerValue>$headerValue</urn:headerValue>
        </urn:actionAddheader>
        <urn:actionDeleteheader index="$index" last="true" offset="$offset">
            <urn:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                <urn:headerName>$headerName</urn:headerName>
                <urn:headerValue>$headerValue</urn:headerValue>
            </urn:test>
        </urn:actionDeleteheader>
        <urn:actionReplaceheader index="$index" last="true" offset="$offset">
            <urn:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                <urn:headerName>$headerName</urn:headerName>
                <urn:headerValue>$headerValue</urn:headerValue>
            </urn:test>
            <urn:newName>$newName</urn:newName>
            <urn:newValue>$newValue</urn:newValue>
        </urn:actionReplaceheader>
    </urn:filterActions>
    <urn:nestedRule>
        <urn:filterTests condition="allof" />
    </urn:nestedRule>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($filterRule, 'xml'));
        $this->assertEquals($filterRule, $this->serializer->deserialize($xml, StubFilterRule::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubFilterRule extends FilterRule
{
}
