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

/**
 * Msg class
 * A message
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Msg
{
    /**
     * Uploaded MIME body ID
     *
     * @var string
     */
    #[Accessor(getter: "getAttachmentId", setter: "setAttachmentId")]
    #[SerializedName("aid")]
    #[Type("string")]
    #[XmlAttribute]
    private $attachmentId;

    /**
     * Original ID
     *
     * @var string
     */
    #[Accessor(getter: "getOrigId", setter: "setOrigId")]
    #[SerializedName("origid")]
    #[Type("string")]
    #[XmlAttribute]
    private $origId;

    /**
     * Reply type - r|w.  (r)eplied or for(w)arded.
     *
     * @var ReplyType
     */
    #[Accessor(getter: "getReplyType", setter: "setReplyType")]
    #[SerializedName("rt")]
    #[XmlAttribute]
    private ?ReplyType $replyType;

    /**
     * Identity ID.  The identity referenced by {identity-id} specifies the folder where the sent message is saved.
     *
     * @var string
     */
    #[Accessor(getter: "getIdentityId", setter: "setIdentityId")]
    #[SerializedName("idnt")]
    #[Type("string")]
    #[XmlAttribute]
    private $identityId;

    /**
     * Subject
     *
     * @var string
     */
    #[Accessor(getter: "getSubject", setter: "setSubject")]
    #[SerializedName("su")]
    #[Type("string")]
    #[XmlAttribute]
    private $subject;

    /**
     * Headers
     *
     * @var array
     */
    #[Accessor(getter: "getHeaders", setter: "setHeaders")]
    #[Type("array<Zimbra\Mail\Struct\Header>")]
    #[XmlList(inline: true, entry: "header", namespace: "urn:zimbraMail")]
    private $headers = [];

    /**
     * Message-ID header for message being replied to
     *
     * @var string
     */
    #[Accessor(getter: "getInReplyTo", setter: "setInReplyTo")]
    #[SerializedName("irt")]
    #[Type("string")]
    #[XmlAttribute]
    private $inReplyTo;

    /**
     * Folder ID
     *
     * @var string
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private $folderId;

    /**
     * Flags
     *
     * @var string
     */
    #[Accessor(getter: "getFlags", setter: "setFlags")]
    #[SerializedName("f")]
    #[Type("string")]
    #[XmlAttribute]
    private $flags;

    /**
     * Content
     *
     * @var string
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[SerializedName("content")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $content;

    /**
     * Mime part information
     *
     * @var MimePartInfo
     */
    #[Accessor(getter: "getMimePart", setter: "setMimePart")]
    #[SerializedName("mp")]
    #[Type(MimePartInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?MimePartInfo $mimePart;

    /**
     * Attachments information
     *
     * @var AttachmentsInfo
     */
    #[Accessor(getter: "getAttachments", setter: "setAttachments")]
    #[SerializedName("attach")]
    #[Type(AttachmentsInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?AttachmentsInfo $attachments;

    /**
     * Invite information
     *
     * @var InvitationInfo
     */
    #[Accessor(getter: "getInvite", setter: "setInvite")]
    #[SerializedName("inv")]
    #[Type(InvitationInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?InvitationInfo $invite;

    /**
     * Email address information
     *
     * @var array
     */
    #[Accessor(getter: "getEmailAddresses", setter: "setEmailAddresses")]
    #[Type("array<Zimbra\Mail\Struct\EmailAddrInfo>")]
    #[XmlList(inline: true, entry: "e", namespace: "urn:zimbraMail")]
    private $emailAddresses = [];

    /**
     * Timezones
     *
     * @var array
     */
    #[Accessor(getter: "getTimezones", setter: "setTimezones")]
    #[Type("array<Zimbra\Mail\Struct\CalTZInfo>")]
    #[XmlList(inline: true, entry: "tz", namespace: "urn:zimbraMail")]
    private $timezones = [];

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
     * Constructor
     *
     * @param  string $attachmentId
     * @param  string $origId
     * @param  ReplyType $replyType
     * @param  string $identityId
     * @param  string $subject
     * @param  array $headers
     * @param  string $inReplyTo
     * @param  string $folderId
     * @param  string $flags
     * @param  string $content
     * @param  MimePartInfo $mimePart
     * @param  AttachmentsInfo $attachments
     * @param  InvitationInfo $invite
     * @param  array $emailAddresses
     * @param  array $timezones
     * @param  string $fragment
     * @return self
     */
    public function __construct(
        ?string $attachmentId = null,
        ?string $origId = null,
        ?ReplyType $replyType = null,
        ?string $identityId = null,
        ?string $subject = null,
        array $headers = [],
        ?string $inReplyTo = null,
        ?string $folderId = null,
        ?string $flags = null,
        ?string $content = null,
        ?MimePartInfo $mimePart = null,
        ?AttachmentsInfo $attachments = null,
        ?InvitationInfo $invite = null,
        array $emailAddresses = [],
        array $timezones = [],
        ?string $fragment = null
    ) {
        $this->setHeaders($headers)
            ->setEmailAddresses($emailAddresses)
            ->setTimezones($timezones);
        $this->replyType = $replyType;
        $this->mimePart = $mimePart;
        $this->attachments = $attachments;
        $this->invite = $invite;
        if (null !== $attachmentId) {
            $this->setAttachmentId($attachmentId);
        }
        if (null !== $origId) {
            $this->setOrigId($origId);
        }
        if (null !== $identityId) {
            $this->setIdentityId($identityId);
        }
        if (null !== $subject) {
            $this->setSubject($subject);
        }
        if (null !== $inReplyTo) {
            $this->setInReplyTo($inReplyTo);
        }
        if (null !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (null !== $flags) {
            $this->setFlags($flags);
        }
        if (null !== $content) {
            $this->setContent($content);
        }
        if (null !== $fragment) {
            $this->setFragment($fragment);
        }
    }

    /**
     * Get attachmentId
     *
     * @return string
     */
    public function getAttachmentId(): ?string
    {
        return $this->attachmentId;
    }

    /**
     * Set attachmentId
     *
     * @param  string $attachmentId
     * @return self
     */
    public function setAttachmentId(string $attachmentId): self
    {
        $this->attachmentId = $attachmentId;
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
     * Get replyType
     *
     * @return ReplyType
     */
    public function getReplyType(): ?ReplyType
    {
        return $this->replyType;
    }

    /**
     * Set replyType
     *
     * @param  ReplyType $replyType
     * @return self
     */
    public function setReplyType(ReplyType $replyType): self
    {
        $this->replyType = $replyType;
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
     * Set headers
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = array_filter(
            $headers,
            static fn($header) => $header instanceof Header
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
     * Add header
     *
     * @param  Header $header
     * @return self
     */
    public function addHeader(Header $header): self
    {
        $this->headers[] = $header;
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
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Get flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Set flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags(string $flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get mimePart
     *
     * @return MimePartInfo
     */
    public function getMimePart(): ?MimePartInfo
    {
        return $this->mimePart;
    }

    /**
     * Set mimePart
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
     * Get attachments
     *
     * @return AttachmentsInfo
     */
    public function getAttachments(): ?AttachmentsInfo
    {
        return $this->attachments;
    }

    /**
     * Set attachments
     *
     * @param  AttachmentsInfo $attachments
     * @return self
     */
    public function setAttachments(AttachmentsInfo $attachments): self
    {
        $this->attachments = $attachments;
        return $this;
    }

    /**
     * Get invite
     *
     * @return InvitationInfo
     */
    public function getInvite(): ?InvitationInfo
    {
        return $this->invite;
    }

    /**
     * Set invite
     *
     * @param  InvitationInfo $invite
     * @return self
     */
    public function setInvite(InvitationInfo $invite): self
    {
        $this->invite = $invite;
        return $this;
    }

    /**
     * Set emailAddresses
     *
     * @param  array $addresses
     * @return self
     */
    public function setEmailAddresses(array $addresses): self
    {
        $this->emailAddresses = array_filter(
            $addresses,
            static fn($address) => $address instanceof EmailAddrInfo
        );
        return $this;
    }

    /**
     * Get emailAddresses
     *
     * @return array
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses;
    }

    /**
     * Add emailAddress
     *
     * @param  EmailAddrInfo $emailAddress
     * @return self
     */
    public function addEmailAddress(EmailAddrInfo $emailAddress): self
    {
        $this->emailAddresses[] = $emailAddress;
        return $this;
    }

    /**
     * Set timezones
     *
     * @param  array $timezones
     * @return self
     */
    public function setTimezones(array $timezones): self
    {
        $this->timezones = array_filter(
            $timezones,
            static fn($timezone) => $timezone instanceof CalTZInfo
        );
        return $this;
    }

    /**
     * Get timezones
     *
     * @return array
     */
    public function getTimezones(): array
    {
        return $this->timezones;
    }

    /**
     * Add timezone
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function addTimezone(CalTZInfo $timezone): self
    {
        $this->timezones[] = $timezone;
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
}
