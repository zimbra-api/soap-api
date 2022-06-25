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
    Accessor, Inline, SerializedName, Type, XmlAttribute, XmlKeyValuePairs
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
     * @Accessor(getter="getCondition", setter="setCondition")
     * @SerializedName("condition")
     * @Type("Zimbra\Common\Enum\FilterCondition")
     * @XmlAttribute
     */
    private FilterCondition $condition;

    /**
     * Tests
     * @Accessor(getter="getTests", setter="setTests")
     * @Type("array<string, Zimbra\Mail\Struct\FilterTest>")
     * @Inline
     * @XmlKeyValuePairs
     */
    private $tests = [];

    /**
     * Constructor method for FilterTests
     * 
     * @param FilterCondition $condition
     * @param array $tests
     * @return self
     */
    public function __construct(FilterCondition $condition, array $tests = [])
    {
        $this->setCondition($condition)
             ->setTests($tests);
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
        $this->tests = [];
        foreach ($tests as $test) {
            if ($test instanceof FilterTest) {
                $this->addTest($test);
            }
        }
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
        foreach (self::filterTestTypes() as $key => $type) {
            if (get_class($test) === $type) {
                $this->tests[$key] = $test;
            }
        }
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
