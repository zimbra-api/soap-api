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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Enum\FilterCondition;

/**
 * FilterTests struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FilterTests
{
    /**
     * Condition - allof|anyof
     * 
     * @Accessor(getter="getCondition", setter="setCondition")
     * @SerializedName("condition")
     * @Type("Enum<Zimbra\Common\Enum\FilterCondition>")
     * @XmlAttribute
     */
    private FilterCondition $condition;

    /**
     * Address book filter tests
     * 
     * @Accessor(getter="getAddressBookTests", setter="setAddressBookTests")
     * @Type("array<Zimbra\Mail\Struct\AddressBookTest>")
     * @XmlList(inline=true, entry="addressBookTest", namespace="urn:zimbraMail")
     */
    private $addressBookTests = [];

    /**
     * Address filter tests
     * 
     * @Accessor(getter="getAddressTests", setter="setAddressTests")
     * @Type("array<Zimbra\Mail\Struct\AddressTest>")
     * @XmlList(inline=true, entry="addressTest", namespace="urn:zimbraMail")
     */
    private $addressTests = [];

    /**
     * Envelope filter tests
     * 
     * @Accessor(getter="getEnvelopeTests", setter="setEnvelopeTests")
     * @Type("array<Zimbra\Mail\Struct\EnvelopeTest>")
     * @XmlList(inline=true, entry="envelopeTest", namespace="urn:zimbraMail")
     */
    private $envelopeTests = [];

    /**
     * Attachment filter tests
     * 
     * @Accessor(getter="getAttachmentTests", setter="setAttachmentTests")
     * @Type("array<Zimbra\Mail\Struct\AttachmentTest>")
     * @XmlList(inline=true, entry="attachmentTest", namespace="urn:zimbraMail")
     */
    private $attachmentTests = [];

    /**
     * Body filter tests
     * 
     * @Accessor(getter="getBodyTests", setter="setBodyTests")
     * @Type("array<Zimbra\Mail\Struct\BodyTest>")
     * @XmlList(inline=true, entry="bodyTest", namespace="urn:zimbraMail")
     */
    private $bodyTests = [];

    /**
     * Bulk filter tests
     * 
     * @Accessor(getter="getBulkTests", setter="setBulkTests")
     * @Type("array<Zimbra\Mail\Struct\BulkTest>")
     * @XmlList(inline=true, entry="bulkTest", namespace="urn:zimbraMail")
     */
    private $bulkTests = [];

    /**
     * Contact ranking filter tests
     * 
     * @Accessor(getter="getContactRankingTests", setter="setContactRankingTests")
     * @Type("array<Zimbra\Mail\Struct\ContactRankingTest>")
     * @XmlList(inline=true, entry="contactRankingTest", namespace="urn:zimbraMail")
     */
    private $contactRankingTests = [];

    /**
     * Conversation filter tests
     * 
     * @Accessor(getter="getConversationTests", setter="setConversationTests")
     * @Type("array<Zimbra\Mail\Struct\ConversationTest>")
     * @XmlList(inline=true, entry="conversationTest", namespace="urn:zimbraMail")
     */
    private $conversationTests = [];

    /**
     * Current day of week filter tests
     * 
     * @Accessor(getter="getCurrentDayOfWeekTests", setter="setCurrentDayOfWeekTests")
     * @Type("array<Zimbra\Mail\Struct\CurrentDayOfWeekTest>")
     * @XmlList(inline=true, entry="currentDayOfWeekTest", namespace="urn:zimbraMail")
     */
    private $currentDayOfWeekTests = [];

    /**
     * Current time filter tests
     * 
     * @Accessor(getter="getCurrentTimeTests", setter="setCurrentTimeTests")
     * @Type("array<Zimbra\Mail\Struct\CurrentTimeTest>")
     * @XmlList(inline=true, entry="currentTimeTest", namespace="urn:zimbraMail")
     */
    private $currentTimeTests = [];

    /**
     * Date filter tests
     * 
     * @Accessor(getter="getDateTests", setter="setDateTests")
     * @Type("array<Zimbra\Mail\Struct\DateTest>")
     * @XmlList(inline=true, entry="dateTest", namespace="urn:zimbraMail")
     */
    private $dateTests = [];

    /**
     * Facebook filter tests
     * 
     * @Accessor(getter="getFacebookTests", setter="setFacebookTests")
     * @Type("array<Zimbra\Mail\Struct\FacebookTest>")
     * @XmlList(inline=true, entry="facebookTest", namespace="urn:zimbraMail")
     */
    private $facebookTests = [];

    /**
     * Flagged filter tests
     * 
     * @Accessor(getter="getFlaggedTests", setter="setFlaggedTests")
     * @Type("array<Zimbra\Mail\Struct\FlaggedTest>")
     * @XmlList(inline=true, entry="flaggedTest", namespace="urn:zimbraMail")
     */
    private $flaggedTests = [];

    /**
     * Header exists filter tests
     * 
     * @Accessor(getter="getHeaderExistsTests", setter="setHeaderExistsTests")
     * @Type("array<Zimbra\Mail\Struct\HeaderExistsTest>")
     * @XmlList(inline=true, entry="headerExistsTest", namespace="urn:zimbraMail")
     */
    private $headerExistsTests = [];

    /**
     * Header filter tests
     * 
     * @Accessor(getter="getHeaderTests", setter="setHeaderTests")
     * @Type("array<Zimbra\Mail\Struct\HeaderTest>")
     * @XmlList(inline=true, entry="headerTest", namespace="urn:zimbraMail")
     */
    private $headerTests = [];

    /**
     * Importance filter tests
     * 
     * @Accessor(getter="getImportanceTests", setter="setImportanceTests")
     * @Type("array<Zimbra\Mail\Struct\ImportanceTest>")
     * @XmlList(inline=true, entry="importanceTest", namespace="urn:zimbraMail")
     */
    private $importanceTests = [];

    /**
     * Invite filter tests
     * 
     * @Accessor(getter="getInviteTests", setter="setInviteTests")
     * @Type("array<Zimbra\Mail\Struct\InviteTest>")
     * @XmlList(inline=true, entry="inviteTest", namespace="urn:zimbraMail")
     */
    private $inviteTests = [];

    /**
     * LinkedIn filter tests
     * 
     * @Accessor(getter="getLinkedInTests", setter="setLinkedInTests")
     * @Type("array<Zimbra\Mail\Struct\LinkedInTest>")
     * @XmlList(inline=true, entry="linkedinTest", namespace="urn:zimbraMail")
     */
    private $linkedinTests = [];

    /**
     * List filter tests
     * 
     * @Accessor(getter="getListTests", setter="setListTests")
     * @Type("array<Zimbra\Mail\Struct\ListTest>")
     * @XmlList(inline=true, entry="listTest", namespace="urn:zimbraMail")
     */
    private $listTests = [];

    /**
     * Me filter tests
     * 
     * @Accessor(getter="getMeTests", setter="setMeTests")
     * @Type("array<Zimbra\Mail\Struct\MeTest>")
     * @XmlList(inline=true, entry="meTest", namespace="urn:zimbraMail")
     */
    private $meTests = [];

    /**
     * Mime header filter tests
     * 
     * @Accessor(getter="getMimeHeaderTests", setter="setMimeHeaderTests")
     * @Type("array<Zimbra\Mail\Struct\MimeHeaderTest>")
     * @XmlList(inline=true, entry="mimeHeaderTest", namespace="urn:zimbraMail")
     */
    private $mimeHeaderTests = [];

    /**
     * Size filter tests
     * 
     * @Accessor(getter="getSizeTests", setter="setSizeTests")
     * @Type("array<Zimbra\Mail\Struct\SizeTest>")
     * @XmlList(inline=true, entry="sizeTest", namespace="urn:zimbraMail")
     */
    private $sizeTests = [];

    /**
     * Socialcast filter tests
     * 
     * @Accessor(getter="getSocialcastTests", setter="setSocialcastTests")
     * @Type("array<Zimbra\Mail\Struct\SocialcastTest>")
     * @XmlList(inline=true, entry="socialcastTest", namespace="urn:zimbraMail")
     */
    private $socialcastTests = [];

    /**
     * True filter tests
     * 
     * @Accessor(getter="getTrueTests", setter="setTrueTests")
     * @Type("array<Zimbra\Mail\Struct\TrueTest>")
     * @XmlList(inline=true, entry="trueTest", namespace="urn:zimbraMail")
     */
    private $trueTests = [];

    /**
     * Twitter filter tests
     * 
     * @Accessor(getter="getTwitterTests", setter="setTwitterTests")
     * @Type("array<Zimbra\Mail\Struct\TwitterTest>")
     * @XmlList(inline=true, entry="twitterTest", namespace="urn:zimbraMail")
     */
    private $twitterTests = [];

    /**
     * Community requests filter tests
     * 
     * @Accessor(getter="getCommunityRequestsTests", setter="setCommunityRequestsTests")
     * @Type("array<Zimbra\Mail\Struct\CommunityRequestsTest>")
     * @XmlList(inline=true, entry="communityRequestsTest", namespace="urn:zimbraMail")
     */
    private $communityRequestsTests = [];

    /**
     * Community content filter tests
     * 
     * @Accessor(getter="getCommunityContentTests", setter="setCommunityContentTests")
     * @Type("array<Zimbra\Mail\Struct\CommunityContentTest>")
     * @XmlList(inline=true, entry="communityContentTest", namespace="urn:zimbraMail")
     */
    private $communityContentTests = [];

    /**
     * Community connections filter tests
     * 
     * @Accessor(getter="getCommunityConnectionsTests", setter="setCommunityConnectionsTests")
     * @Type("array<Zimbra\Mail\Struct\CommunityConnectionsTest>")
     * @XmlList(inline=true, entry="communityConnectionsTest", namespace="urn:zimbraMail")
     */
    private $communityConnectionsTests = [];

    /**
     * Constructor
     * 
     * @param FilterCondition $condition
     * @param array $tests
     * @return self
     */
    public function __construct(?FilterCondition $condition = NULL, array $tests = [])
    {
        $this->setTests($tests)
             ->setCondition($condition ?? new FilterCondition('allof'));
    }

    /**
     * Get condition
     *
     * @return FilterCondition
     */
    public function getCondition(): FilterCondition
    {
        return $this->condition;
    }

    /**
     * Set condition
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
     * Get address book filter tests
     *
     * @return array
     */
    public function getAddressBookTests(): array
    {
        return $this->addressBookTests;
    }

    /**
     * Set address book filter tests
     *
     * @return self
     */
    public function setAddressBookTests(array $tests): self
    {
        $this->addressBookTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof AddressBookTest)
        );
        return $this;
    }

    /**
     * Get address filter tests
     *
     * @return array
     */
    public function getAddressTests(): array
    {
        return $this->addressTests;
    }

    /**
     * Set address filter tests
     *
     * @return self
     */
    public function setAddressTests(array $tests): self
    {
        $this->addressTests = array_values(
            array_filter($tests, static fn ($test) => get_class($test) === AddressTest::class)
        );
        return $this;
    }

    /**
     * Get envelope filter tests
     *
     * @return array
     */
    public function getEnvelopeTests(): array
    {
        return $this->envelopeTests;
    }

    /**
     * Set envelope filter tests
     *
     * @return self
     */
    public function setEnvelopeTests(array $tests): self
    {
        $this->envelopeTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof EnvelopeTest)
        );
        return $this;
    }

    /**
     * Get attachment filter tests
     *
     * @return array
     */
    public function getAttachmentTests(): array
    {
        return $this->attachmentTests;
    }

    /**
     * Set attachment filter tests
     *
     * @return self
     */
    public function setAttachmentTests(array $tests): self
    {
        $this->attachmentTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof AttachmentTest)
        );
        return $this;
    }

    /**
     * Get body filter tests
     *
     * @return array
     */
    public function getBodyTests(): array
    {
        return $this->bodyTests;
    }

    /**
     * Set body filter tests
     *
     * @return self
     */
    public function setBodyTests(array $tests): self
    {
        $this->bodyTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof BodyTest)
        );
        return $this;
    }

    /**
     * Get bulk filter tests
     *
     * @return array
     */
    public function getBulkTests(): array
    {
        return $this->bulkTests;
    }

    /**
     * Set bulk filter tests
     *
     * @return self
     */
    public function setBulkTests(array $tests): self
    {
        $this->bulkTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof BulkTest)
        );
        return $this;
    }

    /**
     * Get contact ranking filter tests
     *
     * @return array
     */
    public function getContactRankingTests(): array
    {
        return $this->contactRankingTests;
    }

    /**
     * Set contact ranking filter tests
     *
     * @return self
     */
    public function setContactRankingTests(array $tests): self
    {
        $this->contactRankingTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof ContactRankingTest)
        );
        return $this;
    }

    /**
     * Get conversation filter tests
     *
     * @return array
     */
    public function getConversationTests(): array
    {
        return $this->conversationTests;
    }

    /**
     * Get conversation filter tests
     *
     * @return self
     */
    public function setConversationTests(array $tests): self
    {
        $this->conversationTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof ConversationTest)
        );
        return $this;
    }

    /**
     * Get current day of week filter tests
     *
     * @return array
     */
    public function getCurrentDayOfWeekTests(): array
    {
        return $this->currentDayOfWeekTests;
    }

    /**
     * Set current day of week filter tests
     *
     * @return self
     */
    public function setCurrentDayOfWeekTests(array $tests): self
    {
        $this->currentDayOfWeekTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof CurrentDayOfWeekTest)
        );
        return $this;
    }

    /**
     * Get current time filter tests
     *
     * @return array
     */
    public function getCurrentTimeTests(): array
    {
        return $this->currentTimeTests;
    }

    /**
     * Set current time filter tests
     *
     * @return self
     */
    public function setCurrentTimeTests(array $tests): self
    {
        $this->currentTimeTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof CurrentTimeTest)
        );
        return $this;
    }

    /**
     * Get date filter tests
     *
     * @return array
     */
    public function getDateTests(): array
    {
        return $this->dateTests;
    }

    /**
     * Set date filter tests
     *
     * @return self
     */
    public function setDateTests(array $tests): self
    {
        $this->dateTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof DateTest)
        );
        return $this;
    }

    /**
     * Get facebook filter tests
     *
     * @return array
     */
    public function getFacebookTests(): array
    {
        return $this->facebookTests;
    }

    /**
     * Set facebook filter tests
     *
     * @return self
     */
    public function setFacebookTests(array $tests): self
    {
        $this->facebookTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof FacebookTest)
        );
        return $this;
    }

    /**
     * Get flagged filter tests
     *
     * @return array
     */
    public function getFlaggedTests(): array
    {
        return $this->flaggedTests;
    }

    /**
     * Get flagged filter tests
     *
     * @return self
     */
    public function setFlaggedTests(array $tests): self
    {
        $this->flaggedTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof FlaggedTest)
        );
        return $this;
    }

    /**
     * Get header exists filter tests
     *
     * @return array
     */
    public function getHeaderExistsTests(): array
    {
        return $this->headerExistsTests;
    }

    /**
     * Set header exists filter tests
     *
     * @return self
     */
    public function setHeaderExistsTests(array $tests): self
    {
        $this->headerExistsTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof HeaderExistsTest)
        );
        return $this;
    }

    /**
     * Get header filter tests
     *
     * @return array
     */
    public function getHeaderTests(): array
    {
        return $this->headerTests;
    }

    /**
     * Set header filter tests
     *
     * @return self
     */
    public function setHeaderTests(array $tests): self
    {
        $this->headerTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof HeaderTest)
        );
        return $this;
    }

    /**
     * Get importance filter tests
     *
     * @return array
     */
    public function getImportanceTests(): array
    {
        return $this->importanceTests;
    }

    /**
     * Set importance filter tests
     *
     * @return self
     */
    public function setImportanceTests(array $tests): self
    {
        $this->importanceTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof ImportanceTest)
        );
        return $this;
    }

    /**
     * Get invite filter tests
     *
     * @return array
     */
    public function getInviteTests(): array
    {
        return $this->inviteTests;
    }

    /**
     * Set invite filter tests
     *
     * @return self
     */
    public function setInviteTests(array $tests): self
    {
        $this->inviteTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof InviteTest)
        );
        return $this;
    }

    /**
     * Get linkedin filter tests
     *
     * @return array
     */
    public function getLinkedInTests(): array
    {
        return $this->linkedinTests;
    }

    /**
     * Set linkedin filter tests
     *
     * @return self
     */
    public function setLinkedInTests(array $tests): self
    {
        $this->linkedinTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof LinkedInTest)
        );
        return $this;
    }

    /**
     * Get list filter tests
     *
     * @return array
     */
    public function getListTests(): array
    {
        return $this->listTests;
    }

    /**
     * Set list filter tests
     *
     * @return self
     */
    public function setListTests(array $tests): self
    {
        $this->listTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof ListTest)
        );
        return $this;
    }

    /**
     * Get me filter tests
     *
     * @return array
     */
    public function getMeTests(): array
    {
        return $this->meTests;
    }

    /**
     * Set me filter tests
     *
     * @return self
     */
    public function setMeTests(array $tests): self
    {
        $this->meTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof MeTest)
        );
        return $this;
    }

    /**
     * Get mime header filter tests
     *
     * @return array
     */
    public function getMimeHeaderTests(): array
    {
        return $this->mimeHeaderTests;
    }

    /**
     * Set mime header filter tests
     *
     * @return self
     */
    public function setMimeHeaderTests(array $tests): self
    {
        $this->mimeHeaderTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof MimeHeaderTest)
        );
        return $this;
    }

    /**
     * Get size filter tests
     *
     * @return array
     */
    public function getSizeTests(): array
    {
        return $this->sizeTests;
    }

    /**
     * Set size filter tests
     *
     * @return self
     */
    public function setSizeTests(array $tests): self
    {
        $this->sizeTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof SizeTest)
        );
        return $this;
    }

    /**
     * Get socialcast filter tests
     *
     * @return array
     */
    public function getSocialcastTests(): array
    {
        return $this->socialcastTests;
    }

    /**
     * Set socialcast filter tests
     *
     * @return self
     */
    public function setSocialcastTests(array $tests): self
    {
        $this->socialcastTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof SocialcastTest)
        );
        return $this;
    }

    /**
     * Get true filter tests
     *
     * @return array
     */
    public function getTrueTests(): array
    {
        return $this->trueTests;
    }

    /**
     * Set true filter tests
     *
     * @return self
     */
    public function setTrueTests(array $tests): self
    {
        $this->trueTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof TrueTest)
        );
        return $this;
    }

    /**
     * Get twitter filter tests
     *
     * @return array
     */
    public function getTwitterTests(): array
    {
        return $this->twitterTests;
    }

    /**
     * Set twitter filter tests
     *
     * @return self
     */
    public function setTwitterTests(array $tests): self
    {
        $this->twitterTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof TwitterTest)
        );
        return $this;
    }

    /**
     * Get community requests filter tests
     *
     * @return array
     */
    public function getCommunityRequestsTests(): array
    {
        return $this->communityRequestsTests;
    }

    /**
     * Set community requests filter tests
     *
     * @return self
     */
    public function setCommunityRequestsTests(array $tests): self
    {
        $this->communityRequestsTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof CommunityRequestsTest)
        );
        return $this;
    }

    /**
     * Get community content filter tests
     *
     * @return array
     */
    public function getCommunityContentTests(): array
    {
        return $this->communityContentTests;
    }

    /**
     * Set community content filter tests
     *
     * @return self
     */
    public function setCommunityContentTests(array $tests): self
    {
        $this->communityContentTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof CommunityContentTest)
        );
        return $this;
    }

    /**
     * Get community connections filter tests
     *
     * @return array
     */
    public function getCommunityConnectionsTests(): array
    {
        return $this->communityConnectionsTests;
    }

    /**
     * Set community connections filter tests
     *
     * @return self
     */
    public function setCommunityConnectionsTests(array $tests): self
    {
        $this->communityConnectionsTests = array_values(
            array_filter($tests, static fn ($test) => $test instanceof CommunityConnectionsTest)
        );
        return $this;
    }

    /**
     * Get tests
     *
     * @return array
     */
    public function getTests(): array
    {
        return array_merge(
            $this->addressBookTests,
            $this->addressTests,
            $this->envelopeTests,
            $this->attachmentTests,
            $this->bodyTests,
            $this->bulkTests,
            $this->contactRankingTests,
            $this->conversationTests,
            $this->currentDayOfWeekTests,
            $this->currentTimeTests,
            $this->dateTests,
            $this->facebookTests,
            $this->flaggedTests,
            $this->headerExistsTests,
            $this->headerTests,
            $this->importanceTests,
            $this->inviteTests,
            $this->linkedinTests,
            $this->listTests,
            $this->meTests,
            $this->mimeHeaderTests,
            $this->sizeTests,
            $this->socialcastTests,
            $this->trueTests,
            $this->twitterTests,
            $this->communityRequestsTests,
            $this->communityContentTests,
            $this->communityConnectionsTests
        );
    }

    /**
     * Set tests
     *
     * @param  array $tests
     * @return self
     */
    public function setTests(array $tests): self
    {
        $this->setAddressBookTests($tests)
             ->setAddressTests($tests)
             ->setEnvelopeTests($tests)
             ->setAttachmentTests($tests)
             ->setBodyTests($tests)
             ->setBulkTests($tests)
             ->setContactRankingTests($tests)
             ->setConversationTests($tests)
             ->setCurrentDayOfWeekTests($tests)
             ->setCurrentTimeTests($tests)
             ->setDateTests($tests)
             ->setFacebookTests($tests)
             ->setFlaggedTests($tests)
             ->setHeaderExistsTests($tests)
             ->setHeaderTests($tests)
             ->setImportanceTests($tests)
             ->setInviteTests($tests)
             ->setLinkedInTests($tests)
             ->setListTests($tests)
             ->setMeTests($tests)
             ->setMimeHeaderTests($tests)
             ->setSizeTests($tests)
             ->setSocialcastTests($tests)
             ->setTrueTests($tests)
             ->setTwitterTests($tests)
             ->setCommunityRequestsTests($tests)
             ->setCommunityContentTests($tests)
             ->setCommunityConnectionsTests($tests);
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
        if ($test instanceof AddressBookTest) {
            $this->addressBookTests[] = $test;
        }
        if (get_class($test) === AddressTest::class) {
            $this->addressTests[] = $test;
        }
        if ($test instanceof EnvelopeTest) {
            $this->envelopeTests[] = $test;
        }
        if ($test instanceof AttachmentTest) {
            $this->attachmentTests[] = $test;
        }
        if ($test instanceof BodyTest) {
            $this->bodyTests[] = $test;
        }
        if ($test instanceof BulkTest) {
            $this->bulkTests[] = $test;
        }
        if ($test instanceof ContactRankingTest) {
            $this->contactRankingTests[] = $test;
        }
        if ($test instanceof ConversationTest) {
            $this->conversationTests[] = $test;
        }
        if ($test instanceof CurrentDayOfWeekTest) {
            $this->currentDayOfWeekTests[] = $test;
        }
        if ($test instanceof CurrentTimeTest) {
            $this->currentTimeTests[] = $test;
        }
        if ($test instanceof DateTest) {
            $this->dateTests[] = $test;
        }
        if ($test instanceof FacebookTest) {
            $this->facebookTests[] = $test;
        }
        if ($test instanceof FlaggedTest) {
            $this->flaggedTests[] = $test;
        }
        if ($test instanceof HeaderExistsTest) {
            $this->headerExistsTests[] = $test;
        }
        if ($test instanceof HeaderTest) {
            $this->headerTests[] = $test;
        }
        if ($test instanceof ImportanceTest) {
            $this->importanceTests[] = $test;
        }
        if ($test instanceof InviteTest) {
            $this->inviteTests[] = $test;
        }
        if ($test instanceof LinkedInTest) {
            $this->linkedinTests[] = $test;
        }
        if ($test instanceof ListTest) {
            $this->listTests[] = $test;
        }
        if ($test instanceof MeTest) {
            $this->meTests[] = $test;
        }
        if ($test instanceof MimeHeaderTest) {
            $this->mimeHeaderTests[] = $test;
        }
        if ($test instanceof SizeTest) {
            $this->sizeTests[] = $test;
        }
        if ($test instanceof SocialcastTest) {
            $this->socialcastTests[] = $test;
        }
        if ($test instanceof TrueTest) {
            $this->trueTests[] = $test;
        }
        if ($test instanceof TwitterTest) {
            $this->twitterTests[] = $test;
        }
        if ($test instanceof CommunityRequestsTest) {
            $this->communityRequestsTests[] = $test;
        }
        if ($test instanceof CommunityContentTest) {
            $this->communityContentTests[] = $test;
        }
        if ($test instanceof CommunityConnectionsTest) {
            $this->communityConnectionsTests[] = $test;
        }
        return $this;
    }
}
