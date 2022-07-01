<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetFilterRulesBody;
use Zimbra\Admin\Message\GetFilterRulesEnvelope;
use Zimbra\Admin\Message\GetFilterRulesRequest;
use Zimbra\Admin\Message\GetFilterRulesResponse;

use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\ServerSelector;

use Zimbra\Common\SerializerFactory;
use Zimbra\Mail\SerializerHandler;

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

use Zimbra\Common\Enum\FilterCondition;
use Zimbra\Common\Enum\Importance;
use Zimbra\Common\Enum\DateComparison;
use Zimbra\Common\Enum\LoggingLevel;
use Zimbra\Common\Enum\NumberComparison;
use Zimbra\Common\Enum\{MatchType, RelationalComparator};
use Zimbra\Common\Enum\{AddressPart, ComparisonComparator, CountComparison, StringComparison, ValueComparison};

use Zimbra\Common\Enum\AdminFilterType;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Enum\CosBy;
use Zimbra\Common\Enum\DomainBy;
use Zimbra\Common\Enum\ServerBy;

use Zimbra\Common\Struct\AccountSelector;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetFilterRulesTest.
 */
class GetFilterRulesTest extends ZimbraTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testGetFilterRules()
    {
        $type = AdminFilterType::BEFORE();
        $index = mt_rand(1, 99);
        $header = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $where = $this->faker->word;
        $time = $this->faker->word;
        $date = time();
        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $method = $this->faker->word;
        $size = $this->faker->word;
        $folder = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $subject = $this->faker->word;
        $maxBodySize = mt_rand(1, 99);
        $origHeaders = $this->faker->word;
        $from = $this->faker->word;
        $importance = $this->faker->word;
        $options = $this->faker->word;
        $message = $this->faker->word;
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;
        $offset = mt_rand(1, 99);
        $newName = $this->faker->word;
        $newValue = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $cos = new CosSelector(CosBy::NAME(), $value);
        $server = new ServerSelector(ServerBy::NAME(), $value);

        $request = new GetFilterRulesRequest($type, $account, $domain, $cos, $server);
        $this->assertSame($type, $request->getType());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($server, $request->getServer());

        $request = new GetFilterRulesRequest(AdminFilterType::AFTER());
        $request->setType($type)
            ->setAccount($account)
            ->setDomain($domain)
            ->setCos($cos)
            ->setServer($server);
        $this->assertSame($type, $request->getType());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($server, $request->getServer());

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
        $filterRule = new FilterRule($filterTests, $name, TRUE, $filterVariables, [
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

        $response = new GetFilterRulesResponse($type, $account, $domain, $cos, $server, [$filterRule]);
        $this->assertSame($type, $response->getType());
        $this->assertSame($account, $response->getAccount());
        $this->assertSame($domain, $response->getDomain());
        $this->assertSame($cos, $response->getCos());
        $this->assertSame($server, $response->getServer());
        $this->assertSame([$filterRule], $response->getFilterRules());
        $response = new GetFilterRulesResponse(AdminFilterType::AFTER());
        $response->setType($type)
            ->setAccount($account)
            ->setDomain($domain)
            ->setCos($cos)
            ->setServer($server)
            ->setFilterRules([$filterRule])
            ->addFilterRule($filterRule);
        $this->assertSame($type, $response->getType());
        $this->assertSame($account, $response->getAccount());
        $this->assertSame($domain, $response->getDomain());
        $this->assertSame($cos, $response->getCos());
        $this->assertSame($server, $response->getServer());
        $this->assertSame([$filterRule, $filterRule], $response->getFilterRules());
        $response->setFilterRules([$filterRule]);

        $body = new GetFilterRulesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetFilterRulesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetFilterRulesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetFilterRulesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:GetFilterRulesRequest type="$type">
            <urn:account by="name">$value</urn:account>
            <urn:domain by="name">$value</urn:domain>
            <urn:cos by="name">$value</urn:cos>
            <urn:server by="name">$value</urn:server>
        </urn:GetFilterRulesRequest>
        <urn:GetFilterRulesResponse type="$type">
            <urn:account by="name">$value</urn:account>
            <urn:domain by="name">$value</urn:domain>
            <urn:cos by="name">$value</urn:cos>
            <urn:server by="name">$value</urn:server>
            <urn:filterRules>
                <urn1:filterRule name="$name" active="true">
                    <urn1:filterVariables index="$index">
                        <urn1:filterVariable name="$name" value="$value" />
                    </urn1:filterVariables>
                    <urn1:filterTests condition="allof">
                        <urn1:addressBookTest index="$index" negative="true" header="$header" />
                        <urn1:addressTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" />
                        <urn1:envelopeTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" />
                        <urn1:attachmentTest index="$index" negative="true" />
                        <urn1:bodyTest index="$index" negative="true" value="$value" caseSensitive="true" />
                        <urn1:bulkTest index="$index" negative="true" />
                        <urn1:contactRankingTest index="$index" negative="true" header="$header" />
                        <urn1:conversationTest index="$index" negative="true" where="$where" />
                        <urn1:currentDayOfWeekTest index="$index" negative="true" value="$value" />
                        <urn1:currentTimeTest index="$index" negative="true" dateComparison="before" time="$time" />
                        <urn1:dateTest index="$index" negative="true" dateComparison="before" date="$date" />
                        <urn1:facebookTest index="$index" negative="true" />
                        <urn1:flaggedTest index="$index" negative="true" flagName="$flag" />
                        <urn1:headerExistsTest index="$index" negative="true" header="$header" />
                        <urn1:headerTest index="$index" negative="true" header="$header" stringComparison="is" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" value="$value" caseSensitive="true" />
                        <urn1:importanceTest index="$index" negative="true" imp="high" />
                        <urn1:inviteTest index="$index" negative="true">
                            <urn1:method>$method</urn1:method>
                        </urn1:inviteTest>
                        <urn1:linkedinTest index="$index" negative="true" />
                        <urn1:listTest index="$index" negative="true" />
                        <urn1:meTest index="$index" negative="true" header="$header" />
                        <urn1:mimeHeaderTest index="$index" negative="true" header="$header" stringComparison="is" value="$value" caseSensitive="true" />
                        <urn1:sizeTest index="$index" negative="true" numberComparison="over" s="$size" />
                        <urn1:socialcastTest index="$index" negative="true" />
                        <urn1:trueTest index="$index" negative="true" />
                        <urn1:twitterTest index="$index" negative="true" />
                        <urn1:communityRequestsTest index="$index" negative="true" />
                        <urn1:communityContentTest index="$index" negative="true" />
                        <urn1:communityConnectionsTest index="$index" negative="true" />
                    </urn1:filterTests>
                    <urn1:filterActions>
                        <urn1:filterVariables index="$index">
                            <urn1:filterVariable name="$name" value="$value" />
                        </urn1:filterVariables>
                        <urn1:actionKeep index="$index" />
                        <urn1:actionDiscard index="$index" />
                        <urn1:actionFileInto index="$index" folderPath="$folder" copy="true" />
                        <urn1:actionFlag index="$index" flagName="$flag" />
                        <urn1:actionTag index="$index" tagName="$tag" />
                        <urn1:actionRedirect index="$index" a="$address" copy="true" />
                        <urn1:actionReply index="$index">
                            <urn1:content>$content</urn1:content>
                        </urn1:actionReply>
                        <urn1:actionNotify index="$index" a="$address" su="$subject" maxBodySize="$maxBodySize" origHeaders="$origHeaders">
                            <urn1:content>$content</urn1:content>
                        </urn1:actionNotify>
                        <urn1:actionRFCCompliantNotify index="$index" from="$from" importance="$importance" options="$options" message="$message">
                            <urn1:method>$method</urn1:method>
                        </urn1:actionRFCCompliantNotify>
                        <urn1:actionStop index="$index" />
                        <urn1:actionReject index="$index">$content</urn1:actionReject>
                        <urn1:actionEreject index="$index">$content</urn1:actionEreject>
                        <urn1:actionLog index="$index" level="info">$content</urn1:actionLog>
                        <urn1:actionAddheader index="$index" last="true">
                            <urn1:headerName>$headerName</urn1:headerName>
                            <urn1:headerValue>$headerValue</urn1:headerValue>
                        </urn1:actionAddheader>
                        <urn1:actionDeleteheader index="$index" last="true" offset="$offset">
                            <urn1:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn1:headerName>$headerName</urn1:headerName>
                                <urn1:headerValue>$headerValue</urn1:headerValue>
                            </urn1:test>
                        </urn1:actionDeleteheader>
                        <urn1:actionReplaceheader index="$index" last="true" offset="$offset">
                            <urn1:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn1:headerName>$headerName</urn1:headerName>
                                <urn1:headerValue>$headerValue</urn1:headerValue>
                            </urn1:test>
                            <urn1:newName>$newName</urn1:newName>
                            <urn1:newValue>$newValue</urn1:newValue>
                        </urn1:actionReplaceheader>
                    </urn1:filterActions>
                    <urn1:nestedRule>
                        <urn1:filterTests condition="allof" />
                    </urn1:nestedRule>
                </urn1:filterRule>
            </urn:filterRules>
        </urn:GetFilterRulesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetFilterRulesEnvelope::class, 'xml'));
    }
}
