<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{
    Accessor, Exclude, SerializedName, Type, VirtualProperty, XmlAttribute, XmlList
};
use Zimbra\Common\Enum\FilterCondition;

/**
 * FilterTests struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FilterTests
{
    /**
     * Condition - allof|anyof
     * 
     * @Accessor(getter="getCondition", setter="setCondition")
     * @SerializedName("condition")
     * @Type("Zimbra\Common\Enum\FilterCondition")
     * @XmlAttribute
     */
    private FilterCondition $condition;

    /**
     * Tests
     * 
     * @Exclude
     */
    private $tests = [];

    /**
     * Constructor method for FilterTests
     * 
     * @param FilterCondition $condition
     * @param array $tests
     * @return self
     */
    public function __construct(?FilterCondition $condition = NULL, array $tests = [])
    {
        $this->setTests($tests)
             ->setCondition($condition ?? FilterCondition::ALL_OF());
    }

    /**
     * Gets condition
     *
     * @return FilterCondition
     */
    public function getCondition(): FilterCondition
    {
        return $this->condition;
    }

    /**
     * Sets condition
     *
     * @param  FilterCondition $condition
     * @return self
     */
    public function setCondition(FilterCondition $condition)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * Gets address book filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\AddressBookTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="addressBookTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getAddressBookTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof AddressBookTest);
    }

    /**
     * Gets address filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\AddressTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="addressTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getAddressTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof AddressTest);
    }

    /**
     * Gets envelope filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\EnvelopeTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="envelopeTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getEnvelopeTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof EnvelopeTest);
    }

    /**
     * Gets attachment filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\AttachmentTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="attachmentTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getAttachmentTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof AttachmentTest);
    }

    /**
     * Gets body filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\BodyTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="bodyTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getBodyTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof BodyTest);
    }

    /**
     * Gets bulk filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\BulkTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="bulkTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getBulkTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof BulkTest);
    }

    /**
     * Gets contact ranking filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\ContactRankingTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="contactRankingTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getContactRankingTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof ContactRankingTest);
    }

    /**
     * Gets conversation filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\ConversationTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="conversationTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getConversationTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof ConversationTest);
    }

    /**
     * Gets current day of week filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\CurrentDayOfWeekTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="currentDayOfWeekTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getCurrentDayOfWeekTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof CurrentDayOfWeekTest);
    }

    /**
     * Gets current time filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\CurrentTimeTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="currentTimeTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getCurrentTimeTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof CurrentTimeTest);
    }

    /**
     * Gets date filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\DateTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="dateTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getDateTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof DateTest);
    }

    /**
     * Gets facebook filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\FacebookTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="facebookTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getFacebookTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof FacebookTest);
    }

    /**
     * Gets flagged filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\FlaggedTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="flaggedTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getFlaggedTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof FlaggedTest);
    }

    /**
     * Gets header exists filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\HeaderExistsTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="headerExistsTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getHeaderExistsTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof HeaderExistsTest);
    }

    /**
     * Gets header filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\HeaderTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="headerTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getHeaderTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof HeaderTest);
    }

    /**
     * Gets importance filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\ImportanceTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="importanceTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getImportanceTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof ImportanceTest);
    }

    /**
     * Gets invite filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\InviteTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="inviteTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getInviteTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof InviteTest);
    }

    /**
     * Gets linkedin filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\LinkedInTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="linkedinTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getLinkedInTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof LinkedInTest);
    }

    /**
     * Gets list filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\ListTest>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="listTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getListTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof ListTest);
    }

    /**
     * Gets me filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\MeTest>")
     * @VirtualProperty
     * @XmlMe(inline=true, entry="meTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getMeTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof MeTest);
    }

    /**
     * Gets mime header filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\MimeHeaderTest>")
     * @VirtualProperty
     * @XmlMimeHeader(inline=true, entry="mimeHeaderTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getMimeHeaderTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof MimeHeaderTest);
    }

    /**
     * Gets size filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\SizeTest>")
     * @VirtualProperty
     * @XmlSize(inline=true, entry="sizeTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getSizeTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof SizeTest);
    }

    /**
     * Gets socialcast filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\SocialcastTest>")
     * @VirtualProperty
     * @XmlSocialcast(inline=true, entry="socialcastTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getSocialcastTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof SocialcastTest);
    }

    /**
     * Gets true filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\TrueTest>")
     * @VirtualProperty
     * @XmlTrue(inline=true, entry="trueTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getTrueTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof TrueTest);
    }

    /**
     * Gets twitter filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\TwitterTest>")
     * @VirtualProperty
     * @XmlTwitter(inline=true, entry="twitterTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getTwitterTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof TwitterTest);
    }

    /**
     * Gets community requests filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\CommunityRequestsTest>")
     * @VirtualProperty
     * @XmlCommunityRequests(inline=true, entry="communityRequestsTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getCommunityRequestsTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof CommunityRequestsTest);
    }

    /**
     * Gets community content filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\CommunityContentTest>")
     * @VirtualProperty
     * @XmlCommunityContent(inline=true, entry="communityContentTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getCommunityContentTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof CommunityContentTest);
    }

    /**
     * Gets community connections filter tests
     *
     * @Type("array<Zimbra\Mail\Struct\CommunityConnectionsTest>")
     * @VirtualProperty
     * @XmlCommunityConnections(inline=true, entry="communityConnectionsTest", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getCommunityConnectionsTests(): array
    {
        return array_filter($this->tests, static fn ($test) => $test instanceof CommunityConnectionsTest);
    }

    /**
     * Gets tests
     *
     * @return array
     */
    public function getTests(): array
    {
        return $this->tests;
    }

    /**
     * Sets tests
     *
     * @param  array $tests
     * @return self
     */
    public function setTests(array $tests): self
    {
        $this->tests = array_filter($tests, static fn ($test) => $test instanceof FilterTest);
        return $this;
    }

    /**
     * Add test
     *
     * @param  FilterTest $test
     * @return self
     */
    public function addTest(FilterTest $test): self
    {
        $this->tests[] = $test;
        return $this;
    }

    public static function filterTestTypes(): array
    {
        return [
            'addressBookTest' => AddressBookTest::class,
            'addressTest' => AddressTest::class,
            'envelopeTest' => EnvelopeTest::class,
            'attachmentTest' => AttachmentTest::class,
            'bodyTest' => BodyTest::class,
            'bulkTest' => BulkTest::class,
            'contactRankingTest' => ContactRankingTest::class,
            'conversationTest' => ConversationTest::class,
            'currentDayOfWeekTest' => CurrentDayOfWeekTest::class,
            'currentTimeTest' => CurrentTimeTest::class,
            'dateTest' => DateTest::class,
            'facebookTest' => FacebookTest::class,
            'flaggedTest' => FlaggedTest::class,
            'headerExistsTest' => HeaderExistsTest::class,
            'headerTest' => HeaderTest::class,
            'importanceTest' => ImportanceTest::class,
            'inviteTest' => InviteTest::class,
            'linkedinTest' => LinkedInTest::class,
            'listTest' => ListTest::class,
            'meTest' => MeTest::class,
            'mimeHeaderTest' => MimeHeaderTest::class,
            'sizeTest' => SizeTest::class,
            'socialcastTest' => SocialcastTest::class,
            'trueTest' => TrueTest::class,
            'twitterTest' => TwitterTest::class,
            'communityRequestsTest' => CommunityRequestsTest::class,
            'communityContentTest' => CommunityContentTest::class,
            'communityConnectionsTest' => CommunityConnectionsTest::class,
        ];
    }
}
