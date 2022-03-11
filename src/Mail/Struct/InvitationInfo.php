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

/**
 * InvitationInfo class
 * Invitation Information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class InvitationInfo extends InviteComponent
{
    /**
     * ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Content-Type
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentType;

    /**
     * Content-Id
     * @Accessor(getter="getContentId", setter="setContentId")
     * @SerializedName("ci")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentId;

    /**
     * RAW RFC822 MESSAGE (XML-encoded) MUST CONTAIN A text/calendar PART
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("Zimbra\Mail\Struct\RawInvite")
     * @XmlElement
     */
    private $content;

    /**
     * Invite component
     * @Accessor(getter="getInviteComponent", setter="setInviteComponent")
     * @SerializedName("comp")
     * @Type("Zimbra\Mail\Struct\InviteComponent")
     * @XmlElement
     */
    private $inviteComponent;

    /**
     * Timezones
     * @Accessor(getter="getTimezones", setter="setTimezones")
     * @SerializedName("tz")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline = true, entry = "tz")
     */
    private $timezones = [];

    /**
     * Meeting notes parts
     * @Accessor(getter="getMimeParts", setter="setMimeParts")
     * @SerializedName("mp")
     * @Type("array<Zimbra\Mail\Struct\MimePartInfo>")
     * @XmlList(inline = true, entry = "mp")
     */
    private $mimeParts = [];

    /**
     * Attachments
     * @Accessor(getter="getAttachments", setter="setAttachments")
     * @SerializedName("attach")
     * @Type("Zimbra\Mail\Struct\AttachmentsInfo")
     * @XmlElement
     */
    private $attachments;

    /**
     * Constructor method
     *
     * @param string $method
     * @param int $componentNum
     * @param bool $rsvp
     * @return self
     */
    public function __construct(
        ?string $method = NULL,
        ?int $componentNum = NULL,
        ?bool $rsvp = NULL
    )
    {
        parent::__construct($method, $componentNum, $rsvp);
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
     * Gets contentType
     *
     * @return string
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * Sets contentType
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
     * Gets contentId
     *
     * @return string
     */
    public function getContentId(): ?string
    {
        return $this->contentId;
    }

    /**
     * Sets contentId
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
     * Gets content
     *
     * @return RawInvite
     */
    public function getContent(): ?RawInvite
    {
        return $this->content;
    }

    /**
     * Sets content
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
     * Gets inviteComponent
     *
     * @return InviteComponent
     */
    public function getInviteComponent(): ?InviteComponent
    {
        return $this->inviteComponent;
    }

    /**
     * Sets inviteComponent
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
     * Sets mimeParts
     *
     * @param  array $mimeParts
     * @return self
     */
    public function setMimeParts(array $mimeParts): self
    {
        $this->mimeParts = [];
        foreach ($mimeParts as $mimePart) {
            if ($mimePart instanceof MimePartInfo) {
                $this->mimeParts[] = $mimePart;
            }
        }
        return $this;
    }

    /**
     * Gets mimeParts
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
}
