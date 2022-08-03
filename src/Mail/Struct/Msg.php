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
     * @Accessor(getter="getAttachmentId", setter="setAttachmentId")
     * @SerializedName("aid")
     * @Type("string")
     * @XmlAttribute
     */
    private $attachmentId;

    /**
     * Original ID
     * @Accessor(getter="getOrigId", setter="setOrigId")
     * @SerializedName("origid")
     * @Type("string")
     * @XmlAttribute
     */
    private $origId;

    /**
     * Reply type - r|w.  (r)eplied or for(w)arded.
     * @Accessor(getter="getReplyType", setter="setReplyType")
     * @SerializedName("rt")
     * @Type("Enum<Zimbra\Common\Enum\ReplyType>")
     * @XmlAttribute
     */
    private ?ReplyType $replyType = NULL;

    /**
     * Identity ID.  The identity referenced by {identity-id} specifies the folder where the sent message is saved.
     * @Accessor(getter="getIdentityId", setter="setIdentityId")
     * @SerializedName("idnt")
     * @Type("string")
     * @XmlAttribute
     */
    private $identityId;

    /**
     * Subject
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlAttribute
     */
    private $subject;

    /**
     * Headers
     * @Accessor(getter="getHeaders", setter="setHeaders")
     * @Type("array<Zimbra\Mail\Struct\Header>")
     * @XmlList(inline=true, entry="header", namespace="urn:zimbraMail")
     */
    private $headers = [];

    /**
     * Message-ID header for message being replied to
     * @Accessor(getter="getInReplyTo", setter="setInReplyTo")
     * @SerializedName("irt")
     * @Type("string")
     * @XmlAttribute
     */
    private $inReplyTo;

    /**
     * Folder ID
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * Flags
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     */
    private $flags;

    /**
     * Content
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $content;

    /**
     * Mime part information
     * @Accessor(getter="getMimePart", setter="setMimePart")
     * @SerializedName("mp")
     * @Type("Zimbra\Mail\Struct\MimePartInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MimePartInfo $mimePart = NULL;

    /**
     * Attachments information
     * @Accessor(getter="getAttachments", setter="setAttachments")
     * @SerializedName("attach")
     * @Type("Zimbra\Mail\Struct\AttachmentsInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?AttachmentsInfo $attachments = NULL;

    /**
     * Invite information
     * @Accessor(getter="getInvite", setter="setInvite")
     * @SerializedName("inv")
     * @Type("Zimbra\Mail\Struct\InvitationInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?InvitationInfo $invite = NULL;

    /**
     * Email address information
     * @Accessor(getter="getEmailAddresses", setter="setEmailAddresses")
     * @Type("array<Zimbra\Mail\Struct\EmailAddrInfo>")
     * @XmlList(inline=true, entry="e", namespace="urn:zimbraMail")
     */
    private $emailAddresses = [];

    /**
     * Timezones
     * @Accessor(getter="getTimezones", setter="setTimezones")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline=true, entry="tz", namespace="urn:zimbraMail")
     */
    private $timezones = [];

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $fragment;

    /**
     * Constructor method for Msg
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
        ?string $attachmentId = NULL,
        ?string $origId = NULL,
        ?ReplyType $replyType = NULL,
        ?string $identityId = NULL,
        ?string $subject = NULL,
        array $headers = [],
        ?string $inReplyTo = NULL,
        ?string $folderId = NULL,
        ?string $flags = NULL,
        ?string $content = NULL,
        ?MimePartInfo $mimePart = NULL,
        ?AttachmentsInfo $attachments = NULL,
        ?InvitationInfo $invite = NULL,
        array $emailAddresses = [],
        array $timezones = [],
        ?string $fragment = NULL
    )
    {
        $this->setHeaders($headers)
             ->setEmailAddresses($emailAddresses)
             ->setTimezones($timezones);
        if (NULL !== $attachmentId) {
            $this->setAttachmentId($attachmentId);
        }
        if (NULL !== $origId) {
            $this->setOrigId($origId);
        }
        if ($replyType instanceof ReplyType) {
            $this->setReplyType($replyType);
        }
        if (NULL !== $identityId) {
            $this->setIdentityId($identityId);
        }
        if (NULL !== $subject) {
            $this->setSubject($subject);
        }
        if (NULL !== $inReplyTo) {
            $this->setInReplyTo($inReplyTo);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
        if ($mimePart instanceof MimePartInfo) {
            $this->setMimePart($mimePart);
        }
        if ($attachments instanceof AttachmentsInfo) {
            $this->setAttachments($attachments);
        }
        if ($invite instanceof InvitationInfo) {
            $this->setInvite($invite);
        }
        if (NULL !== $fragment) {
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
        $this->headers = array_filter($headers, static fn ($header) => $header instanceof Header);
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
        $this->emailAddresses = array_filter($addresses, static fn ($address) => $address instanceof EmailAddrInfo);
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
        $this->timezones = array_filter($timezones, static fn ($timezone) => $timezone instanceof CalTZInfo);
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
