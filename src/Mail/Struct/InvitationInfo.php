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

/**
 * InvitationInfo class
 * Invitation Information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InvitationInfo extends InviteComponent
{
    /**
     * ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Content-Type
     *
     * @var string
     */
    #[Accessor(getter: "getContentType", setter: "setContentType")]
    #[SerializedName("ct")]
    #[Type("string")]
    #[XmlAttribute]
    private $contentType;

    /**
     * Content-Id
     *
     * @var string
     */
    #[Accessor(getter: "getContentId", setter: "setContentId")]
    #[SerializedName("ci")]
    #[Type("string")]
    #[XmlAttribute]
    private $contentId;

    /**
     * RAW RFC822 MESSAGE (XML-encoded) MUST CONTAIN A text/calendar PART
     *
     * @var RawInvite
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[SerializedName("content")]
    #[Type(RawInvite::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?RawInvite $content;

    /**
     * Invite component
     *
     * @var InviteComponent
     */
    #[Accessor(getter: "getInviteComponent", setter: "setInviteComponent")]
    #[SerializedName("comp")]
    #[Type(InviteComponent::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?InviteComponent $inviteComponent;

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
     * Meeting notes parts
     *
     * @var array
     */
    #[Accessor(getter: "getMimeParts", setter: "setMimeParts")]
    #[Type("array<Zimbra\Mail\Struct\MimePartInfo>")]
    #[XmlList(inline: true, entry: "mp", namespace: "urn:zimbraMail")]
    private $mimeParts = [];

    /**
     * Attachments
     *
     * @var AttachmentsInfo
     */
    #[Accessor(getter: "getAttachments", setter: "setAttachments")]
    #[SerializedName("attach")]
    #[Type(AttachmentsInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?AttachmentsInfo $attachments;

    /**
     * Constructor
     *
     * @param string $method
     * @param int $componentNum
     * @param bool $rsvp
     * @param RawInvite $content
     * @param InviteComponent $inviteComponent
     * @param AttachmentsInfo $attachments
     * @return self
     */
    public function __construct(
        ?string $method = null,
        ?int $componentNum = null,
        ?bool $rsvp = null,
        ?RawInvite $content = null,
        ?InviteComponent $inviteComponent = null,
        ?AttachmentsInfo $attachments = null
    ) {
        parent::__construct($method, $componentNum, $rsvp);
        $this->content = $content;
        $this->inviteComponent = $inviteComponent;
        $this->attachments = $attachments;
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
     * Get contentType
     *
     * @return string
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * Set contentType
     *
     * @param  string $contentType
     * @return self
     */
    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * Get contentId
     *
     * @return string
     */
    public function getContentId(): ?string
    {
        return $this->contentId;
    }

    /**
     * Set contentId
     *
     * @param  string $contentId
     * @return self
     */
    public function setContentId(string $contentId): self
    {
        $this->contentId = $contentId;
        return $this;
    }

    /**
     * Get content
     *
     * @return RawInvite
     */
    public function getContent(): ?RawInvite
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  RawInvite $content
     * @return self
     */
    public function setContent(RawInvite $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get inviteComponent
     *
     * @return InviteComponent
     */
    public function getInviteComponent(): ?InviteComponent
    {
        return $this->inviteComponent;
    }

    /**
     * Set inviteComponent
     *
     * @param  InviteComponent $inviteComponent
     * @return self
     */
    public function setInviteComponent(InviteComponent $inviteComponent): self
    {
        $this->inviteComponent = $inviteComponent;
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
     * Set mimeParts
     *
     * @param  array $mimeParts
     * @return self
     */
    public function setMimeParts(array $mimeParts): self
    {
        $this->mimeParts = array_filter(
            $mimeParts,
            static fn($mimePart) => $mimePart instanceof MimePartInfo
        );
        return $this;
    }

    /**
     * Get mimeParts
     *
     * @return array
     */
    public function getMimeParts(): array
    {
        return $this->mimeParts;
    }

    /**
     * Add mimePart
     *
     * @param  MimePartInfo $mimePart
     * @return self
     */
    public function addMimePart(MimePartInfo $mimePart): self
    {
        $this->mimeParts[] = $mimePart;
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
}
