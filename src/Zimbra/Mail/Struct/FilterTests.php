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
     * Constructor method for FilterTests
     * @param FilterCondition $condition Condition - allof|anyof
     * @param AddressBookTest $addressBookTest
     * @param AddressTest $addressTest
     * @param AttachmentTest $attachmentTest
     * @param BodyTest $bodyTest
     * @param BulkTest $bulkTest
     * @param ContactRankingTest $contactRankingTest
     * @param ConversationTest $conversationTest
     * @param CurrentDayOfWeekTest $currentDayOfWeekTest
     * @param CurrentTimeTest $currentTimeTest
     * @param DateTest $dateTest
     * @param FacebookTest $facebookTest
     * @param FlaggedTest $flaggedTest
     * @param HeaderExistsTest $headerExistsTest
     * @param HeaderTest $headerTest
     * @param ImportanceTest $importanceTest
     * @param InviteTest $inviteTest
     * @param LinkedInTest $linkedinTest
     * @param ListTest $listTest
     * @param MeTest $meTest
     * @param MimeHeaderTest $mimeHeaderTest
     * @param SizeTest $sizeTest
     * @param SocialcastTest $socialcastTest
     * @param TrueTest $trueTest
     * @param TwitterTest $twitterTest
     * @return self
     */
    public function __construct(
        FilterCondition $condition,
        AddressBookTest $addressBookTest = NULL,
        AddressTest $addressTest = NULL,
        AttachmentTest $attachmentTest = NULL,
        BodyTest $bodyTest = NULL,
        BulkTest $bulkTest = NULL,
        ContactRankingTest $contactRankingTest = NULL,
        ConversationTest $conversationTest = NULL,
        CurrentDayOfWeekTest $currentDayOfWeekTest = NULL,
        CurrentTimeTest $currentTimeTest = NULL,
        DateTest $dateTest = NULL,
        FacebookTest $facebookTest = NULL,
        FlaggedTest $flaggedTest = NULL,
        HeaderExistsTest $headerExistsTest = NULL,
        HeaderTest $headerTest = NULL,
        ImportanceTest $importanceTest = NULL,
        InviteTest $inviteTest = NULL,
        LinkedInTest $linkedinTest = NULL,
        ListTest $listTest = NULL,
        MeTest $meTest = NULL,
        MimeHeaderTest $mimeHeaderTest = NULL,
        SizeTest $sizeTest = NULL,
        SocialcastTest $socialcastTest = NULL,
        TrueTest $trueTest = NULL,
        TwitterTest $twitterTest = NULL
    )
    {
        parent::__construct();
        $this->property('condition', $condition);
        if($addressBookTest instanceof AddressBookTest)
        {
            $this->child('addressBookTest', $addressBookTest);
        }
        if($addressTest instanceof AddressTest)
        {
            $this->child('addressTest', $addressTest);
        }
        if($attachmentTest instanceof AttachmentTest)
        {
            $this->child('attachmentTest', $attachmentTest);
        }
        if($bodyTest instanceof BodyTest)
        {
            $this->child('bodyTest', $bodyTest);
        }
        if($bulkTest instanceof BulkTest)
        {
            $this->child('bulkTest', $bulkTest);
        }
        if($contactRankingTest instanceof ContactRankingTest)
        {
            $this->child('contactRankingTest', $contactRankingTest);
        }
        if($conversationTest instanceof ConversationTest)
        {
            $this->child('conversationTest', $conversationTest);
        }
        if($currentDayOfWeekTest instanceof CurrentDayOfWeekTest)
        {
            $this->child('currentDayOfWeekTest', $currentDayOfWeekTest);
        }
        if($currentTimeTest instanceof CurrentTimeTest)
        {
            $this->child('currentTimeTest', $currentTimeTest);
        }
        if($dateTest instanceof DateTest)
        {
            $this->child('dateTest', $dateTest);
        }
        if($facebookTest instanceof FacebookTest)
        {
            $this->child('facebookTest', $facebookTest);
        }
        if($flaggedTest instanceof FlaggedTest)
        {
            $this->child('flaggedTest', $flaggedTest);
        }
        if($headerExistsTest instanceof HeaderExistsTest)
        {
            $this->child('headerExistsTest', $headerExistsTest);
        }
        if($headerTest instanceof HeaderTest)
        {
            $this->child('headerTest', $headerTest);
        }
        if($importanceTest instanceof ImportanceTest)
        {
            $this->child('importanceTest', $importanceTest);
        }
        if($inviteTest instanceof InviteTest)
        {
            $this->child('inviteTest', $inviteTest);
        }
        if($linkedinTest instanceof LinkedInTest)
        {
            $this->child('linkedinTest', $linkedinTest);
        }
        if($listTest instanceof ListTest)
        {
            $this->child('listTest', $listTest);
        }
        if($meTest instanceof MeTest)
        {
            $this->child('meTest', $meTest);
        }
        if($mimeHeaderTest instanceof MimeHeaderTest)
        {
            $this->child('mimeHeaderTest', $mimeHeaderTest);
        }
        if($sizeTest instanceof SizeTest)
        {
            $this->child('sizeTest', $sizeTest);
        }
        if($socialcastTest instanceof SocialcastTest)
        {
            $this->child('socialcastTest', $socialcastTest);
        }
        if($trueTest instanceof TrueTest)
        {
            $this->child('trueTest', $trueTest);
        }
        if($twitterTest instanceof TwitterTest)
        {
            $this->child('twitterTest', $twitterTest);
        }
    }

    /**
     * Gets or sets condition
     *
     * @param  FilterCondition $condition
     * @return FilterCondition|self
     */
    public function condition(FilterCondition $condition = null)
    {
        if(null === $condition)
        {
            return $this->property('condition');
        }
        return $this->property('condition', $condition);
    }

    /**
     * Gets or sets addressBookTest
     *
     * @param  AddressBookTest $addressBookTest
     * @return AddressBookTest|self
     */
    public function addressBookTest(AddressBookTest $addressBookTest = null)
    {
        if(null === $addressBookTest)
        {
            return $this->child('addressBookTest');
        }
        return $this->child('addressBookTest', $addressBookTest);
    }

    /**
     * Gets or sets addressTest
     *
     * @param  AddressTest $addressTest
     * @return AddressTest|self
     */
    public function addressTest(AddressTest $addressTest = null)
    {
        if(null === $addressTest)
        {
            return $this->child('addressTest');
        }
        return $this->child('addressTest', $addressTest);
    }

    /**
     * Gets or sets attachmentTest
     *
     * @param  AttachmentTest $attachmentTest
     * @return AttachmentTest|self
     */
    public function attachmentTest(AttachmentTest $attachmentTest = null)
    {
        if(null === $attachmentTest)
        {
            return $this->child('attachmentTest');
        }
        return $this->child('attachmentTest', $attachmentTest);
    }

    /**
     * Gets or sets bodyTest
     *
     * @param  BodyTest $bodyTest
     * @return BodyTest|self
     */
    public function bodyTest(BodyTest $bodyTest = null)
    {
        if(null === $bodyTest)
        {
            return $this->child('bodyTest');
        }
        return $this->child('bodyTest', $bodyTest);
    }

    /**
     * Gets or sets bulkTest
     *
     * @param  BulkTest $bulkTest
     * @return BulkTest|self
     */
    public function bulkTest(BulkTest $bulkTest = null)
    {
        if(null === $bulkTest)
        {
            return $this->child('bulkTest');
        }
        return $this->child('bulkTest', $bulkTest);
    }

    /**
     * Gets or sets contactRankingTest
     *
     * @param  ContactRankingTest $contactRankingTest
     * @return ContactRankingTest|self
     */
    public function contactRankingTest(ContactRankingTest $contactRankingTest = null)
    {
        if(null === $contactRankingTest)
        {
            return $this->child('contactRankingTest');
        }
        return $this->child('contactRankingTest', $contactRankingTest);
    }

    /**
     * Gets or sets conversationTest
     *
     * @param  ConversationTest $conversationTest
     * @return ConversationTest|self
     */
    public function conversationTest(ConversationTest $conversationTest = null)
    {
        if(null === $conversationTest)
        {
            return $this->child('conversationTest');
        }
        return $this->child('conversationTest', $conversationTest);
    }

    /**
     * Gets or sets currentDayOfWeekTest
     *
     * @param  CurrentDayOfWeekTest $currentDayOfWeekTest
     * @return CurrentDayOfWeekTest|self
     */
    public function currentDayOfWeekTest(CurrentDayOfWeekTest $currentDayOfWeekTest = null)
    {
        if(null === $currentDayOfWeekTest)
        {
            return $this->child('currentDayOfWeekTest');
        }
        return $this->child('currentDayOfWeekTest', $currentDayOfWeekTest);
    }

    /**
     * Gets or sets currentTimeTest
     *
     * @param  CurrentTimeTest $currentTimeTest
     * @return CurrentTimeTest|self
     */
    public function currentTimeTest(CurrentTimeTest $currentTimeTest = null)
    {
        if(null === $currentTimeTest)
        {
            return $this->child('currentTimeTest');
        }
        return $this->child('currentTimeTest', $currentTimeTest);
    }

    /**
     * Gets or sets dateTest
     *
     * @param  DateTest $dateTest
     * @return DateTest|self
     */
    public function dateTest(DateTest $dateTest = null)
    {
        if(null === $dateTest)
        {
            return $this->child('dateTest');
        }
        return $this->child('dateTest', $dateTest);
    }

    /**
     * Gets or sets facebookTest
     *
     * @param  FacebookTest $facebookTest
     * @return FacebookTest|self
     */
    public function facebookTest(FacebookTest $facebookTest = null)
    {
        if(null === $facebookTest)
        {
            return $this->child('facebookTest');
        }
        return $this->child('facebookTest', $facebookTest);
    }

    /**
     * Gets or sets flaggedTest
     *
     * @param  FlaggedTest $flaggedTest
     * @return FlaggedTest|self
     */
    public function flaggedTest(FlaggedTest $flaggedTest = null)
    {
        if(null === $flaggedTest)
        {
            return $this->child('flaggedTest');
        }
        return $this->child('flaggedTest', $flaggedTest);
    }

    /**
     * Gets or sets headerExistsTest
     *
     * @param  HeaderExistsTest $headerExistsTest
     * @return HeaderExistsTest|self
     */
    public function headerExistsTest(HeaderExistsTest $headerExistsTest = null)
    {
        if(null === $headerExistsTest)
        {
            return $this->child('headerExistsTest');
        }
        return $this->child('headerExistsTest', $headerExistsTest);
    }

    /**
     * Gets or sets headerTest
     *
     * @param  HeaderTest $headerTest
     * @return HeaderTest|self
     */
    public function headerTest(HeaderTest $headerTest = null)
    {
        if(null === $headerTest)
        {
            return $this->child('headerTest');
        }
        return $this->child('headerTest', $headerTest);
    }

    /**
     * Gets or sets importanceTest
     *
     * @param  ImportanceTest $importanceTest
     * @return ImportanceTest|self
     */
    public function importanceTest(ImportanceTest $importanceTest = null)
    {
        if(null === $importanceTest)
        {
            return $this->child('importanceTest');
        }
        return $this->child('importanceTest', $importanceTest);
    }

    /**
     * Gets or sets inviteTest
     *
     * @param  InviteTest $inviteTest
     * @return InviteTest|self
     */
    public function inviteTest(InviteTest $inviteTest = null)
    {
        if(null === $inviteTest)
        {
            return $this->child('inviteTest');
        }
        return $this->child('inviteTest', $inviteTest);
    }

    /**
     * Gets or sets linkedinTest
     *
     * @param  LinkedInTest $linkedinTest
     * @return LinkedInTest|self
     */
    public function linkedinTest(LinkedInTest $linkedinTest = null)
    {
        if(null === $linkedinTest)
        {
            return $this->child('linkedinTest');
        }
        return $this->child('linkedinTest', $linkedinTest);
    }

    /**
     * Gets or sets listTest
     *
     * @param  ListTest $listTest
     * @return ListTest|self
     */
    public function listTest(ListTest $listTest = null)
    {
        if(null === $listTest)
        {
            return $this->child('listTest');
        }
        return $this->child('listTest', $listTest);
    }

    /**
     * Gets or sets meTest
     *
     * @param  MeTest $meTest
     * @return MeTest|self
     */
    public function meTest(MeTest $meTest = null)
    {
        if(null === $meTest)
        {
            return $this->child('meTest');
        }
        return $this->child('meTest', $meTest);
    }

    /**
     * Gets or sets mimeHeaderTest
     *
     * @param  MimeHeaderTest $mimeHeaderTest
     * @return MimeHeaderTest|self
     */
    public function mimeHeaderTest(MimeHeaderTest $mimeHeaderTest = null)
    {
        if(null === $mimeHeaderTest)
        {
            return $this->child('mimeHeaderTest');
        }
        return $this->child('mimeHeaderTest', $mimeHeaderTest);
    }

    /**
     * Gets or sets sizeTest
     *
     * @param  SizeTest $sizeTest
     * @return SizeTest|self
     */
    public function sizeTest(SizeTest $sizeTest = null)
    {
        if(null === $sizeTest)
        {
            return $this->child('sizeTest');
        }
        return $this->child('sizeTest', $sizeTest);
    }

    /**
     * Gets or sets socialcastTest
     *
     * @param  SocialcastTest $socialcastTest
     * @return SocialcastTest|self
     */
    public function socialcastTest(SocialcastTest $socialcastTest = null)
    {
        if(null === $socialcastTest)
        {
            return $this->child('socialcastTest');
        }
        return $this->child('socialcastTest', $socialcastTest);
    }

    /**
     * Gets or sets trueTest
     *
     * @param  TrueTest $trueTest
     * @return TrueTest|self
     */
    public function trueTest(TrueTest $trueTest = null)
    {
        if(null === $trueTest)
        {
            return $this->child('trueTest');
        }
        return $this->child('trueTest', $trueTest);
    }

    /**
     * Gets or sets twitterTest
     *
     * @param  TwitterTest $twitterTest
     * @return TwitterTest|self
     */
    public function twitterTest(TwitterTest $twitterTest = null)
    {
        if(null === $twitterTest)
        {
            return $this->child('twitterTest');
        }
        return $this->child('twitterTest', $twitterTest);
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
