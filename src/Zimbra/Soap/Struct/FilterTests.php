<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\FilterCondition;
use Zimbra\Utils\SimpleXML;

/**
 * FilterTests struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterTests
{
    /**
     * Condition - allof|anyof
     * @var FilterCondition
     */
    private $_condition;

    /**
     * The addressBookTest
     * @var AddressBookTest
     */
    private $_addressBookTest;

    /**
     * The addressTest
     * @var AddressTest
     */
    private $_addressTest;

    /**
     * The attachmentTest
     * @var AttachmentTest
     */
    private $_attachmentTest;

    /**
     * The bodyTest
     * @var BodyTest
     */
    private $_bodyTest;

    /**
     * The bulkTest
     * @var BulkTest
     */
    private $_bulkTest;

    /**
     * The contactRankingTest
     * @var ContactRankingTest
     */
    private $_contactRankingTest;

    /**
     * The conversationTest
     * @var ConversationTest
     */
    private $_conversationTest;

    /**
     * The currentDayOfWeekTest
     * @var CurrentDayOfWeekTest
     */
    private $_currentDayOfWeekTest;

    /**
     * The currentTimeTest
     * @var CurrentTimeTest
     */
    private $_currentTimeTest;

    /**
     * The dateTest
     * @var DateTest
     */
    private $_dateTest;

    /**
     * The facebookTest
     * @var FacebookTest
     */
    private $_facebookTest;

    /**
     * The flaggedTest
     * @var FlaggedTest
     */
    private $_flaggedTest;

    /**
     * The headerExistsTest
     * @var HeaderExistsTest
     */
    private $_headerExistsTest;

    /**
     * The headerTest
     * @var HeaderTest
     */
    private $_headerTest;

    /**
     * The importanceTest
     * @var ImportanceTest
     */
    private $_importanceTest;

    /**
     * The inviteTest
     * @var InviteTest
     */
    private $_inviteTest;

    /**
     * The linkedinTest
     * @var LinkedInTest
     */
    private $_linkedinTest;

    /**
     * The listTest
     * @var ListTest
     */
    private $_listTest;

    /**
     * The meTest
     * @var MeTest
     */
    private $_meTest;

    /**
     * The mimeHeaderTest
     * @var MimeHeaderTest
     */
    private $_mimeHeaderTest;

    /**
     * The sizeTest
     * @var SizeTest
     */
    private $_sizeTest;

    /**
     * The socialcastTest
     * @var SocialcastTest
     */
    private $_socialcastTest;

    /**
     * The trueTest
     * @var TrueTest
     */
    private $_trueTest;

    /**
     * The twitterTest
     * @var TwitterTest
     */
    private $_twitterTest;

    /**
     * Constructor method for FilterTests
     * @param FilterCondition $condition
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
        $this->_condition = $condition;
        if($addressBookTest instanceof AddressBookTest)
        {
            $this->_addressBookTest = $addressBookTest;
        }
        if($addressTest instanceof AddressTest)
        {
            $this->_addressTest = $addressTest;
        }
        if($attachmentTest instanceof AttachmentTest)
        {
            $this->_attachmentTest = $attachmentTest;
        }
        if($bodyTest instanceof BodyTest)
        {
            $this->_bodyTest = $bodyTest;
        }
        if($bulkTest instanceof BulkTest)
        {
            $this->_bulkTest = $bulkTest;
        }
        if($contactRankingTest instanceof ContactRankingTest)
        {
            $this->_contactRankingTest = $contactRankingTest;
        }
        if($conversationTest instanceof ConversationTest)
        {
            $this->_conversationTest = $conversationTest;
        }
        if($currentDayOfWeekTest instanceof CurrentDayOfWeekTest)
        {
            $this->_currentDayOfWeekTest = $currentDayOfWeekTest;
        }
        if($currentTimeTest instanceof CurrentTimeTest)
        {
            $this->_currentTimeTest = $currentTimeTest;
        }
        if($dateTest instanceof DateTest)
        {
            $this->_dateTest = $dateTest;
        }
        if($facebookTest instanceof FacebookTest)
        {
            $this->_facebookTest = $facebookTest;
        }
        if($flaggedTest instanceof FlaggedTest)
        {
            $this->_flaggedTest = $flaggedTest;
        }
        if($headerExistsTest instanceof HeaderExistsTest)
        {
            $this->_headerExistsTest = $headerExistsTest;
        }
        if($headerTest instanceof HeaderTest)
        {
            $this->_headerTest = $headerTest;
        }
        if($importanceTest instanceof ImportanceTest)
        {
            $this->_importanceTest = $importanceTest;
        }
        if($inviteTest instanceof InviteTest)
        {
            $this->_inviteTest = $inviteTest;
        }
        if($linkedinTest instanceof LinkedInTest)
        {
            $this->_linkedinTest = $linkedinTest;
        }
        if($listTest instanceof ListTest)
        {
            $this->_listTest = $listTest;
        }
        if($meTest instanceof MeTest)
        {
            $this->_meTest = $meTest;
        }
        if($mimeHeaderTest instanceof MimeHeaderTest)
        {
            $this->_mimeHeaderTest = $mimeHeaderTest;
        }
        if($sizeTest instanceof SizeTest)
        {
            $this->_sizeTest = $sizeTest;
        }
        if($socialcastTest instanceof SocialcastTest)
        {
            $this->_socialcastTest = $socialcastTest;
        }
        if($trueTest instanceof TrueTest)
        {
            $this->_trueTest = $trueTest;
        }
        if($twitterTest instanceof TwitterTest)
        {
            $this->_twitterTest = $twitterTest;
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
            return $this->_condition;
        }
        $this->_condition = $condition;
        return $this;
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
            return $this->_addressBookTest;
        }
        $this->_addressBookTest = $addressBookTest;
        return $this;
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
            return $this->_addressTest;
        }
        $this->_addressTest = $addressTest;
        return $this;
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
            return $this->_attachmentTest;
        }
        $this->_attachmentTest = $attachmentTest;
        return $this;
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
            return $this->_bodyTest;
        }
        $this->_bodyTest = $bodyTest;
        return $this;
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
            return $this->_bulkTest;
        }
        $this->_bulkTest = $bulkTest;
        return $this;
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
            return $this->_contactRankingTest;
        }
        $this->_contactRankingTest = $contactRankingTest;
        return $this;
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
            return $this->_conversationTest;
        }
        $this->_conversationTest = $conversationTest;
        return $this;
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
            return $this->_currentDayOfWeekTest;
        }
        $this->_currentDayOfWeekTest = $currentDayOfWeekTest;
        return $this;
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
            return $this->_currentTimeTest;
        }
        $this->_currentTimeTest = $currentTimeTest;
        return $this;
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
            return $this->_dateTest;
        }
        $this->_dateTest = $dateTest;
        return $this;
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
            return $this->_facebookTest;
        }
        $this->_facebookTest = $facebookTest;
        return $this;
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
            return $this->_flaggedTest;
        }
        $this->_flaggedTest = $flaggedTest;
        return $this;
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
            return $this->_headerExistsTest;
        }
        $this->_headerExistsTest = $headerExistsTest;
        return $this;
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
            return $this->_headerTest;
        }
        $this->_headerTest = $headerTest;
        return $this;
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
            return $this->_importanceTest;
        }
        $this->_importanceTest = $importanceTest;
        return $this;
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
            return $this->_inviteTest;
        }
        $this->_inviteTest = $inviteTest;
        return $this;
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
            return $this->_linkedinTest;
        }
        $this->_linkedinTest = $linkedinTest;
        return $this;
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
            return $this->_listTest;
        }
        $this->_listTest = $listTest;
        return $this;
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
            return $this->_meTest;
        }
        $this->_meTest = $meTest;
        return $this;
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
            return $this->_mimeHeaderTest;
        }
        $this->_mimeHeaderTest = $mimeHeaderTest;
        return $this;
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
            return $this->_sizeTest;
        }
        $this->_sizeTest = $sizeTest;
        return $this;
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
            return $this->_socialcastTest;
        }
        $this->_socialcastTest = $socialcastTest;
        return $this;
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
            return $this->_trueTest;
        }
        $this->_trueTest = $trueTest;
        return $this;
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
            return $this->_twitterTest;
        }
        $this->_twitterTest = $twitterTest;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filterTests')
    {
        $name = !empty($name) ? $name : 'filterTests';
        $arr = array(
            'condition' => (string) $this->_condition,
        );
        if($this->_addressBookTest instanceof AddressBookTest)
        {
            $arr += $this->_addressBookTest->toArray('addressBookTest');
        }
        if($this->_addressTest instanceof AddressTest)
        {
            $arr += $this->_addressTest->toArray('addressTest');
        }
        if($this->_attachmentTest instanceof AttachmentTest)
        {
            $arr += $this->_attachmentTest->toArray('attachmentTest');
        }
        if($this->_bodyTest instanceof BodyTest)
        {
            $arr += $this->_bodyTest->toArray('bodyTest');
        }
        if($this->_bulkTest instanceof BulkTest)
        {
            $arr += $this->_bulkTest->toArray('bulkTest');
        }
        if($this->_contactRankingTest instanceof ContactRankingTest)
        {
            $arr += $this->_contactRankingTest->toArray('contactRankingTest');
        }
        if($this->_conversationTest instanceof ConversationTest)
        {
            $arr += $this->_conversationTest->toArray('conversationTest');
        }
        if($this->_currentDayOfWeekTest instanceof CurrentDayOfWeekTest)
        {
            $arr += $this->_currentDayOfWeekTest->toArray('currentDayOfWeekTest');
        }
        if($this->_currentTimeTest instanceof CurrentTimeTest)
        {
            $arr += $this->_currentTimeTest->toArray('currentTimeTest');
        }
        if($this->_dateTest instanceof DateTest)
        {
            $arr += $this->_dateTest->toArray('dateTest');
        }
        if($this->_facebookTest instanceof FacebookTest)
        {
            $arr += $this->_facebookTest->toArray('facebookTest');
        }
        if($this->_flaggedTest instanceof FlaggedTest)
        {
            $arr += $this->_flaggedTest->toArray('flaggedTest');
        }
        if($this->_headerExistsTest instanceof HeaderExistsTest)
        {
            $arr += $this->_headerExistsTest->toArray('headerExistsTest');
        }
        if($this->_headerTest instanceof HeaderTest)
        {
            $arr += $this->_headerTest->toArray('headerTest');
        }
        if($this->_importanceTest instanceof ImportanceTest)
        {
            $arr += $this->_importanceTest->toArray('importanceTest');
        }
        if($this->_inviteTest instanceof InviteTest)
        {
            $arr += $this->_inviteTest->toArray('inviteTest');
        }
        if($this->_linkedinTest instanceof LinkedInTest)
        {
            $arr += $this->_linkedinTest->toArray('linkedinTest');
        }
        if($this->_listTest instanceof ListTest)
        {
            $arr += $this->_listTest->toArray('listTest');
        }
        if($this->_meTest instanceof MeTest)
        {
            $arr += $this->_meTest->toArray('meTest');
        }
        if($this->_mimeHeaderTest instanceof MimeHeaderTest)
        {
            $arr += $this->_mimeHeaderTest->toArray('mimeHeaderTest');
        }
        if($this->_sizeTest instanceof SizeTest)
        {
            $arr += $this->_sizeTest->toArray('sizeTest');
        }
        if($this->_socialcastTest instanceof SocialcastTest)
        {
            $arr += $this->_socialcastTest->toArray('socialcastTest');
        }
        if($this->_trueTest instanceof TrueTest)
        {
            $arr += $this->_trueTest->toArray('trueTest');
        }
        if($this->_twitterTest instanceof TwitterTest)
        {
            $arr += $this->_twitterTest->toArray('twitterTest');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filterTests')
    {
        $name = !empty($name) ? $name : 'filterTests';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('condition', (string) $this->_condition);
        if($this->_addressBookTest instanceof AddressBookTest)
        {
            $xml->append($this->_addressBookTest->toXml('addressBookTest'));
        }
        if($this->_addressTest instanceof AddressTest)
        {
            $xml->append($this->_addressTest->toXml('addressTest'));
        }
        if($this->_attachmentTest instanceof AttachmentTest)
        {
            $xml->append($this->_attachmentTest->toXml('attachmentTest'));
        }
        if($this->_bodyTest instanceof BodyTest)
        {
            $xml->append($this->_bodyTest->toXml('bodyTest'));
        }
        if($this->_bulkTest instanceof BulkTest)
        {
            $xml->append($this->_bulkTest->toXml('bulkTest'));
        }
        if($this->_contactRankingTest instanceof ContactRankingTest)
        {
            $xml->append($this->_contactRankingTest->toXml('contactRankingTest'));
        }
        if($this->_conversationTest instanceof ConversationTest)
        {
            $xml->append($this->_conversationTest->toXml('conversationTest'));
        }
        if($this->_currentDayOfWeekTest instanceof CurrentDayOfWeekTest)
        {
            $xml->append($this->_currentDayOfWeekTest->toXml('currentDayOfWeekTest'));
        }
        if($this->_currentTimeTest instanceof CurrentTimeTest)
        {
            $xml->append($this->_currentTimeTest->toXml('currentTimeTest'));
        }
        if($this->_dateTest instanceof DateTest)
        {
            $xml->append($this->_dateTest->toXml('dateTest'));
        }
        if($this->_facebookTest instanceof FacebookTest)
        {
            $xml->append($this->_facebookTest->toXml('facebookTest'));
        }
        if($this->_flaggedTest instanceof FlaggedTest)
        {
            $xml->append($this->_flaggedTest->toXml('flaggedTest'));
        }
        if($this->_headerExistsTest instanceof HeaderExistsTest)
        {
            $xml->append($this->_headerExistsTest->toXml('headerExistsTest'));
        }
        if($this->_headerTest instanceof HeaderTest)
        {
            $xml->append($this->_headerTest->toXml('headerTest'));
        }
        if($this->_importanceTest instanceof ImportanceTest)
        {
            $xml->append($this->_importanceTest->toXml('importanceTest'));
        }
        if($this->_inviteTest instanceof InviteTest)
        {
            $xml->append($this->_inviteTest->toXml('inviteTest'));
        }
        if($this->_linkedinTest instanceof LinkedInTest)
        {
            $xml->append($this->_linkedinTest->toXml('linkedinTest'));
        }
        if($this->_listTest instanceof ListTest)
        {
            $xml->append($this->_listTest->toXml('listTest'));
        }
        if($this->_meTest instanceof MeTest)
        {
            $xml->append($this->_meTest->toXml('meTest'));
        }
        if($this->_mimeHeaderTest instanceof MimeHeaderTest)
        {
            $xml->append($this->_mimeHeaderTest->toXml('mimeHeaderTest'));
        }
        if($this->_sizeTest instanceof SizeTest)
        {
            $xml->append($this->_sizeTest->toXml('sizeTest'));
        }
        if($this->_socialcastTest instanceof SocialcastTest)
        {
            $xml->append($this->_socialcastTest->toXml('socialcastTest'));
        }
        if($this->_trueTest instanceof TrueTest)
        {
            $xml->append($this->_trueTest->toXml('trueTest'));
        }
        if($this->_twitterTest instanceof TwitterTest)
        {
            $xml->append($this->_twitterTest->toXml('twitterTest'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
