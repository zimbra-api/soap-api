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
use Zimbra\Struct\KeyValuePair;

/**
 * InviteAsMP class
 * Invite-As-MP
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class InviteAsMP extends MessageCommon
{
    /**
     * Sub-part ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * If non-null, this message/rfc822 subpart of the specified Message is serialized
     * instead of the Message itself.
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     */
    private $part;

    /**
     * Sent date
     * @Accessor(getter="getSentDate", setter="setSentDate")
     * @SerializedName("sd")
     * @Type("integer")
     * @XmlAttribute
     */
    private $sentDate;

    /**
     * Email addresses
     * @Accessor(getter="getEmails", setter="setEmails")
     * @SerializedName("e")
     * @Type("array<Zimbra\Mail\Struct\EmailInfo>")
     * @XmlList(inline = true, entry = "e")
     */
    private $emails = [];

    /**
     * Subject
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $subject;

    /**
     * Message ID header
     * @Accessor(getter="getMessageIdHeader", setter="setMessageIdHeader")
     * @SerializedName("mid")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $messageIdHeader;

    /**
     * Invite
     * @Accessor(getter="getInvite", setter="setInvite")
     * @SerializedName("inv")
     * @Type("Zimbra\Mail\Struct\MPInviteInfo")
     * @XmlElement
     */
    private $invite;

    /**
     * Headers
     * @Accessor(getter="getHeaders", setter="setHeaders")
     * @SerializedName("header")
     * @Type("array<Zimbra\Struct\KeyValuePair>")
     * @XmlList(inline = true, entry = "header")
     */
    private $headers = [];

    /**
     * Mime part content elements
     * @Accessor(getter="getMpContentElems", setter="setMpContentElems")
     * @SerializedName("mp")
     * @Type("array<Zimbra\Mail\Struct\PartInfo>")
     * @XmlList(inline = true, entry = "mp")
     */
    private $mpContentElems = [];

    /**
     * Share notifications
     * @Accessor(getter="getShareContentElems", setter="setShareContentElems")
     * @SerializedName("shr")
     * @Type("array<Zimbra\Mail\Struct\ShareNotification>")
     * @XmlList(inline = true, entry = "shr")
     */
    private $shrContentElems = [];

    /**
     * Distribution list subscription notifications
     * @Accessor(getter="getDlSubsContentElems", setter="setDlSubsContentElems")
     * @SerializedName("dlSubs")
     * @Type("array<Zimbra\Mail\Struct\DLSubscriptionNotification>")
     * @XmlList(inline = true, entry = "dlSubs")
     */
    private $dlSubsContentElems = [];

    /**
     * Constructor method for InviteAsMP
     *
     * @param  string $id
     * @param  string $part
     * @param  int $sentDate
     * @param  array $emails
     * @param  string $subject
     * @param  string $messageIdHeader
     * @param  MPInviteInfo $invite
     * @param  array $headers
     * @param  array $contentElems
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $part = NULL,
        ?int $sentDate = NULL,
        array $emails = [],
        ?string $subject = NULL,
        ?string $messageIdHeader = NULL,
        ?MPInviteInfo $invite = NULL,
        array $headers = [],
        array $contentElems = []
    )
    {
        $this->setEmails($emails)
             ->setHeaders($headers)
             ->setContentElems($contentElems);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $part) {
            $this->setPart($part);
        }
        if (NULL !== $sentDate) {
            $this->setSentDate($sentDate);
        }
        if (NULL !== $subject) {
            $this->setSubject($subject);
        }
        if (NULL !== $messageIdHeader) {
            $this->setMessageIdHeader($messageIdHeader);
        }
        if ($invite instanceof MPInviteInfo) {
            $this->setInvite($invite);
        }
    }

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
     * Sets emails
     *
     * @param  array $emails
     * @return self
     */
    public function setEmails(array $emails): self
    {
        $this->emails = [];
        foreach ($emails as $email) {
            if ($email instanceof EmailInfo) {
                $this->emails[] = $email;
            }
        }
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
     * Gets invite
     *
     * @return MPInviteInfo
     */
    public function getInvite(): ?MPInviteInfo
    {
        return $this->invite;
    }

    /**
     * Sets invite
     *
     * @param  MPInviteInfo $invite
     * @return self
     */
    public function setInvite(MPInviteInfo $invite): self
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
        $this->headers = [];
        foreach ($headers as $header) {
            if ($header instanceof KeyValuePair) {
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
     * @param  KeyValuePair $header
     * @return self
     */
    public function addHeader(KeyValuePair $header): self
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Sets contentElems
     *
     * @param  array $contentElems
     * @return self
     */
    public function setContentElems(array $contentElems): self
    {
        $this->mpContentElems = $this->shrContentElems = $this->dlSubsContentElems = [];
        foreach ($contentElems as $contentElem) {
            if ($contentElem instanceof PartInfo) {
                $this->mpContentElems[] = $contentElem;
            }
            if ($contentElem instanceof ShareNotification) {
                $this->shrContentElems[] = $contentElem;
            }
            if ($contentElem instanceof DLSubscriptionNotification) {
                $this->dlSubsContentElems[] = $contentElem;
            }
        }
        return $this;
    }

    /**
     * Gets contentElems
     *
     * @return array
     */
    public function getContentElems(): array
    {
        return array_merge($this->mpContentElems, $this->shrContentElems, $this->dlSubsContentElems);
    }

    /**
     * Sets mpContentElems
     *
     * @param  array $mpContentElems
     * @return self
     */
    public function setMpContentElems(array $mpContentElems): self
    {
        $this->mpContentElems = [];
        foreach ($mpContentElems as $element) {
            if ($element instanceof PartInfo) {
                $this->mpContentElems[] = $element;
            }
        }
        return $this;
    }

    /**
     * Gets mpContentElems
     *
     * @return array
     */
    public function getMpContentElems(): array
    {
        return $this->mpContentElems;
    }

    /**
     * Sets shrContentElems
     *
     * @param  array $shrContentElems
     * @return self
     */
    public function setShareContentElems(array $shrContentElems): self
    {
        $this->shrContentElems = [];
        foreach ($shrContentElems as $element) {
            if ($element instanceof ShareNotification) {
                $this->shrContentElems[] = $element;
            }
        }
        return $this;
    }

    /**
     * Gets shrContentElems
     *
     * @return array
     */
    public function getShareContentElems(): array
    {
        return $this->shrContentElems;
    }

    /**
     * Sets dlSubsContentElems
     *
     * @param  array $dlSubsContentElems
     * @return self
     */
    public function setDlSubsContentElems(array $dlSubsContentElems): self
    {
        $this->dlSubsContentElems = [];
        foreach ($dlSubsContentElems as $element) {
            if ($element instanceof DLSubscriptionNotification) {
                $this->dlSubsContentElems[] = $element;
            }
        }
        return $this;
    }

    /**
     * Gets dlSubsContentElems
     *
     * @return array
     */
    public function getDlSubsContentElems(): array
    {
        return $this->dlSubsContentElems;
    }
}
