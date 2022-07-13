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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
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
     */
    private $sortField;

    /**
     * If the message matched the specified query string
     * 
     * @Accessor(getter="getContentMatched", setter="setContentMatched")
     * @SerializedName("cm")
     * @Type("bool")
     * @XmlAttribute
     */
    private $contentMatched;

    /**
     * Hit Parts -- indicators that the named parts matched the search string
     * 
     * @Accessor(getter="getMessagePartHits", setter="setMessagePartHits")
     * @Type("array<Zimbra\Mail\Struct\Part>")
     * @XmlList(inline=true, entry="hp", namespace="urn:zimbraMail")
     */
    private $messagePartHits = [];

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $sortField = NULL,
        ?bool $contentMatched = NULL,
        array $messagePartHits = [],
        ?int $imapUid = NULL,
        ?string $calendarIntendedFor = NULL,
        ?string $origId = NULL,
        ?ReplyType $draftReplyType = NULL,
        ?string $identityId = NULL,
        ?string $draftAccountId = NULL,
        ?int $draftAutoSendTime = NULL,
        ?int $sentDate = NULL,
        ?int $resentDate = NULL,
        ?string $part = NULL,
        ?string $fragment = NULL,
        array $emails = [],
        ?string $subject = NULL,
        ?string $messageIdHeader = NULL,
        ?string $inReplyTo = NULL,
        ?InviteInfo $invite = NULL,
        array $headers = [],
        array $partInfos = [],
        array $shareNotifications = [],
        array $dlSubs = [],
        ?int $size = NULL,
        ?int $date = NULL,
        ?string $folder = NULL,
        ?string $conversationId = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?int $revision = NULL,
        ?int $changeDate = NULL,
        ?int $modifiedSequence = NULL,
        array $metadatas = []
    )
    {
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
        if (NULL !== $sortField) {
            $this->setSortField($sortField);
        }
        if (NULL !== $contentMatched) {
            $this->setContentMatched($contentMatched);
        }
    }

    public function setId(string $id): self
    {
        parent::setId($id);
        return $this;
    }

    /**
     * Gets sortField
     *
     * @return string
     */
    public function getSortField(): ?string
    {
        return $this->sortField;
    }

    /**
     * Sets sortField
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
     * Gets contentMatched
     *
     * @return bool
     */
    public function getContentMatched(): ?bool
    {
        return $this->contentMatched;
    }

    /**
     * Sets contentMatched
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
     * Sets messagePartHits
     *
     * @param  array $hits
     * @return self
     */
    public function setMessagePartHits(array $hits): self
    {
        $this->messagePartHits = array_filter($hits, static fn($hit) => $hit instanceof Part);
        return $this;
    }

    /**
     * Gets messagePartHits
     *
     * @return array
     */
    public function getMessagePartHits(): array
    {
        return $this->messagePartHits;
    }

    /**
     * Add part
     *
     * @param  Part $hp
     * @return self
     */
    public function addMessagePartHit(Part $hp): self
    {
        $this->messagePartHits[] = $hp;
        return $this;
    }
}
