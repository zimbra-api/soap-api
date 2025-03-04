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
use Zimbra\Common\Struct\KeyValuePair;

/**
 * InviteAsMP class
 * Invite-As-MP
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InviteAsMP extends MessageCommon
{
    /**
     * Sub-part ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $id = null;

    /**
     * If non-null, this message/rfc822 subpart of the specified Message is serialized
     * instead of the Message itself.
     *
     * @var string
     */
    #[Accessor(getter: "getPart", setter: "setPart")]
    #[SerializedName("part")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $part = null;

    /**
     * Sent date
     *
     * @var int
     */
    #[Accessor(getter: "getSentDate", setter: "setSentDate")]
    #[SerializedName("sd")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $sentDate = null;

    /**
     * Email addresses
     *
     * @var array
     */
    #[Accessor(getter: "getEmails", setter: "setEmails")]
    #[Type("array<Zimbra\Mail\Struct\EmailInfo>")]
    #[XmlList(inline: true, entry: "e", namespace: "urn:zimbraMail")]
    private array $emails = [];

    /**
     * Subject
     *
     * @var string
     */
    #[Accessor(getter: "getSubject", setter: "setSubject")]
    #[SerializedName("su")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private ?string $subject = null;

    /**
     * Message ID header
     *
     * @var string
     */
    #[Accessor(getter: "getMessageIdHeader", setter: "setMessageIdHeader")]
    #[SerializedName("mid")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private ?string $messageIdHeader = null;

    /**
     * Invite
     *
     * @var MPInviteInfo
     */
    #[Accessor(getter: "getInvite", setter: "setInvite")]
    #[SerializedName("inv")]
    #[Type(MPInviteInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?MPInviteInfo $invite;

    /**
     * Headers
     *
     * @var array
     */
    #[Accessor(getter: "getHeaders", setter: "setHeaders")]
    #[Type("array<Zimbra\Common\Struct\KeyValuePair>")]
    #[XmlList(inline: true, entry: "header", namespace: "urn:zimbraMail")]
    private array $headers = [];

    /**
     * Mime part content elements
     *
     * @var array
     */
    #[Accessor(getter: "getMpContentElems", setter: "setMpContentElems")]
    #[Type("array<Zimbra\Mail\Struct\PartInfo>")]
    #[XmlList(inline: true, entry: "mp", namespace: "urn:zimbraMail")]
    private array $mpContentElems = [];

    /**
     * Share notifications
     *
     * @var array
     */
    #[Accessor(getter: "getShareContentElems", setter: "setShareContentElems")]
    #[Type("array<Zimbra\Mail\Struct\ShareNotification>")]
    #[XmlList(inline: true, entry: "shr", namespace: "urn:zimbraMail")]
    private array $shrContentElems = [];

    /**
     * Distribution list subscription notifications
     *
     * @var array
     */
    #[
        Accessor(
            getter: "getDlSubsContentElems",
            setter: "setDlSubsContentElems"
        )
    ]
    #[Type("array<Zimbra\Mail\Struct\DLSubscriptionNotification>")]
    #[XmlList(inline: true, entry: "dlSubs", namespace: "urn:zimbraMail")]
    private array $dlSubsContentElems = [];

    /**
     * Constructor
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
        ?string $id = null,
        ?string $part = null,
        ?int $sentDate = null,
        array $emails = [],
        ?string $subject = null,
        ?string $messageIdHeader = null,
        ?MPInviteInfo $invite = null,
        array $headers = [],
        array $contentElems = []
    ) {
        $this->setEmails($emails)
            ->setHeaders($headers)
            ->setContentElems($contentElems);
        $this->invite = $invite;
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $part) {
            $this->setPart($part);
        }
        if (null !== $sentDate) {
            $this->setSentDate($sentDate);
        }
        if (null !== $subject) {
            $this->setSubject($subject);
        }
        if (null !== $messageIdHeader) {
            $this->setMessageIdHeader($messageIdHeader);
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
     * Get invite
     *
     * @return MPInviteInfo
     */
    public function getInvite(): ?MPInviteInfo
    {
        return $this->invite;
    }

    /**
     * Set invite
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
     * Set contentElems
     *
     * @param  array $contentElems
     * @return self
     */
    public function setContentElems(array $contentElems): self
    {
        return $this->setMpContentElems($contentElems)
            ->setShareContentElems($contentElems)
            ->setDlSubsContentElems($contentElems);
    }

    /**
     * Get contentElems
     *
     * @return array
     */
    public function getContentElems(): array
    {
        return array_merge(
            $this->mpContentElems,
            $this->shrContentElems,
            $this->dlSubsContentElems
        );
    }

    /**
     * Set mpContentElems
     *
     * @param  array $elements
     * @return self
     */
    public function setMpContentElems(array $elements): self
    {
        $this->mpContentElems = array_values(
            array_filter(
                $elements,
                static fn($element) => $element instanceof PartInfo
            )
        );
        return $this;
    }

    /**
     * Get mpContentElems
     *
     * @return array
     */
    public function getMpContentElems(): array
    {
        return $this->mpContentElems;
    }

    /**
     * Set shrContentElems
     *
     * @param  array $elements
     * @return self
     */
    public function setShareContentElems(array $elements): self
    {
        $this->shrContentElems = array_values(
            array_filter(
                $elements,
                static fn($element) => $element instanceof ShareNotification
            )
        );
        return $this;
    }

    /**
     * Get shrContentElems
     *
     * @return array
     */
    public function getShareContentElems(): array
    {
        return $this->shrContentElems;
    }

    /**
     * Set dlSubsContentElems
     *
     * @param  array $elements
     * @return self
     */
    public function setDlSubsContentElems(array $elements): self
    {
        $this->dlSubsContentElems = array_values(
            array_filter(
                $elements,
                static fn($element) => $element instanceof
                    DLSubscriptionNotification
            )
        );
        return $this;
    }

    /**
     * Get dlSubsContentElems
     *
     * @return array
     */
    public function getDlSubsContentElems(): array
    {
        return $this->dlSubsContentElems;
    }
}
