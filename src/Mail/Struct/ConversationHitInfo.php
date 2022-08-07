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
use Zimbra\Common\Struct\SearchHit;

/**
 * MessageHitInfo struct class
 * Conversation search result information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConversationHitInfo extends ConversationSummary implements SearchHit
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
     * Hits
     * 
     * @Accessor(getter="getMessageHits", setter="setMessageHits")
     * @Type("array<Zimbra\Mail\Struct\ConversationMsgHitInfo>")
     * @XmlList(inline=true, entry="m", namespace="urn:zimbraMail")
     */
    private $messageHits = [];

    /**
     * Constructor method
     *
     * @param  string $id
     * @param  string $sortField
     * @param  array $messageHits
     * @param  int $num
     * @param  int $numUnread
     * @param  int $totalSize
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  int $date
     * @param  bool $elided
     * @param  int $changeDate
     * @param  int $modifiedSequence
     * @param  array $metadatas
     * @param  string $subject
     * @param  string $fragment
     * @param  array $emails
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $sortField = NULL,
        array $messageHits = [],
        ?int $num = NULL,
        ?int $numUnread = NULL,
        ?int $totalSize = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?int $date = NULL,
        ?bool $elided = NULL,
        ?int $changeDate = NULL,
        ?int $modifiedSequence = NULL,
        array $metadatas = [],
        ?string $subject = NULL,
        ?string $fragment = NULL,
        array $emails = []
    )
    {
        parent::__construct(
            $id,
            $num,
            $numUnread,
            $totalSize,
            $flags,
            $tags,
            $tagNames,
            $date,
            $elided,
            $changeDate,
            $modifiedSequence,
            $metadatas,
            $subject,
            $fragment,
            $emails
        );
        $this->setMessageHits($messageHits);
        if (NULL !== $sortField) {
            $this->setSortField($sortField);
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
     * Set messageHits
     *
     * @param  array $hits
     * @return self
     */
    public function setMessageHits(array $hits): self
    {
        $this->messageHits = array_filter($hits, static fn($hit) => $hit instanceof ConversationMsgHitInfo);
        return $this;
    }

    /**
     * Get messageHits
     *
     * @return array
     */
    public function getMessageHits(): array
    {
        return $this->messageHits;
    }

    /**
     * Add message hit
     *
     * @param  ConversationMsgHitInfo $hit
     * @return self
     */
    public function addMessageHit(ConversationMsgHitInfo $hit): self
    {
        $this->messageHits[] = $hit;
        return $this;
    }
}
