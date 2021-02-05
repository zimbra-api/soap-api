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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};
use Zimbra\Enum\ReplyType;

/**
 * Msg class
 * A message
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="msg")
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
     * @Type("Zimbra\Enum\ReplyType")
     * @XmlAttribute
     */
    private $replyType;

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
     * @SerializedName("header")
     * @Type("array<Zimbra\Mail\Struct\Header>")
     * @XmlList(inline = true, entry = "header")
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
     * @XmlElement(cdata = false)
     */
    private $content;

    /**
     * Mime part information
     * @Accessor(getter="getMimePart", setter="setMimePart")
     * @SerializedName("mp")
     * @Type("Zimbra\Mail\Struct\MimePartInfo")
     * @XmlElement
     */
    private $mimePart;

    /**
     * Attachments information
     * @Accessor(getter="getAttachments", setter="setAttachments")
     * @SerializedName("attach")
     * @Type("Zimbra\Mail\Struct\AttachmentsInfo")
     * @XmlElement
     */
    private $attachments;

    /**
     * Invite information
     * @Accessor(getter="getInvite", setter="setInvite")
     * @SerializedName("inv")
     * @Type("Zimbra\Mail\Struct\InvitationInfo")
     * @XmlElement
     */
    private $invite;

    /**
     * Email address information
     * @Accessor(getter="getEmailAddresses", setter="setEmailAddresses")
     * @SerializedName("e")
     * @Type("array<Zimbra\Mail\Struct\EmailAddrInfo>")
     * @XmlList(inline = true, entry = "e")
     */
    private $emailAddresses = [];

    /**
     * Timezones
     * @Accessor(getter="getTimezones", setter="setTimezones")
     * @SerializedName("tz")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline = true, entry = "tz")
     */
    private $timezones = [];

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata = false)
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
     * Gets attachmentId
     *
     * @return string
     */
    public function getAttachmentId(): ?string
    {
        return $this->attachmentId;
    }

    /**
     * Sets attachmentId
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
     * Gets replyType
     *
     * @return ReplyType
     */
    public function getReplyType(): ?ReplyType
    {
        return $this->replyType;
    }

    /**
     * Sets replyType
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
     * Sets headers
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = [];
        foreach ($headers as $header) {
            if ($header instanceof Header) {
                $this->headers[] = $header;
            }
        }
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
     * @param  Header $header
     * @return self
     */
    public function addHeader(Header $header): self
    {
        $this->headers[] = $header;
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
     * Gets folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
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
     * Gets flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Sets flags
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
     * Gets content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Sets content
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
     * Gets attachments
     *
     * @return AttachmentsInfo
     */
    public function getAttachments(): ?AttachmentsInfo
    {
        return $this->attachments;
    }

    /**
     * Sets attachments
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
     * Gets invite
     *
     * @return InvitationInfo
     */
    public function getInvite(): ?InvitationInfo
    {
        return $this->invite;
    }

    /**
     * Sets invite
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
     * Sets emailAddresses
     *
     * @param  array $emailAddresses
     * @return self
     */
    public function setEmailAddresses(array $emailAddresses): self
    {
        $this->emailAddresses = [];
        foreach ($emailAddresses as $emailAddress) {
            if ($emailAddress instanceof EmailAddrInfo) {
                $this->emailAddresses[] = $emailAddress;
            }
        }
        return $this;
    }

    /**
     * Gets emailAddresses
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
     * Sets timezones
     *
     * @param  array $timezones
     * @return self
     */
    public function setTimezones(array $timezones): self
    {
        $this->timezones = [];
        foreach ($timezones as $timezone) {
            if ($timezone instanceof CalTZInfo) {
                $this->timezones[] = $timezone;
            }
        }
        return $this;
    }

    /**
     * Gets timezones
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
}