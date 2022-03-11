<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\SerializerFactory;
use Zimbra\Mail\SerializerHandler;
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
use Zimbra\Enum\FilterCondition;
use Zimbra\Enum\Importance;
use Zimbra\Enum\DateComparison;
use Zimbra\Enum\NumberComparison;
use Zimbra\Enum\{AddressPart, ComparisonComparator, CountComparison, StringComparison, ValueComparison};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FilterTests.
 */
class FilterTestsTest extends ZimbraTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testFilterTests()
    {
        $index = mt_rand(1, 99);
        $header = $this->faker->word;
        $value = $this->faker->word;
        $where = $this->faker->word;
        $time = $this->faker->word;
        $date = time();
        $flag = $this->faker->word;
        $method = $this->faker->word;
        $size = $this->faker->word;

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

        $tests = new FilterTests(
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
        $this->assertEquals(FilterCondition::ALL_OF(), $tests->getCondition());
        $this->assertEquals([
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
        ], array_values($tests->getTests()));
        $tests = new FilterTests(FilterCondition::ANY_OF());
        $tests->setCondition(FilterCondition::ALL_OF())
            ->setTests([
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
            ])
            ->addTest($communityRequestsTest)
            ->addTest($communityContentTest)
            ->addTest($communityConnectionsTest);
        $this->assertEquals(FilterCondition::ALL_OF(), $tests->getCondition());
        $this->assertEquals([
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
        ], array_values($tests->getTests()));

        $xml = <<<EOT
<?xml version="1.0"?>
<result condition="allof">
    <addressBookTest index="$index" negative="true" header="$header"/>
    <addressTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet"/>
    <envelopeTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet"/>
    <attachmentTest index="$index" negative="true"/>
    <bodyTest index="$index" negative="true" value="$value" caseSensitive="true"/>
    <bulkTest index="$index" negative="true"/>
    <contactRankingTest index="$index" negative="true" header="$header"/>
    <conversationTest index="$index" negative="true" where="$where"/>
    <currentDayOfWeekTest index="$index" negative="true" value="$value"/>
    <currentTimeTest index="$index" negative="true" dateComparison="before" time="$time"/>
    <dateTest index="$index" negative="true" dateComparison="before" date="$date"/>
    <facebookTest index="$index" negative="true"/>
    <flaggedTest index="$index" negative="true" flagName="$flag"/>
    <headerExistsTest index="$index" negative="true" header="$header"/>
    <headerTest index="$index" negative="true" header="$header" stringComparison="is" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" value="$value" caseSensitive="true"/>
    <importanceTest index="$index" negative="true" imp="high"/>
    <inviteTest index="$index" negative="true">
        <method>$method</method>
    </inviteTest>
    <linkedinTest index="$index" negative="true"/>
    <listTest index="$index" negative="true"/>
    <meTest index="$index" negative="true" header="$header"/>
    <mimeHeaderTest index="$index" negative="true" header="$header" stringComparison="is" value="$value" caseSensitive="true"/>
    <sizeTest index="$index" negative="true" numberComparison="over" s="$size"/>
    <socialcastTest index="$index" negative="true"/>
    <trueTest index="$index" negative="true"/>
    <twitterTest index="$index" negative="true"/>
    <communityRequestsTest index="$index" negative="true"/>
    <communityContentTest index="$index" negative="true"/>
    <communityConnectionsTest index="$index" negative="true"/>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($tests, 'xml'));
        $this->assertEquals($tests, $this->serializer->deserialize($xml, FilterTests::class, 'xml'));

        $json = json_encode([
            'condition' => 'allof',
            'addressBookTest' => [
                'index' => $index,
                'negative' => TRUE,
                'header' => $header,
            ],
            'addressTest' => [
                'index' => $index,
                'negative' => TRUE,
                'header' => $header,
                'part' => 'all',
                'stringComparison' => 'is',
                'caseSensitive' => TRUE,
                'value' => $value,
                'valueComparison' => 'eq',
                'countComparison' => 'eq',
                'valueComparisonComparator' => 'i;octet',
            ],
            'envelopeTest' => [
                'index' => $index,
                'negative' => TRUE,
                'header' => $header,
                'part' => 'all',
                'stringComparison' => 'is',
                'caseSensitive' => TRUE,
                'value' => $value,
                'valueComparison' => 'eq',
                'countComparison' => 'eq',
                'valueComparisonComparator' => 'i;octet',
            ],
            'attachmentTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'bodyTest' => [
                'index' => $index,
                'negative' => TRUE,
                'value' => $value,
                'caseSensitive' => TRUE,
            ],
            'bulkTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'contactRankingTest' => [
                'index' => $index,
                'negative' => TRUE,
                'header' => $header,
            ],
            'conversationTest' => [
                'index' => $index,
                'negative' => TRUE,
                'where' => $where,
            ],
            'currentDayOfWeekTest' => [
                'index' => $index,
                'negative' => TRUE,
                'value' => $value,
            ],
            'currentTimeTest' => [
                'index' => $index,
                'negative' => TRUE,
                'dateComparison' => 'before',
                'time' => $time,
            ],
            'dateTest' => [
                'index' => $index,
                'negative' => TRUE,
                'dateComparison' => 'before',
                'date' => $date,
            ],
            'facebookTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'flaggedTest' => [
                'index' => $index,
                'negative' => TRUE,
                'flagName' => $flag,
            ],
            'headerExistsTest' => [
                'index' => $index,
                'negative' => TRUE,
                'header' => $header,
            ],
            'headerTest' => [
                'index' => $index,
                'negative' => TRUE,
                'header' => $header,
                'stringComparison' => 'is',
                'valueComparison' => 'eq',
                'countComparison' => 'eq',
                'valueComparisonComparator' => 'i;octet',
                'value' => $value,
                'caseSensitive' => TRUE,
            ],
            'importanceTest' => [
                'index' => $index,
                'negative' => TRUE,
                'imp' => 'high',
            ],
            'inviteTest' => [
                'index' => $index,
                'negative' => TRUE,
                'method' => [
                    ['_content' => $method],
                ],
            ],
            'linkedinTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'listTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'meTest' => [
                'index' => $index,
                'negative' => TRUE,
                'header' => $header,
            ],
            'mimeHeaderTest' => [
                'index' => $index,
                'negative' => TRUE,
                'header' => $header,
                'stringComparison' => 'is',
                'value' => $value,
                'caseSensitive' => TRUE,
            ],
            'sizeTest' => [
                'index' => $index,
                'negative' => TRUE,
                'numberComparison' => 'over',
                's' => $size,
            ],
            'socialcastTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'trueTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'twitterTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'communityRequestsTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'communityContentTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
            'communityConnectionsTest' => [
                'index' => $index,
                'negative' => TRUE,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($tests, 'json'));
        $this->assertEquals($tests, $this->serializer->deserialize($json, FilterTests::class, 'json'));
    }
}
