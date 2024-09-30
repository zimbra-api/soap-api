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
     *
     * @var string
     */
    #[Accessor(getter: "getSortField", setter: "setSortField")]
    #[SerializedName("sf")]
    #[Type("string")]
    #[XmlAttribute]
    private $sortField;

    /**
     * Hits
     *
     * @Accessor(getter="getMessageHits", setter="setMessageHits")
     * @Type("array<Zimbra\Mail\Struct\ConversationMsgHitInfo>")
     * @XmlList(inline=true, entry="m", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getMessageHits", setter: "setMessageHits")]
    #[Type("array<Zimbra\Mail\Struct\ConversationMsgHitInfo>")]
    #[XmlList(inline: true, entry: "m", namespace: "urn:zimbraMail")]
    private $messageHits = [];

    /**
     * Constructor
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
        ?string $id = null,
        ?string $sortField = null,
        array $messageHits = [],
        ?int $num = null,
        ?int $numUnread = null,
        ?int $totalSize = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?int $date = null,
        ?bool $elided = null,
        ?int $changeDate = null,
        ?int $modifiedSequence = null,
        array $metadatas = [],
        ?string $subject = null,
        ?string $fragment = null,
        array $emails = []
    ) {
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
        if (null !== $sortField) {
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
        $this->messageHits = array_filter(
            $hits,
            static fn($hit) => $hit instanceof ConversationMsgHitInfo
        );
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
}
