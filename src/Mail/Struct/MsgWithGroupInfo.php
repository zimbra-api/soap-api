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
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Struct\{KeyValuePair, UrlAndValue};

/**
 * MsgWithGroupInfo class
 * Message with group information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MsgWithGroupInfo extends MessageCommon
{
    /**
     * Message ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * IMAP UID
     *
     * @var int
     */
    #[Accessor(getter: "getImapUid", setter: "setImapUid")]
    #[SerializedName("i4uid")]
    #[Type("int")]
    #[XmlAttribute]
    private $imapUid;

    /**
     * X-Zimbra-Calendar-Intended-For header
     *
     * @var string
     */
    #[
        Accessor(
            getter: "getCalendarIntendedFor",
            setter: "setCalendarIntendedFor"
        )
    ]
    #[SerializedName("cif")]
    #[Type("string")]
    #[XmlAttribute]
    private $calendarIntendedFor;

    /**
     * Message id of the message being replied to/forwarded (outbound messages only)
     *
     * @var string
     */
    #[Accessor(getter: "getOrigId", setter: "setOrigId")]
    #[SerializedName("origid")]
    #[Type("string")]
    #[XmlAttribute]
    private $origId;

    /**
     * Reply type - r|w
     *
     * @var ReplyType
     */
    #[Accessor(getter: "getDraftReplyType", setter: "setDraftReplyType")]
    #[SerializedName("rt")]
    #[XmlAttribute]
    private ?ReplyType $draftReplyType;

    /**
     * If set, this specifies the identity being used to compose the message
     *
     * @var string
     */
    #[Accessor(getter: "getIdentityId", setter: "setIdentityId")]
    #[SerializedName("idnt")]
    #[Type("string")]
    #[XmlAttribute]
    private $identityId;

    /**
     * Draft account ID
     *
     * @var string
     */
    #[Accessor(getter: "getDraftAccountId", setter: "setDraftAccountId")]
    #[SerializedName("forAcct")]
    #[Type("string")]
    #[XmlAttribute]
    private $draftAccountId;

    /**
     * Can optionally set this to specify the time at which the draft should be automatically sent by the server
     *
     * @var int
     */
    #[Accessor(getter: "getDraftAutoSendTime", setter: "setDraftAutoSendTime")]
    #[SerializedName("autoSendTime")]
    #[Type("int")]
    #[XmlAttribute]
    private $draftAutoSendTime;

    /**
     * Date header
     *
     * @var int
     */
    #[Accessor(getter: "getSentDate", setter: "setSentDate")]
    #[SerializedName("sd")]
    #[Type("int")]
    #[XmlAttribute]
    private $sentDate;

    /**
     * Resent date
     *
     * @var int
     */
    #[Accessor(getter: "getResentDate", setter: "setResentDate")]
    #[SerializedName("rd")]
    #[Type("int")]
    #[XmlAttribute]
    private $resentDate;

    /**
     * Part
     *
     * @var string
     */
    #[Accessor(getter: "getPart", setter: "setPart")]
    #[SerializedName("part")]
    #[Type("string")]
    #[XmlAttribute]
    private $part;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     *
     * @var string
     */
    #[Accessor(getter: "getFragment", setter: "setFragment")]
    #[SerializedName("fr")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $fragment;

    /**
     * Email addresses
     *
     * @var array
     */
    #[Accessor(getter: "getEmails", setter: "setEmails")]
    #[Type("array<Zimbra\Mail\Struct\EmailInfo>")]
    #[XmlList(inline: true, entry: "e", namespace: "urn:zimbraMail")]
    private $emails = [];

    /**
     * Subject
     *
     * @var string
     */
    #[Accessor(getter: "getSubject", setter: "setSubject")]
    #[SerializedName("su")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $subject;

    /**
     * Message ID
     *
     * @var string
     */
    #[Accessor(getter: "getMessageIdHeader", setter: "setMessageIdHeader")]
    #[SerializedName("mid")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $messageIdHeader;

    /**
     * Message-ID header for message being replied to
     *
     * @var string
     */
    #[Accessor(getter: "getInReplyTo", setter: "setInReplyTo")]
    #[SerializedName("irt")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $inReplyTo;

    /**
     * Invite information
     *
     * @var InviteWithGroupInfo
     */
    #[Accessor(getter: "getInvite", setter: "setInvite")]
    #[SerializedName("inv")]
    #[Type(InviteWithGroupInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?InviteWithGroupInfo $invite;

    /**
     * Headers
     *
     * @var array
     */
    #[Accessor(getter: "getHeaders", setter: "setHeaders")]
    #[Type("array<Zimbra\Common\Struct\KeyValuePair>")]
    #[XmlList(inline: true, entry: "header", namespace: "urn:zimbraMail")]
    private $headers = [];

    /**
     * Mime part information
     *
     * @var PartInfo
     */
    #[Accessor(getter: "getMimePart", setter: "setMimePart")]
    #[SerializedName("mp")]
    #[Type(PartInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?PartInfo $mimePart;

    /**
     * Share Notification information
     *
     * @var ShareNotification
     */
    #[Accessor(getter: "getShareNotification", setter: "setShareNotification")]
    #[SerializedName("shr")]
    #[Type(ShareNotification::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?ShareNotification $shr;

    /**
     * DL Subscription Notification information
     *
     * @var DLSubscriptionNotification
     */
    #[Accessor(getter: "getDLSubscription", setter: "setDLSubscription")]
    #[SerializedName("dlSubs")]
    #[Type(DLSubscriptionNotification::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?DLSubscriptionNotification $dlSubs;

    /**
     * Content
     *
     * @var UrlAndValue
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[SerializedName("content")]
    #[Type(UrlAndValue::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?UrlAndValue $content;

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
     * @param  InviteWithGroupInfo $invite
     * @param  array $headers
     * @param  PartInfo $mimePart
     * @param  ShareNotification $shr
     * @param  DLSubscriptionNotification $dlSubs
     * @param  UrlAndValue $content = null
     * @return self
     */
    public function __construct(
        ?string $id = null,
        ?int $imapUid = null,
        ?string $calendarIntendedFor = null,
        ?string $origId = null,
        ?ReplyType $draftReplyType = null,
        ?string $identityId = null,
        ?string $draftAccountId = null,
        ?int $draftAutoSendTime = null,
        ?int $sentDate = null,
        ?int $resentDate = null,
        ?string $part = null,
        ?string $fragment = null,
        array $emails = [],
        ?string $subject = null,
        ?string $messageIdHeader = null,
        ?string $inReplyTo = null,
        ?InviteWithGroupInfo $invite = null,
        array $headers = [],
        ?PartInfo $mimePart = null,
        ?ShareNotification $shr = null,
        ?DLSubscriptionNotification $dlSubs = null,
        ?UrlAndValue $content = null
    ) {
        $this->setHeaders($headers)->setEmails($emails);
        $this->draftReplyType = $draftReplyType;
        $this->invite = $invite;
        $this->mimePart = $mimePart;
        $this->shr = $shr;
        $this->dlSubs = $dlSubs;
        $this->content = $content;
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $imapUid) {
            $this->setImapUid($imapUid);
        }
        if (null !== $calendarIntendedFor) {
            $this->setCalendarIntendedFor($calendarIntendedFor);
        }
        if (null !== $origId) {
            $this->setOrigId($origId);
        }
        if (null !== $identityId) {
            $this->setIdentityId($identityId);
        }
        if (null !== $draftAccountId) {
            $this->setDraftAccountId($draftAccountId);
        }
        if (null !== $draftAutoSendTime) {
            $this->setDraftAutoSendTime($draftAutoSendTime);
        }
        if (null !== $sentDate) {
            $this->setSentDate($sentDate);
        }
        if (null !== $resentDate) {
            $this->setResentDate($resentDate);
        }
        if (null !== $part) {
            $this->setPart($part);
        }
        if (null !== $fragment) {
            $this->setFragment($fragment);
        }
        if (null !== $subject) {
            $this->setSubject($subject);
        }
        if (null !== $messageIdHeader) {
            $this->setMessageIdHeader($messageIdHeader);
        }
        if (null !== $inReplyTo) {
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
        $this->emails = array_filter(
            $emails,
            static fn($email) => $email instanceof EmailInfo
        );
        return $this;
    }

    /**
     * Get emails
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
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
     * @return InviteWithGroupInfo
     */
    public function getInvite(): ?InviteWithGroupInfo
    {
        return $this->invite;
    }

    /**
     * Set invite
     *
     * @param  InviteWithGroupInfo $invite
     * @return self
     */
    public function setInvite(InviteWithGroupInfo $invite): self
    {
        $this->invite = $invite;
        return $this;
    }

    /**
     * Set headers
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = array_filter(
            $headers,
            static fn($header) => $header instanceof KeyValuePair
        );
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
     * Get content
     *
     * @return UrlAndValue
     */
    public function getContent(): ?UrlAndValue
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  UrlAndValue $content
     * @return self
     */
    public function setContent(UrlAndValue $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get mimePart
     *
     * @return PartInfo
     */
    public function getMimePart(): ?PartInfo
    {
        return $this->mimePart;
    }

    /**
     * Set mimePart
     *
     * @param  PartInfo $mimePart
     * @return self
     */
    public function setMimePart(PartInfo $mimePart): self
    {
        $this->mimePart = $mimePart;
        return $this;
    }

    /**
     * Get shr
     *
     * @return ShareNotification
     */
    public function getShareNotification(): ?ShareNotification
    {
        return $this->shr;
    }

    /**
     * Set shr
     *
     * @param  ShareNotification $shr
     * @return self
     */
    public function setShareNotification(ShareNotification $shr): self
    {
        $this->shr = $shr;
        return $this;
    }

    /**
     * Set dlSubs
     *
     * @param  DLSubscriptionNotification $dlSubs
     * @return self
     */
    public function setDLSubscription(DLSubscriptionNotification $dlSubs): self
    {
        $this->dlSubs = $dlSubs;
        return $this;
    }

    /**
     * Get dlSubs
     *
     * @return DLSubscriptionNotification
     */
    public function getDLSubscription(): ?DLSubscriptionNotification
    {
        return $this->dlSubs;
    }
}
