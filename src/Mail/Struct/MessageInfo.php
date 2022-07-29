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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MessageInfo extends MessageCommon implements MessageInfoInterface
{
    /**
     * Message ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * IMAP UID
     * @Accessor(getter="getImapUid", setter="setImapUid")
     * @SerializedName("i4uid")
     * @Type("integer")
     * @XmlAttribute
     */
    private $imapUid;

    /**
     * X-Zimbra-Calendar-Intended-For header
     * @Accessor(getter="getCalendarIntendedFor", setter="setCalendarIntendedFor")
     * @SerializedName("cif")
     * @Type("string")
     * @XmlAttribute
     */
    private $calendarIntendedFor;

    /**
     * Message id of the message being replied to/forwarded (outbound messages only)
     * @Accessor(getter="getOrigId", setter="setOrigId")
     * @SerializedName("origid")
     * @Type("string")
     * @XmlAttribute
     */
    private $origId;

    /**
     * Reply type - r|w: (r)eplied or for(w)arded.
     * @Accessor(getter="getDraftReplyType", setter="setDraftReplyType")
     * @SerializedName("rt")
     * @Type("Zimbra\Common\Enum\ReplyType")
     * @XmlAttribute
     */
    private $draftReplyType;

    /**
     * If set, this specifies the identity being used to compose the message
     * @Accessor(getter="getIdentityId", setter="setIdentityId")
     * @SerializedName("idnt")
     * @Type("string")
     * @XmlAttribute
     */
    private $identityId;

    /**
     * Draft account ID
     * @Accessor(getter="getDraftAccountId", setter="setDraftAccountId")
     * @SerializedName("forAcct")
     * @Type("string")
     * @XmlAttribute
     */
    private $draftAccountId;

    /**
     * Can optionally set this to specify the time at which the draft should be
     * automatically sent by the server
     * @Accessor(getter="getDraftAutoSendTime", setter="setDraftAutoSendTime")
     * @SerializedName("autoSendTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $draftAutoSendTime;

    /**
     * Date header
     * @Accessor(getter="getSentDate", setter="setSentDate")
     * @SerializedName("sd")
     * @Type("integer")
     * @XmlAttribute
     */
    private $sentDate;

    /**
     * Resent date
     * @Accessor(getter="getResentDate", setter="setResentDate")
     * @SerializedName("rd")
     * @Type("integer")
     * @XmlAttribute
     */
    private $resentDate;

    /**
     * Part
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     */
    private $part;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $fragment;

    /**
     * Email addresses
     * @Accessor(getter="getEmails", setter="setEmails")
     * @Type("array<Zimbra\Mail\Struct\EmailInfo>")
     * @XmlList(inline=true, entry="e", namespace="urn:zimbraMail")
     */
    private $emails = [];

    /**
     * Subject
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $subject;

    /**
     * Message ID
     * @Accessor(getter="getMessageIdHeader", setter="setMessageIdHeader")
     * @SerializedName("mid")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $messageIdHeader;

    /**
     * Message-ID header for message being replied to
     * @Accessor(getter="getInReplyTo", setter="setInReplyTo")
     * @SerializedName("irt")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $inReplyTo;

    /**
     * Parsed out iCalendar invite
     * @Accessor(getter="getInvite", setter="setInvite")
     * @SerializedName("inv")
     * @Type("Zimbra\Mail\Struct\InviteInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?InviteInfo $invite = NULL;

    /**
     * Headers
     * @Accessor(getter="getHeaders", setter="setHeaders")
     * @Type("array<Zimbra\Common\Struct\KeyValuePair>")
     * @XmlList(inline=true, entry="header", namespace="urn:zimbraMail")
     */
    private $headers = [];

    /**
     * Part infomations
     * @Accessor(getter="getPartInfos", setter="setPartInfos")
     * @Type("array<Zimbra\Mail\Struct\PartInfo>")
     * @XmlList(inline=true, entry="mp", namespace="urn:zimbraMail")
     */
    private $partInfos = [];

    /**
     * Share notifications
     * @Accessor(getter="getShareNotifications", setter="setShareNotifications")
     * @Type("array<Zimbra\Mail\Struct\ShareNotification>")
     * @XmlList(inline=true, entry="shr", namespace="urn:zimbraMail")
     */
    private $shareNotifications = [];

    /**
     * DL subscription notifications
     * @Accessor(getter="getDlSubs", setter="setDlSubs")
     * @Type("array<Zimbra\Mail\Struct\DLSubscriptionNotification>")
     * @XmlList(inline=true, entry="dlSubs", namespace="urn:zimbraMail")
     */
    private $dlSubs = [];

    /**
     * Constructor method
     *
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
        if (NULL !== $draftReplyType) {
            $this->setDraftReplyType($draftReplyType);
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
        if ($invite instanceof InviteInfo) {
            $this->setInvite($invite);
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
     * Add email
     *
     * @param  EmailInfo $email
     * @return self
     */
    public function addEmail(EmailInfo $email): self
    {
        return $this->addEmailInterface($email);
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
        return $this->getInvitInterfacee();
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
     * Add header
     *
     * @param  Header $header
     * @return self
     */
    public function addHeader(KeyValuePair $header): self
    {
        $this->headers[] = $header;
        return $this;
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
     * Add partInfo
     *
     * @param  PartInfo $partInfo
     * @return self
     */
    public function addPartInfo(PartInfo $partInfo): self
    {
        $this->partInfos[] = $partInfo;
        return $this;
    }

    /**
     * Set shareNotifications
     *
     * @param  array $shareNotifications
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
     * Add shr
     *
     * @param  ShareNotification $shr
     * @return self
     */
    public function addShareNotification(ShareNotification $shr): self
    {
        $this->shareNotifications[] = $shr;
        return $this;
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

    /**
     * Add dlSub
     *
     * @param  DLSubscriptionNotification $dlSub
     * @return self
     */
    public function addDlSub(DLSubscriptionNotification $dlSub): self
    {
        $this->dlSubs[] = $dlSub;
        return $this;
    }

    public function setEmailInterfaces(array $emails): self
    {
        $this->emails = array_filter($emails, static fn($email) => $email instanceof EmailInfoInterface);
        return $this;
    }

    public function addEmailInterface(EmailInfoInterface $email): self
    {
        $this->emails[] = $email;
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

    public function getInvitInterfacee(): ?InviteInfoInterface
    {
        return $this->invite;
    }

    public function createFromId(string $id): MessageInfoInterface {
        return new MessageInfo($id);
    }
}
