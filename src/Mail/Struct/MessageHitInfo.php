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
    XmlList
};
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Struct\SearchHit;

/**
 * MessageHitInfo struct class
 * Message search result information containing a list of messages
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MessageHitInfo extends MessageInfo implements SearchHit
{
    /**
     * Sort field value
     *
     * @Accessor(getter="getSortField", setter="setSortField")
     * @SerializedName("sf")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSortField", setter: "setSortField")]
    #[SerializedName("sf")]
    #[Type("string")]
    #[XmlAttribute]
    private $sortField;

    /**
     * If the message matched the specified query string
     *
     * @Accessor(getter="getContentMatched", setter="setContentMatched")
     * @SerializedName("cm")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getContentMatched", setter: "setContentMatched")]
    #[SerializedName("cm")]
    #[Type("bool")]
    #[XmlAttribute]
    private $contentMatched;

    /**
     * Hit Parts -- indicators that the named parts matched the search string
     *
     * @Accessor(getter="getMessagePartHits", setter="setMessagePartHits")
     * @Type("array<Zimbra\Mail\Struct\Part>")
     * @XmlList(inline=true, entry="hp", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getMessagePartHits", setter: "setMessagePartHits")]
    #[Type("array<Zimbra\Mail\Struct\Part>")]
    #[XmlList(inline: true, entry: "hp", namespace: "urn:zimbraMail")]
    private $messagePartHits = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $sortField
     * @param  bool $contentMatched
     * @param  array $messagePartHits
     * @param  int $imapUid
     * @param  string $calendarIntendedFor
     * @param  string $origId
     * @param  ReplyType $draftReplyType
     * @param  string $identityId
     * @param  string $draftAccountId
     * @param  int $draftAutoSendTime
     * @param  int $sentDate
     * @param  int $resentDate
     * @param  string $part
     * @param  string $fragment
     * @param  array $emails
     * @param  string $subject
     * @param  string $messageIdHeader
     * @param  string $inReplyTo
     * @param  InviteInfo $invite
     * @param  array $headers
     * @param  array $partInfos
     * @param  array $shareNotifications
     * @param  array $dlSubs
     * @param  int $size
     * @param  int $date
     * @param  string $folder
     * @param  string $conversationId
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  int $revision
     * @param  int $changeDate
     * @param  int $modifiedSequence
     * @param  array $metadatas
     * @return self
     */
    public function __construct(
        ?string $id = null,
        ?string $sortField = null,
        ?bool $contentMatched = null,
        array $messagePartHits = [],
        ?int $imapUid = null,
        ?string $calendarIntendedFor = null,
        ?string $origId = null,
        ?ReplyType $draftReplyType = null,
        ?string $identityId = null,
        ?string $draftAccountId = null,
        ?int $draftAutoSendTime = null,
        ?int $sentDate = null,
        ?int $resentDate = null,
        ?string $part = null,
        ?string $fragment = null,
        array $emails = [],
        ?string $subject = null,
        ?string $messageIdHeader = null,
        ?string $inReplyTo = null,
        ?InviteInfo $invite = null,
        array $headers = [],
        array $partInfos = [],
        array $shareNotifications = [],
        array $dlSubs = [],
        ?int $size = null,
        ?int $date = null,
        ?string $folder = null,
        ?string $conversationId = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?int $revision = null,
        ?int $changeDate = null,
        ?int $modifiedSequence = null,
        array $metadatas = []
    ) {
        parent::__construct(
            $id,
            $imapUid,
            $calendarIntendedFor,
            $origId,
            $draftReplyType,
            $identityId,
            $draftAccountId,
            $draftAutoSendTime,
            $sentDate,
            $resentDate,
            $part,
            $fragment,
            $emails,
            $subject,
            $messageIdHeader,
            $inReplyTo,
            $invite,
            $headers,
            $partInfos,
            $shareNotifications,
            $dlSubs,
            $size,
            $date,
            $folder,
            $conversationId,
            $flags,
            $tags,
            $tagNames,
            $revision,
            $changeDate,
            $modifiedSequence,
            $metadatas
        );
        $this->setMessagePartHits($messagePartHits);
        if (null !== $sortField) {
            $this->setSortField($sortField);
        }
        if (null !== $contentMatched) {
            $this->setContentMatched($contentMatched);
        }
    }

    public function setId(string $id): self
    {
        parent::setId($id);
        return $this;
    }

    /**
     * Get sortField
     *
     * @return string
     */
    public function getSortField(): ?string
    {
        return $this->sortField;
    }

    /**
     * Set sortField
     *
     * @param  string $sortField
     * @return self
     */
    public function setSortField(string $sortField): self
    {
        $this->sortField = $sortField;
        return $this;
    }

    /**
     * Get contentMatched
     *
     * @return bool
     */
    public function getContentMatched(): ?bool
    {
        return $this->contentMatched;
    }

    /**
     * Set contentMatched
     *
     * @param  bool $contentMatched
     * @return self
     */
    public function setContentMatched(bool $contentMatched): self
    {
        $this->contentMatched = $contentMatched;
        return $this;
    }

    /**
     * Set messagePartHits
     *
     * @param  array $hits
     * @return self
     */
    public function setMessagePartHits(array $hits): self
    {
        $this->messagePartHits = array_filter(
            $hits,
            static fn($hit) => $hit instanceof Part
        );
        return $this;
    }

    /**
     * Get messagePartHits
     *
     * @return array
     */
    public function getMessagePartHits(): array
    {
        return $this->messagePartHits;
    }
}
