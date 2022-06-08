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
    Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList
};
use Zimbra\Common\Struct\{KeyValuePair, UrlAndValue};

/**
 * MsgWithGroupInfo class
 * Message with group information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MsgWithGroupInfo extends MessageCommon
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
     * Reply type - <b>r|w</b>
     * @Accessor(getter="getDraftReplyType", setter="setDraftReplyType")
     * @SerializedName("rt")
     * @Type("string")
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
     * Can optionally set this to specify the time at which the draft should be automatically sent by the server
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
     * @XmlElement(cdata = false, namespace="urn:zimbraMail")
     */
    private $fragment;

    /**
     * Email addresses
     * @Accessor(getter="getEmails", setter="setEmails")
     * @SerializedName("e")
     * @Type("array<Zimbra\Mail\Struct\EmailInfo>")
     * @XmlList(inline = true, entry = "e", namespace="urn:zimbraMail")
     */
    private $emails = [];

    /**
     * Subject
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraMail")
     */
    private $subject;

    /**
     * Message ID
     * @Accessor(getter="getMessageIdHeader", setter="setMessageIdHeader")
     * @SerializedName("mid")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraMail")
     */
    private $messageIdHeader;

    /**
     * Message-ID header for message being replied to
     * @Accessor(getter="getInReplyTo", setter="setInReplyTo")
     * @SerializedName("irt")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraMail")
     */
    private $inReplyTo;

    /**
     * Invite information
     * @Accessor(getter="getInvite", setter="setInvite")
     * @SerializedName("inv")
     * @Type("Zimbra\Mail\Struct\InviteWithGroupInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?InviteWithGroupInfo $invite = NULL;

    /**
     * Headers
     * @Accessor(getter="getHeaders", setter="setHeaders")
     * @SerializedName("header")
     * @Type("array<Zimbra\Common\Struct\KeyValuePair>")
     * @XmlList(inline = true, entry = "header", namespace="urn:zimbraMail")
     */
    private $headers = [];

    /**
     * Mime part information
     * @Accessor(getter="getMimePart", setter="setMimePart")
     * @SerializedName("mp")
     * @Type("Zimbra\Mail\Struct\PartInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MimePartInfo $mimePart = NULL;

    /**
     * Share Notification information
     * @Accessor(getter="getShareNotification", setter="setShareNotification")
     * @SerializedName("shr")
     * @Type("Zimbra\Mail\Struct\ShareNotification")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ShareNotification $shr = NULL;

    /**
     * DL Subscription Notification information
     * @Accessor(getter="getDLSubs", setter="setDLSubs")
     * @SerializedName("dlSubs")
     * @Type("Zimbra\Mail\Struct\DLSubscriptionNotification")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?DLSubscriptionNotification $dlSubs = NULL;

    /**
     * Content
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("Zimbra\Common\Struct\UrlAndValue")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?UrlAndValue $content = NULL;

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
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
     * Gets imapUid
     *
     * @return int
     */
    public function getImapUid(): ?int
    {
        return $this->imapUid;
    }

    /**
     * Sets imapUid
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
     * Gets calendarIntendedFor
     *
     * @return string
     */
    public function getCalendarIntendedFor(): ?string
    {
        return $this->calendarIntendedFor;
    }

    /**
     * Sets calendarIntendedFor
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
     * Gets origId
     *
     * @return string
     */
    public function getOrigId(): ?string
    {
        return $this->origId;
    }

    /**
     * Sets origId
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
     * Gets draftReplyType
     *
     * @return string
     */
    public function getDraftReplyType(): ?string
    {
        return $this->draftReplyType;
    }

    /**
     * Sets draftReplyType
     *
     * @param  string $draftReplyType
     * @return self
     */
    public function setDraftReplyType(string $draftReplyType): self
    {
        $this->draftReplyType = $draftReplyType;
        return $this;
    }

    /**
     * Gets identityId
     *
     * @return string
     */
    public function getIdentityId(): ?string
    {
        return $this->identityId;
    }

    /**
     * Sets identityId
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
     * Gets draftAccountId
     *
     * @return string
     */
    public function getDraftAccountId(): ?string
    {
        return $this->draftAccountId;
    }

    /**
     * Sets draftAccountId
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
     * Gets draftAutoSendTime
     *
     * @return int
     */
    public function getDraftAutoSendTime(): ?int
    {
        return $this->draftAutoSendTime;
    }

    /**
     * Sets draftAutoSendTime
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
     * Gets sentDate
     *
     * @return int
     */
    public function getSentDate(): ?int
    {
        return $this->sentDate;
    }

    /**
     * Sets sentDate
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
     * Gets resentDate
     *
     * @return int
     */
    public function getResentDate(): ?int
    {
        return $this->resentDate;
    }

    /**
     * Sets resentDate
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
     * Gets part
     *
     * @return string
     */
    public function getPart(): ?string
    {
        return $this->part;
    }

    /**
     * Sets part
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
     * Gets fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Sets fragment
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
     * Sets emails
     *
     * @param  array $emails
     * @return self
     */
    public function setEmails(array $emails): self
    {
        $this->emails = array_filter($emails, static fn($email) => $email instanceof EmailInfo);
        return $this;
    }

    /**
     * Gets emails
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * Add email
     *
     * @param  EmailInfo $email
     * @return self
     */
    public function addEmail(EmailInfo $email): self
    {
        $this->emails[] = $email;
        return $this;
    }

    /**
     * Gets subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Sets subject
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
     * Gets messageIdHeader
     *
     * @return string
     */
    public function getMessageIdHeader(): ?string
    {
        return $this->messageIdHeader;
    }

    /**
     * Sets messageIdHeader
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
     * Gets inReplyTo
     *
     * @return string
     */
    public function getInReplyTo(): ?string
    {
        return $this->inReplyTo;
    }

    /**
     * Sets inReplyTo
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
     * Gets invite
     *
     * @return InviteWithGroupInfo
     */
    public function getInvite(): ?InviteWithGroupInfo
    {
        return $this->invite;
    }

    /**
     * Sets invite
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
     * Sets headers
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
     * Gets headers
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
     * @param  KeyValuePair $header
     * @return self
     */
    public function addHeader(KeyValuePair $header): self
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Gets content
     *
     * @return UrlAndValue
     */
    public function getContent(): ?UrlAndValue
    {
        return $this->content;
    }

    /**
     * Sets content
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
     * Gets mimePart
     *
     * @return MimePartInfo
     */
    public function getMimePart(): ?MimePartInfo
    {
        return $this->mimePart;
    }

    /**
     * Sets mimePart
     *
     * @param  MimePartInfo $mimePart
     * @return self
     */
    public function setMimePart(MimePartInfo $mimePart): self
    {
        $this->mimePart = $mimePart;
        return $this;
    }

    /**
     * Gets shr
     *
     * @return ShareNotification
     */
    public function getShareNotification(): ?ShareNotification
    {
        return $this->shr;
    }

    /**
     * Sets shr
     *
     * @param  shr $shr
     * @return self
     */
    public function setShareNotification(ShareNotification $shr): self
    {
        $this->shr = $shr;
        return $this;
    }

    /**
     * Sets dlSubs
     *
     * @param  DLSubscriptionNotification $dlSubs
     * @return self
     */
    public function setDLSubs(DLSubscriptionNotification $dlSubs): self
    {
        $this->dlSubs = $dlSubs;
        return $this;
    }

    /**
     * Gets dlSubs
     *
     * @return DLSubscriptionNotification
     */
    public function getDLSubs(): ?DLSubscriptionNotification
    {
        return $this->dlSubs;
    }
}
