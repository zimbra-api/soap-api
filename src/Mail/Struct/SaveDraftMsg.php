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

/**
 * SaveDraftMsg class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SaveDraftMsg extends Msg
{
    /**
     * Existing draft ID
     *
     * @var int
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("int")]
    #[XmlAttribute]
    private $id;

    /**
     * Account ID the draft is for
     *
     * @var string
     */
    #[Accessor(getter: "getDraftAccountId", setter: "setDraftAccountId")]
    #[SerializedName("forAcct")]
    #[Type("string")]
    #[XmlAttribute]
    private $draftAccountId;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     *
     * @var string
     */
    #[Accessor(getter: "getTags", setter: "setTags")]
    #[SerializedName("t")]
    #[Type("string")]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma separated list of tag names
     *
     * @var string
     */
    #[Accessor(getter: "getTagNames", setter: "setTagNames")]
    #[SerializedName("tn")]
    #[Type("string")]
    #[XmlAttribute]
    private $tagNames;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     *
     * @var string
     */
    #[Accessor(getter: "getRgb", setter: "setRgb")]
    #[SerializedName("rgb")]
    #[Type("string")]
    #[XmlAttribute]
    private $rgb;

    /**
     * Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     *
     * @var int
     */
    #[Accessor(getter: "getColor", setter: "setColor")]
    #[SerializedName("color")]
    #[Type("int")]
    #[XmlAttribute]
    private $color;

    /**
     * Auto send time in milliseconds since the epoch
     *
     * @var int
     */
    #[Accessor(getter: "getAutoSendTime", setter: "setAutoSendTime")]
    #[SerializedName("autoSendTime")]
    #[Type("int")]
    #[XmlAttribute]
    private $autoSendTime;

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
        ?string $fragment = null,
        ?int $id = null,
        ?string $draftAccountId = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?string $rgb = null,
        ?int $color = null,
        ?int $autoSendTime = null
    ) {
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
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $draftAccountId) {
            $this->setDraftAccountId($draftAccountId);
        }
        if (null !== $tags) {
            $this->setTags($tags);
        }
        if (null !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (null !== $rgb) {
            $this->setRgb($rgb);
        }
        if (null !== $color) {
            $this->setColor($color);
        }
        if (null !== $autoSendTime) {
            $this->setAutoSendTime($autoSendTime);
        }
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Set tags
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
     * Get tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Set tagNames
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
     * Get color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Set color
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
     * Get rgb
     *
     * @return string
     */
    public function getRgb(): ?string
    {
        return $this->rgb;
    }

    /**
     * Set rgb
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb(string $rgb): self
    {
        $this->rgb = $rgb;
        return $this;
    }

    /**
     * Get autoSendTime
     *
     * @return int
     */
    public function getAutoSendTime(): ?int
    {
        return $this->autoSendTime;
    }

    /**
     * Set autoSendTime
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
