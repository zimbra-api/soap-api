<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\FilterCondition;
use Zimbra\Struct\Base;

/**
 * FilterTests struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterTests extends Base
{
    /**
     * Filter tests
     * @var TypedSequence<FilterTest>
     */
    private $_tests;

    /**
     * Constructor method for FilterTests
     * @param FilterCondition $condition Condition - allof|anyof
     * @param array $tests
     * @return self
     */
    public function __construct(FilterCondition $condition, array $tests = [])
    {
        parent::__construct();
        $this->setProperty('condition', $condition)
            ->setTests($tests);
        $this->on('before', function(Base $sender)
        {
            if($sender->getTests()->count())
            {
                foreach ($sender->getTests()->all() as $test)
                {
                    if($test instanceof AddressBookTest)
                    {
                        $this->setChild('addressBookTest', $test);
                    }
                    if($test instanceof AddressTest)
                    {
                        $this->setChild('addressTest', $test);
                    }
                    if($test instanceof AttachmentTest)
                    {
                        $this->setChild('attachmentTest', $test);
                    }
                    if($test instanceof BodyTest)
                    {
                        $this->setChild('bodyTest', $test);
                    }
                    if($test instanceof BulkTest)
                    {
                        $this->setChild('bulkTest', $test);
                    }
                    if($test instanceof ContactRankingTest)
                    {
                        $this->setChild('contactRankingTest', $test);
                    }
                    if($test instanceof ConversationTest)
                    {
                        $this->setChild('conversationTest', $test);
                    }
                    if($test instanceof CurrentDayOfWeekTest)
                    {
                        $this->setChild('currentDayOfWeekTest', $test);
                    }
                    if($test instanceof CurrentTimeTest)
                    {
                        $this->setChild('currentTimeTest', $test);
                    }
                    if($test instanceof DateTest)
                    {
                        $this->setChild('dateTest', $test);
                    }
                    if($test instanceof FacebookTest)
                    {
                        $this->setChild('facebookTest', $test);
                    }
                    if($test instanceof FlaggedTest)
                    {
                        $this->setChild('flaggedTest', $test);
                    }
                    if($test instanceof HeaderExistsTest)
                    {
                        $this->setChild('headerExistsTest', $test);
                    }
                    if($test instanceof HeaderTest)
                    {
                        $this->setChild('headerTest', $test);
                    }
                    if($test instanceof ImportanceTest)
                    {
                        $this->setChild('importanceTest', $test);
                    }
                    if($test instanceof InviteTest)
                    {
                        $this->setChild('inviteTest', $test);
                    }
                    if($test instanceof LinkedInTest)
                    {
                        $this->setChild('linkedinTest', $test);
                    }
                    if($test instanceof ListTest)
                    {
                        $this->setChild('listTest', $test);
                    }
                    if($test instanceof MeTest)
                    {
                        $this->setChild('meTest', $test);
                    }
                    if($test instanceof MimeHeaderTest)
                    {
                        $this->setChild('mimeHeaderTest', $test);
                    }
                    if($test instanceof SizeTest)
                    {
                        $this->setChild('sizeTest', $test);
                    }
                    if($test instanceof SocialcastTest)
                    {
                        $this->setChild('socialcastTest', $test);
                    }
                    if($test instanceof TrueTest)
                    {
                        $this->setChild('trueTest', $test);
                    }
                    if($test instanceof TwitterTest)
                    {
                        $this->setChild('twitterTest', $test);
                    }
                    if($test instanceof CommunityRequestsTest)
                    {
                        $this->setChild('communityRequestsTest', $test);
                    }
                    if($test instanceof CommunityContentTest)
                    {
                        $this->setChild('communityContentTest', $test);
                    }
                    if($test instanceof CommunityConnectionsTest)
                    {
                        $this->setChild('communityConnectionsTest', $test);
                    }
                }
            }
        });
    }

    /**
     * Gets condition
     *
     * @return FilterCondition
     */
    public function getCondition()
    {
        return $this->getProperty('condition');
    }

    /**
     * Sets condition
     *
     * @param  FilterCondition $condition
     * @return self
     */
    public function setCondition(FilterCondition $condition)
    {
        return $this->setProperty('condition', $condition);
    }

    /**
     * Add a call test
     *
     * @param  FilterTest $test
     * @return self
     */
    public function addTest(FilterTest $test)
    {
        $this->_tests->add($test);
        return $this;
    }

    /**
     * Sets call test sequence
     *
     * @param  array $tests
     * @return self
     */
    public function setTests(array $tests)
    {
        $this->_tests = new TypedSequence('Zimbra\Mail\Struct\FilterTest', $tests);
        return $this;
    }

    /**
     * Gets call test sequence
     *
     * @return Sequence
     */
    public function getTests()
    {
        return $this->_tests;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filterTests')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filterTests')
    {
        return parent::toXml($name);
    }
}
