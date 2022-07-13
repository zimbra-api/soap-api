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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Text;

/**
 * SaveDraftMsg class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SaveDraftMsg extends Msg
{
    /**
     * Existing draft ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $id;

    /**
     * Account ID the draft is for
     * 
     * @Accessor(getter="getDraftAccountId", setter="setDraftAccountId")
     * @SerializedName("forAcct")
     * @Type("string")
     * @XmlAttribute
     */
    private $draftAccountId;

    /**
     * Tags - Comma separated list of integers.  DEPRECATED - use "tn" instead
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $tags;

    /**
     * Comma separated list of tag names
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     */
    private $tagNames;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     * @Accessor(getter="getRgb", setter="setRgb")
     * @SerializedName("rgb")
     * @Type("string")
     * @XmlAttribute
     */
    private $rgb;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @Accessor(getter="getColor", setter="setColor")
     * @SerializedName("color")
     * @Type("integer")
     * @XmlAttribute
     */
    private $color;

    /**
     * Auto send time in milliseconds since the epoch
     * 
     * @Accessor(getter="getAutoSendTime", setter="setAutoSendTime")
     * @SerializedName("autoSendTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $autoSendTime;

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
        ?string $fragment = NULL,
        ?int $id = NULL,
        ?string $draftAccountId = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?string $rgb = NULL,
        ?int $color = NULL,
        ?int $autoSendTime = NULL
    )
    {
        parent::__construct(
            $attachmentId,
            $origId,
            $replyType,
            $identityId,
            $subject,
            $headers,
            $inReplyTo,
            $folderId,
            $flags,
            $content,
            $mimePart,
            $attachments,
            $invite,
            $emailAddresses,
            $timezones,
            $fragment
        );
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $draftAccountId) {
            $this->setDraftAccountId($draftAccountId);
        }
        if (NULL !== $tags) {
            $this->setTags($tags);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (NULL !== $rgb) {
            $this->setRgb($rgb);
        }
        if (NULL !== $color) {
            $this->setColor($color);
        }
        if (NULL !== $autoSendTime) {
            $this->setAutoSendTime($autoSendTime);
        }
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
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
     * Gets tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Sets tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Gets tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Sets tagNames
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames(string $tagNames): self
    {
        $this->tagNames = $tagNames;
        return $this;
    }

    /**
     * Gets color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Sets color
     *
     * @param  int $color
     * @return self
     */
    public function setColor(int $color): self
    {
        $this->color = in_array($color, range(0, 127)) ? $color : 0;
        return $this;
    }

    /**
     * Gets rgb
     *
     * @return string
     */
    public function getRgb(): ?string
    {
        return $this->rgb;
    }

    /**
     * Sets rgb
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb(string $rgb): self
    {
        if (Text::isRgb($rgb)) {
            $this->rgb = $rgb;
        }
        return $this;
    }

    /**
     * Gets autoSendTime
     *
     * @return int
     */
    public function getAutoSendTime(): ?int
    {
        return $this->autoSendTime;
    }

    /**
     * Sets autoSendTime
     *
     * @param  int $autoSendTime
     * @return self
     */
    public function setAutoSendTime(int $autoSendTime): self
    {
        $this->autoSendTime = $autoSendTime;
        return $this;
    }
}
