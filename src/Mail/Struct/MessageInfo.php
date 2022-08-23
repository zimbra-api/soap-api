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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Struct\{EmailInfoInterface, InviteInfoInterface, KeyValuePair, MessageInfoInterface};

/**
 * MessageInfo struct class
 * Message information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MessageInfo extends MessageCommon implements MessageInfoInterface
{
    /**
     * Message ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * IMAP UID
     * 
     * @Accessor(getter="getImapUid", setter="setImapUid")
     * @SerializedName("i4uid")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getImapUid', setter: 'setImapUid')]
    #[SerializedName('i4uid')]
    #[Type('int')]
    #[XmlAttribute]
    private $imapUid;

    /**
     * X-Zimbra-Calendar-Intended-For header
     * 
     * @Accessor(getter="getCalendarIntendedFor", setter="setCalendarIntendedFor")
     * @SerializedName("cif")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getCalendarIntendedFor', setter: 'setCalendarIntendedFor')]
    #[SerializedName('cif')]
    #[Type('string')]
    #[XmlAttribute]
    private $calendarIntendedFor;

    /**
     * Message id of the message being replied to/forwarded (outbound messages only)
     * 
     * @Accessor(getter="getOrigId", setter="setOrigId")
     * @SerializedName("origid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getOrigId', setter: 'setOrigId')]
    #[SerializedName('origid')]
    #[Type('string')]
    #[XmlAttribute]
    private $origId;

    /**
     * Reply type - r|w: (r)eplied or for(w)arded.
     * 
     * @Accessor(getter="getDraftReplyType", setter="setDraftReplyType")
     * @SerializedName("rt")
     * @Type("Enum<Zimbra\Common\Enum\ReplyType>")
     * @XmlAttribute
     * 
     * @var ReplyType
     */
    #[Accessor(getter: 'getDraftReplyType', setter: 'setDraftReplyType')]
    #[SerializedName('rt')]
    #[Type('Enum<Zimbra\Common\Enum\ReplyType>')]
    #[XmlAttribute]
    private ?ReplyType $draftReplyType;

    /**
     * If set, this specifies the identity being used to compose the message
     * 
     * @Accessor(getter="getIdentityId", setter="setIdentityId")
     * @SerializedName("idnt")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getIdentityId', setter: 'setIdentityId')]
    #[SerializedName('idnt')]
    #[Type('string')]
    #[XmlAttribute]
    private $identityId;

    /**
     * Draft account ID
     * 
     * @Accessor(getter="getDraftAccountId", setter="setDraftAccountId")
     * @SerializedName("forAcct")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDraftAccountId', setter: 'setDraftAccountId')]
    #[SerializedName('forAcct')]
    #[Type('string')]
    #[XmlAttribute]
    private $draftAccountId;

    /**
     * Can optionally set this to specify the time at which the draft should be
     * automatically sent by the server
     * 
     * @Accessor(getter="getDraftAutoSendTime", setter="setDraftAutoSendTime")
     * @SerializedName("autoSendTime")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getDraftAutoSendTime', setter: 'setDraftAutoSendTime')]
    #[SerializedName('autoSendTime')]
    #[Type('int')]
    #[XmlAttribute]
    private $draftAutoSendTime;

    /**
     * Date header
     * 
     * @Accessor(getter="getSentDate", setter="setSentDate")
     * @SerializedName("sd")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getSentDate', setter: 'setSentDate')]
    #[SerializedName('sd')]
    #[Type('int')]
    #[XmlAttribute]
    private $sentDate;

    /**
     * Resent date
     * 
     * @Accessor(getter="getResentDate", setter="setResentDate")
     * @SerializedName("rd")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getResentDate', setter: 'setResentDate')]
    #[SerializedName('rd')]
    #[Type('int')]
    #[XmlAttribute]
    private $resentDate;

    /**
     * Part
     * 
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getPart', setter: 'setPart')]
    #[SerializedName('part')]
    #[Type('string')]
    #[XmlAttribute]
    private $part;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * 
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     * 
     * @var string
     */
    #[Accessor(getter: 'getFragment', setter: 'setFragment')]
    #[SerializedName('fr')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $fragment;

    /**
     * Email addresses
     * 
     * @Accessor(getter="getEmails", setter="setEmails")
     * @Type("array<Zimbra\Mail\Struct\EmailInfo>")
     * @XmlList(inline=true, entry="e", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getEmails', setter: 'setEmails')]
    #[Type('array<Zimbra\Mail\Struct\EmailInfo>')]
    #[XmlList(inline: true, entry: 'e', namespace: 'urn:zimbraMail')]
    private $emails = [];

    /**
     * Subject
     * 
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     * 
     * @var string
     */
    #[Accessor(getter: 'getSubject', setter: 'setSubject')]
    #[SerializedName('su')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $subject;

    /**
     * Message ID
     * 
     * @Accessor(getter="getMessageIdHeader", setter="setMessageIdHeader")
     * @SerializedName("mid")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     * 
     * @var string
     */
    #[Accessor(getter: 'getMessageIdHeader', setter: 'setMessageIdHeader')]
    #[SerializedName('mid')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $messageIdHeader;

    /**
     * Message-ID header for message being replied to
     * 
     * @Accessor(getter="getInReplyTo", setter="setInReplyTo")
     * @SerializedName("irt")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     * 
     * @var string
     */
    #[Accessor(getter: 'getInReplyTo', setter: 'setInReplyTo')]
    #[SerializedName('irt')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $inReplyTo;

    /**
     * Parsed out iCalendar invite
     * 
     * @Accessor(getter="getInvite", setter="setInvite")
     * @SerializedName("inv")
     * @Type("Zimbra\Mail\Struct\InviteInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var InviteInfoInterface
     */
    #[Accessor(getter: 'getInvite', setter: 'setInvite')]
    #[SerializedName('inv')]
    #[Type(InviteInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?InviteInfoInterface $invite;

    /**
     * Headers
     * 
     * @Accessor(getter="getHeaders", setter="setHeaders")
     * @Type("array<Zimbra\Common\Struct\KeyValuePair>")
     * @XmlList(inline=true, entry="header", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getHeaders', setter: 'setHeaders')]
    #[Type('array<Zimbra\Common\Struct\KeyValuePair>')]
    #[XmlList(inline: true, entry: 'header', namespace: 'urn:zimbraMail')]
    private $headers = [];

    /**
     * Part infomations
     * 
     * @Accessor(getter="getPartInfos", setter="setPartInfos")
     * @Type("array<Zimbra\Mail\Struct\PartInfo>")
     * @XmlList(inline=true, entry="mp", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getPartInfos', setter: 'setPartInfos')]
    #[Type('array<Zimbra\Mail\Struct\PartInfo>')]
    #[XmlList(inline: true, entry: 'mp', namespace: 'urn:zimbraMail')]
    private $partInfos = [];

    /**
     * Share notifications
     * 
     * @Accessor(getter="getShareNotifications", setter="setShareNotifications")
     * @Type("array<Zimbra\Mail\Struct\ShareNotification>")
     * @XmlList(inline=true, entry="shr", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getShareNotifications', setter: 'setShareNotifications')]
    #[Type('array<Zimbra\Mail\Struct\ShareNotification>')]
    #[XmlList(inline: true, entry: 'shr', namespace: 'urn:zimbraMail')]
    private $shareNotifications = [];

    /**
     * DL subscription notifications
     * 
     * @Accessor(getter="getDlSubs", setter="setDlSubs")
     * @Type("array<Zimbra\Mail\Struct\DLSubscriptionNotification>")
     * @XmlList(inline=true, entry="dlSubs", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getDlSubs', setter: 'setDlSubs')]
    #[Type('array<Zimbra\Mail\Struct\DLSubscriptionNotification>')]
    #[XmlList(inline: true, entry: 'dlSubs', namespace: 'urn:zimbraMail')]
    private $dlSubs = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  int $imapUid
     * @param  string $calendarIntendedFor
     * @param  string $origId
     * @param  ReplyType $draftReplyType
     * @param  string $identityId
     * @param  string $draftAccountId
     * @param  int $draftAutoSendTime
     * @param  int $sentDate
     * @param  int $resentDate
     * @param  string $part
     * @param  string $fragment
     * @param  array $emails
     * @param  string $subject
     * @param  string $messageIdHeader
     * @param  string $inReplyTo
     * @param  InviteInfo $invite
     * @param  array $headers
     * @param  array $partInfos
     * @param  array $shareNotifications
     * @param  array $dlSubs
     * @param  int $size
     * @param  int $date
     * @param  string $folder
     * @param  string $conversationId
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  int $revision
     * @param  int $changeDate
     * @param  int $modifiedSequence
     * @param  array $metadatas
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?int $imapUid = NULL,
        ?string $calendarIntendedFor = NULL,
        ?string $origId = NULL,
        ?ReplyType $draftReplyType = NULL,
        ?string $identityId = NULL,
        ?string $draftAccountId = NULL,
        ?int $draftAutoSendTime = NULL,
        ?int $sentDate = NULL,
        ?int $resentDate = NULL,
        ?string $part = NULL,
        ?string $fragment = NULL,
        array $emails = [],
        ?string $subject = NULL,
        ?string $messageIdHeader = NULL,
        ?string $inReplyTo = NULL,
        ?InviteInfo $invite = NULL,
        array $headers = [],
        array $partInfos = [],
        array $shareNotifications = [],
        array $dlSubs = [],
        ?int $size = NULL,
        ?int $date = NULL,
        ?string $folder = NULL,
        ?string $conversationId = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?int $revision = NULL,
        ?int $changeDate = NULL,
        ?int $modifiedSequence = NULL,
        array $metadatas = []
    )
    {
	    parent::__construct(
	        $size,
	        $date,
	        $folder,
	        $conversationId,
	        $flags,
	        $tags,
	        $tagNames,
	        $revision,
	        $changeDate,
	        $modifiedSequence,
	        $metadatas
	    );

        $this->setEmails($emails)
        	 ->setHeaders($headers)
        	 ->setPartInfos($partInfos)
        	 ->setShareNotifications($shareNotifications)
        	 ->setDlSubs($dlSubs);
        $this->draftReplyType = $draftReplyType;
        $this->invite = $invite;
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $imapUid) {
            $this->setImapUid($imapUid);
        }
        if (NULL !== $calendarIntendedFor) {
            $this->setCalendarIntendedFor($calendarIntendedFor);
        }
        if (NULL !== $origId) {
            $this->setOrigId($origId);
        }
        if (NULL !== $identityId) {
            $this->setIdentityId($identityId);
        }
        if (NULL !== $draftAccountId) {
            $this->setDraftAccountId($draftAccountId);
        }
        if (NULL !== $draftAutoSendTime) {
            $this->setDraftAutoSendTime($draftAutoSendTime);
        }
        if (NULL !== $sentDate) {
            $this->setSentDate($sentDate);
        }
        if (NULL !== $resentDate) {
            $this->setResentDate($resentDate);
        }
        if (NULL !== $part) {
            $this->setPart($part);
        }
        if (NULL !== $fragment) {
            $this->setFragment($fragment);
        }
        if (NULL !== $subject) {
            $this->setSubject($subject);
        }
        if (NULL !== $messageIdHeader) {
            $this->setMessageIdHeader($messageIdHeader);
        }
        if (NULL !== $inReplyTo) {
            $this->setInReplyTo($inReplyTo);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get imapUid
     *
     * @return int
     */
    public function getImapUid(): ?int
    {
        return $this->imapUid;
    }

    /**
     * Set imapUid
     *
     * @param  int $imapUid
     * @return self
     */
    public function setImapUid(int $imapUid): self
    {
        $this->imapUid = $imapUid;
        return $this;
    }

    /**
     * Get calendarIntendedFor
     *
     * @return string
     */
    public function getCalendarIntendedFor(): ?string
    {
        return $this->calendarIntendedFor;
    }

    /**
     * Set calendarIntendedFor
     *
     * @param  string $calendarIntendedFor
     * @return self
     */
    public function setCalendarIntendedFor(string $calendarIntendedFor): self
    {
        $this->calendarIntendedFor = $calendarIntendedFor;
        return $this;
    }

    /**
     * Get origId
     *
     * @return string
     */
    public function getOrigId(): ?string
    {
        return $this->origId;
    }

    /**
     * Set origId
     *
     * @param  string $origId
     * @return self
     */
    public function setOrigId(string $origId): self
    {
        $this->origId = $origId;
        return $this;
    }

    /**
     * Get draftReplyType
     *
     * @return ReplyType
     */
    public function getDraftReplyType(): ?ReplyType
    {
        return $this->draftReplyType;
    }

    /**
     * Set draftReplyType
     *
     * @param  ReplyType $draftReplyType
     * @return self
     */
    public function setDraftReplyType(ReplyType $draftReplyType): self
    {
        $this->draftReplyType = $draftReplyType;
        return $this;
    }

    /**
     * Get identityId
     *
     * @return string
     */
    public function getIdentityId(): ?string
    {
        return $this->identityId;
    }

    /**
     * Set identityId
     *
     * @param  string $identityId
     * @return self
     */
    public function setIdentityId(string $identityId): self
    {
        $this->identityId = $identityId;
        return $this;
    }

    /**
     * Get draftAccountId
     *
     * @return string
     */
    public function getDraftAccountId(): ?string
    {
        return $this->draftAccountId;
    }

    /**
     * Set draftAccountId
     *
     * @param  string $draftAccountId
     * @return self
     */
    public function setDraftAccountId(string $draftAccountId): self
    {
        $this->draftAccountId = $draftAccountId;
        return $this;
    }

    /**
     * Get draftAutoSendTime
     *
     * @return int
     */
    public function getDraftAutoSendTime(): ?int
    {
        return $this->draftAutoSendTime;
    }

    /**
     * Set draftAutoSendTime
     *
     * @param  int $draftAutoSendTime
     * @return self
     */
    public function setDraftAutoSendTime(int $draftAutoSendTime): self
    {
        $this->draftAutoSendTime = $draftAutoSendTime;
        return $this;
    }

    /**
     * Get sentDate
     *
     * @return int
     */
    public function getSentDate(): ?int
    {
        return $this->sentDate;
    }

    /**
     * Set sentDate
     *
     * @param  int $sentDate
     * @return self
     */
    public function setSentDate(int $sentDate): self
    {
        $this->sentDate = $sentDate;
        return $this;
    }

    /**
     * Get resentDate
     *
     * @return int
     */
    public function getResentDate(): ?int
    {
        return $this->resentDate;
    }

    /**
     * Set resentDate
     *
     * @param  int $resentDate
     * @return self
     */
    public function setResentDate(int $resentDate): self
    {
        $this->resentDate = $resentDate;
        return $this;
    }

    /**
     * Get part
     *
     * @return string
     */
    public function getPart(): ?string
    {
        return $this->part;
    }

    /**
     * Set part
     *
     * @param  string $part
     * @return self
     */
    public function setPart(string $part): self
    {
        $this->part = $part;
        return $this;
    }

    /**
     * Get fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Set fragment
     *
     * @param  string $fragment
     * @return self
     */
    public function setFragment(string $fragment): self
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * Set emails
     *
     * @param  array $emails
     * @return self
     */
    public function setEmails(array $emails): self
    {
        return $this->setEmailInterfaces($emails);
    }

    /**
     * Get emails
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->getEmailInterfaces();
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set subject
     *
     * @param  string $subject
     * @return self
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get messageIdHeader
     *
     * @return string
     */
    public function getMessageIdHeader(): ?string
    {
        return $this->messageIdHeader;
    }

    /**
     * Set messageIdHeader
     *
     * @param  string $messageIdHeader
     * @return self
     */
    public function setMessageIdHeader(string $messageIdHeader): self
    {
        $this->messageIdHeader = $messageIdHeader;
        return $this;
    }

    /**
     * Get inReplyTo
     *
     * @return string
     */
    public function getInReplyTo(): ?string
    {
        return $this->inReplyTo;
    }

    /**
     * Set inReplyTo
     *
     * @param  string $inReplyTo
     * @return self
     */
    public function setInReplyTo(string $inReplyTo): self
    {
        $this->inReplyTo = $inReplyTo;
        return $this;
    }

    /**
     * Get invite
     *
     * @return InviteInfo
     */
    public function getInvite(): ?InviteInfo
    {
        $invite = $this->getInvitInterface();
        return ($invite instanceof InviteInfo) ? $invite : NULL;
    }

    /**
     * Set invite
     *
     * @param  InviteInfo $invite
     * @return self
     */
    public function setInvite(InviteInfo $invite): self
    {
        return $this->setInviteInterface($invite);
    }

    /**
     * Set headers
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = array_filter($headers, static fn($header) => $header instanceof KeyValuePair);
        return $this;
    }

    /**
     * Get headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set partInfos
     *
     * @param  array $partInfos
     * @return self
     */
    public function setPartInfos(array $partInfos): self
    {
        $this->partInfos = array_filter($partInfos, static fn($partInfo) => $partInfo instanceof PartInfo);
        return $this;
    }

    /**
     * Get partInfos
     *
     * @return array
     */
    public function getPartInfos(): array
    {
        return $this->partInfos;
    }

    /**
     * Set shareNotifications
     *
     * @param  array $notifications
     * @return self
     */
    public function setShareNotifications(array $notifications): self
    {
        $this->shareNotifications = array_filter($notifications, static fn($shr) => $shr instanceof ShareNotification);
        return $this;
    }

    /**
     * Get shareNotifications
     *
     * @return array
     */
    public function getShareNotifications(): array
    {
        return $this->shareNotifications;
    }

    /**
     * Set dlSubs
     *
     * @param  array $dlSubs
     * @return self
     */
    public function setDlSubs(array $dlSubs): self
    {
        $this->dlSubs = array_filter($dlSubs, static fn($dlSub) => $dlSub instanceof DLSubscriptionNotification);
        return $this;
    }

    /**
     * Get dlSubs
     *
     * @return array
     */
    public function getDlSubs(): array
    {
        return $this->dlSubs;
    }

    public function setEmailInterfaces(array $emails): self
    {
        $this->emails = array_filter($emails, static fn($email) => $email instanceof EmailInfoInterface);
        return $this;
    }

    public function setInviteInterface(InviteInfoInterface $invite): self
    {
        $this->invite = $invite;
        return $this;
    }

    public function getEmailInterfaces(): array
    {
        return $this->emails;
    }

    public function getInvitInterface(): ?InviteInfoInterface
    {
        return $this->invite;
    }

    public function createFromId(string $id): MessageInfoInterface {
        return new MessageInfo($id);
    }
}
