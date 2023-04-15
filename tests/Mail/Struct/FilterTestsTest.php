<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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
use Zimbra\Common\Enum\FilterCondition;
use Zimbra\Common\Enum\Importance;
use Zimbra\Common\Enum\DateComparison;
use Zimbra\Common\Enum\NumberComparison;
use Zimbra\Common\Enum\{AddressPart, ComparisonComparator, CountComparison, StringComparison, ValueComparison};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FilterTests.
 */
class FilterTestsTest extends ZimbraTestCase
{
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
            $index, TRUE, $header, AddressPart::ALL, StringComparison::IS, TRUE, $value, ValueComparison::EQUAL, CountComparison::EQUAL, ComparisonComparator::OCTET
        );
        $envelopeTest = new EnvelopeTest(
            $index, TRUE, $header, AddressPart::ALL, StringComparison::IS, TRUE, $value, ValueComparison::EQUAL, CountComparison::EQUAL, ComparisonComparator::OCTET
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
            $index, TRUE, DateComparison::BEFORE, $time
        );
        $dateTest = new DateTest(
            $index, TRUE, DateComparison::BEFORE, $date
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
            $index, TRUE, $header, StringComparison::IS, ValueComparison::EQUAL, CountComparison::EQUAL, ComparisonComparator::OCTET, $value, TRUE
        );
        $importanceTest = new ImportanceTest(
            $index, TRUE, Importance::HIGH
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
            $index, TRUE, $header, StringComparison::IS, $value, TRUE
        );
        $sizeTest = new SizeTest(
            $index, TRUE, NumberComparison::OVER, $size
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

        $tests = new StubFilterTests(
            FilterCondition::ALL_OF, [
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
        $this->assertEquals(FilterCondition::ALL_OF, $tests->getCondition());
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
        $tests = new StubFilterTests(FilterCondition::ANY_OF);
        $tests->setCondition(FilterCondition::ALL_OF)
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
        $this->assertEquals(FilterCondition::ALL_OF, $tests->getCondition());
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
<result condition="allof" xmlns:urn="urn:zimbraMail">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($tests, 'xml'));
        $this->assertEquals($tests, $this->serializer->deserialize($xml, StubFilterTests::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubFilterTests extends FilterTests
{
}
