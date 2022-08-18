<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

use Zimbra\Common\Enum\SearchSortBy;
use Zimbra\Common\Struct\SimpleSearchHit;
use Zimbra\Mail\Struct\{
    ConversationHitInfo,
    MessageHitInfo,
    ChatHitInfo,
    MessagePartHitInfo,
    ContactInfo,
    NoteHitInfo,
    DocumentHitInfo,
    WikiHitInfo,
    AppointmentHitInfo,
    TaskHitInfo,
    SearchQueryInfo
};
use Zimbra\Common\Struct\SoapResponse;

/**
 * SearchResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchResponse extends SoapResponse
{
    /**
     * What to sort by.  Default is "dateDesc"
     * Possible values:
     * none|dateAsc|dateDesc|subjAsc|subjDesc|nameAsc|nameDesc|rcptAsc|rcptDesc|attachAsc|attachDesc|
     * flagAsc|flagDesc|priorityAsc|priorityDesc|idAsc|idDesc|readAsc|readDesc
     * If sort-by is "none" then queryInfos MUST NOT be used, and some searches are impossible (searches that require
     * intersection of complex sub-ops). Server will throw an IllegalArgumentException if the search is invalid.
     * ADDITIONAL SORT MODES FOR TASKS: valid only if types="task" (and task alone):
     * taskDueAsc|taskDueDesc|taskStatusAsc|taskStatusDesc|taskPercCompletedAsc|taskPercCompletedDesc
     * 
     * @var SearchSortBy
     */
    #[Accessor(getter: 'getSortBy', setter: 'setSortBy')]
    #[SerializedName('sortBy')]
    #[Type('Enum<Zimbra\Common\Enum\SearchSortBy>')]
    #[XmlAttribute]
    private $sortBy;

    /**
     * Offset - an int specifying the 0-based offset into the results list returned as
     * the first result for this search operation.
     * 
     * @var int
     */
    #[Accessor(getter: 'getQueryOffset', setter: 'setQueryOffset')]
    #[SerializedName('offset')]
    #[Type('int')]
    #[XmlAttribute]
    private $queryOffset;

    /**
     * Set if there are more search results remaining.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getQueryMore', setter: 'setQueryMore')]
    #[SerializedName('more')]
    #[Type('bool')]
    #[XmlAttribute]
    private $queryMore;

    /**
     * All messages
     * 
     * @var int
     */
    #[Accessor(getter: 'getTotalSize', setter: 'setTotalSize')]
    #[SerializedName('total')]
    #[Type('int')]
    #[XmlAttribute]
    private $totalSize;

    /**
     * Simple search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getSimpleHits', setter: 'setSimpleHits')]
    #[Type('array<Zimbra\Common\Struct\SimpleSearchHit>')]
    #[XmlList(inline: true, entry: 'hit', namespace: 'urn:zimbraMail')]
    private $simpleHits = [];

    /**
     * Conversation search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getConversationHits', setter: 'setConversationHits')]
    #[Type('array<Zimbra\Mail\Struct\ConversationHitInfo>')]
    #[XmlList(inline: true, entry: 'c', namespace: 'urn:zimbraMail')]
    private $conversationHits = [];

    /**
     * Message search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getMessageHits', setter: 'setMessageHits')]
    #[Type('array<Zimbra\Mail\Struct\MessageHitInfo>')]
    #[XmlList(inline: true, entry: 'm', namespace: 'urn:zimbraMail')]
    private $messageHits = [];

    /**
     * Chat search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getChatHits', setter: 'setChatHits')]
    #[Type('array<Zimbra\Mail\Struct\ChatHitInfo>')]
    #[XmlList(inline: true, entry: 'chat', namespace: 'urn:zimbraMail')]
    private $chatHits = [];

    /**
     * Message part search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getMessagePartHits', setter: 'setMessagePartHits')]
    #[Type('array<Zimbra\Mail\Struct\MessagePartHitInfo>')]
    #[XmlList(inline: true, entry: 'mp', namespace: 'urn:zimbraMail')]
    private $messagePartHits = [];

    /**
     * Contact search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getContactHits', setter: 'setContactHits')]
    #[Type('array<Zimbra\Mail\Struct\ContactInfo>')]
    #[XmlList(inline: true, entry: 'cn', namespace: 'urn:zimbraMail')]
    private $contactHits = [];

    /**
     * Note search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getNoteHits', setter: 'setNoteHits')]
    #[Type('array<Zimbra\Mail\Struct\NoteHitInfo>')]
    #[XmlList(inline: true, entry: 'note', namespace: 'urn:zimbraMail')]
    private $noteHits = [];

    /**
     * Document search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getDocumentHits', setter: 'setDocumentHits')]
    #[Type('array<Zimbra\Mail\Struct\DocumentHitInfo>')]
    #[XmlList(inline: true, entry: 'doc', namespace: 'urn:zimbraMail')]
    private $documentHits = [];

    /**
     * Document search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getWikiHits', setter: 'setWikiHits')]
    #[Type('array<Zimbra\Mail\Struct\WikiHitInfo>')]
    #[XmlList(inline: true, entry: 'w', namespace: 'urn:zimbraMail')]
    private $wikiHits = [];

    /**
     * Appointment search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getAppointmentHits', setter: 'setAppointmentHits')]
    #[Type('array<Zimbra\Mail\Struct\AppointmentHitInfo>')]
    #[XmlList(inline: true, entry: 'appt', namespace: 'urn:zimbraMail')]
    private $appointmentHits = [];

    /**
     * Task search hits
     * 
     * @var array
     */
    #[Accessor(getter: 'getTaskHits', setter: 'setTaskHits')]
    #[Type('array<Zimbra\Mail\Struct\TaskHitInfo>')]
    #[XmlList(inline: true, entry: 'task', namespace: 'urn:zimbraMail')]
    private $taskHits = [];

    /**
     * Used to return general status information about your search.
     * The <wildcard> element tells you about the status of wildcard expansions within your search.
     * If expanded is set, then the wildcard was expanded and the matches are included in the search.  If expanded is
     * unset then the wildcard was not specific enough and therefore no wildcard matches are included
     * (exact-match is included in results).
     * 
     * @var SearchQueryInfo
     */
    #[Accessor(getter: "getQueryInfo", setter: "setQueryInfo")]
    #[SerializedName('info')]
    #[Type(SearchQueryInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $queryInfo;

    /**
     * Constructor
     *
     * @param  SearchSortBy $sortBy
     * @param  int $queryOffset
     * @param  bool $queryMore
     * @param  int $totalSize
     * @param  array $simpleHits
     * @param  array $conversationHits
     * @param  array $messageHits
     * @param  array $chatHits
     * @param  array $messagePartHits
     * @param  array $contactHits
     * @param  array $noteHits
     * @param  array $documentHits
     * @param  array $wikiHits
     * @param  array $appointmentHits
     * @param  array $taskHits
     * @param  SearchQueryInfo $queryInfo
     * @return self
     */
    public function __construct(
        ?SearchSortBy $sortBy = NULL,
        ?int $queryOffset = NULL,
        ?bool $queryMore = NULL,
        ?int $totalSize = NULL,
        array $simpleHits = [],
        array $conversationHits = [],
        array $messageHits = [],
        array $chatHits = [],
        array $messagePartHits = [],
        array $contactHits = [],
        array $noteHits = [],
        array $documentHits = [],
        array $wikiHits = [],
        array $appointmentHits = [],
        array $taskHits = [],
        ?SearchQueryInfo $queryInfo = NULL
    )
    {
        $this->setSimpleHits($simpleHits)
             ->setConversationHits($conversationHits)
             ->setMessageHits($messageHits)
             ->setChatHits($chatHits)
             ->setMessagePartHits($messagePartHits)
             ->setContactHits($contactHits)
             ->setNoteHits($noteHits)
             ->setDocumentHits($documentHits)
             ->setWikiHits($wikiHits)
             ->setAppointmentHits($appointmentHits)
             ->setTaskHits($taskHits);
        if ($sortBy instanceof SearchSortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $queryOffset) {
            $this->setQueryOffset($queryOffset);
        }
        if (NULL !== $queryMore) {
            $this->setQueryMore($queryMore);
        }
        if (NULL !== $totalSize) {
            $this->setTotalSize($totalSize);
        }
        if ($queryInfo instanceof SearchQueryInfo) {
            $this->setQueryInfo($queryInfo);
        }
    }

    /**
     * Get sortBy
     *
     * @return SearchSortBy
     */
    public function getSortBy(): ?SearchSortBy
    {
        return $this->sortBy;
    }

    /**
     * Set sortBy
     *
     * @param  SearchSortBy $sortBy
     * @return self
     */
    public function setSortBy(SearchSortBy $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * Get queryOffset
     *
     * @return int
     */
    public function getQueryOffset(): ?int
    {
        return $this->queryOffset;
    }

    /**
     * Set queryOffset
     *
     * @param  int $queryOffset
     * @return self
     */
    public function setQueryOffset(int $queryOffset): self
    {
        $this->queryOffset = $queryOffset;
        return $this;
    }

    /**
     * Get queryMore
     *
     * @return bool
     */
    public function getQueryMore(): ?bool
    {
        return $this->queryMore;
    }

    /**
     * Set queryMore
     *
     * @param  bool $queryMore
     * @return self
     */
    public function setQueryMore(bool $queryMore): self
    {
        $this->queryMore = $queryMore;
        return $this;
    }

    /**
     * Get totalSize
     *
     * @return int
     */
    public function getTotalSize(): ?int
    {
        return $this->totalSize;
    }

    /**
     * Set totalSize
     *
     * @param  int $totalSize
     * @return self
     */
    public function setTotalSize(int $totalSize): self
    {
        $this->totalSize = $totalSize;
        return $this;
    }

    /**
     * Set simpleHits
     *
     * @param  array $hits
     * @return self
     */
    public function setSimpleHits(array $hits): self
    {
        $this->simpleHits = array_filter($hits, static fn($hit) => $hit instanceof SimpleSearchHit);
        return $this;
    }

    /**
     * Get simpleHits
     *
     * @return array
     */
    public function getSimpleHits(): array
    {
        return $this->simpleHits;
    }

    /**
     * Set conversationHits
     *
     * @param  array $hits
     * @return self
     */
    public function setConversationHits(array $hits): self
    {
        $this->conversationHits = array_filter($hits, static fn($hit) => $hit instanceof ConversationHitInfo);
        return $this;
    }

    /**
     * Get conversationHits
     *
     * @return array
     */
    public function getConversationHits(): array
    {
        return $this->conversationHits;
    }

    /**
     * Set messageHits
     *
     * @param  array $hits
     * @return self
     */
    public function setMessageHits(array $hits): self
    {
        $this->messageHits = array_filter($hits, static fn($hit) => $hit instanceof MessageHitInfo);
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
     * Set chatHits
     *
     * @param  array $hits
     * @return self
     */
    public function setChatHits(array $hits): self
    {
        $this->chatHits = array_filter($hits, static fn($hit) => $hit instanceof ChatHitInfo);
        return $this;
    }

    /**
     * Get chatHits
     *
     * @return array
     */
    public function getChatHits(): array
    {
        return $this->chatHits;
    }

    /**
     * Set messagePartHits
     *
     * @param  array $hits
     * @return self
     */
    public function setMessagePartHits(array $hits): self
    {
        $this->messagePartHits = array_filter($hits, static fn($hit) => $hit instanceof MessagePartHitInfo);
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

    /**
     * Set contactHits
     *
     * @param  array $hits
     * @return self
     */
    public function setContactHits(array $hits): self
    {
        $this->contactHits = array_filter($hits, static fn($hit) => $hit instanceof ContactInfo);
        return $this;
    }

    /**
     * Get contactHits
     *
     * @return array
     */
    public function getContactHits(): array
    {
        return $this->contactHits;
    }

    /**
     * Set noteHits
     *
     * @param  array $hits
     * @return self
     */
    public function setNoteHits(array $hits): self
    {
        $this->noteHits = array_filter($hits, static fn($hit) => $hit instanceof NoteHitInfo);
        return $this;
    }

    /**
     * Get noteHits
     *
     * @return array
     */
    public function getNoteHits(): array
    {
        return $this->noteHits;
    }

    /**
     * Set documentHits
     *
     * @param  array $hits
     * @return self
     */
    public function setDocumentHits(array $hits): self
    {
        $this->documentHits = array_filter($hits, static fn($hit) => $hit instanceof DocumentHitInfo);
        return $this;
    }

    /**
     * Get documentHits
     *
     * @return array
     */
    public function getDocumentHits(): array
    {
        return $this->documentHits;
    }

    /**
     * Set wikiHits
     *
     * @param  array $hits
     * @return self
     */
    public function setWikiHits(array $hits): self
    {
        $this->wikiHits = array_filter($hits, static fn($hit) => $hit instanceof WikiHitInfo);
        return $this;
    }

    /**
     * Get wikiHits
     *
     * @return array
     */
    public function getWikiHits(): array
    {
        return $this->wikiHits;
    }

    /**
     * Set appointmentHits
     *
     * @param  array $hits
     * @return self
     */
    public function setAppointmentHits(array $hits): self
    {
        $this->appointmentHits = array_filter($hits, static fn($hit) => $hit instanceof AppointmentHitInfo);
        return $this;
    }

    /**
     * Get appointmentHits
     *
     * @return array
     */
    public function getAppointmentHits(): array
    {
        return $this->appointmentHits;
    }

    /**
     * Set taskHits
     *
     * @param  array $hits
     * @return self
     */
    public function setTaskHits(array $hits): self
    {
        $this->taskHits = array_filter($hits, static fn($hit) => $hit instanceof TaskHitInfo);
        return $this;
    }

    /**
     * Get taskHits
     *
     * @return array
     */
    public function getTaskHits(): array
    {
        return $this->taskHits;
    }

    /**
     * Get the queryInfo
     *
     * @return SearchQueryInfo
     */
    public function getQueryInfo(): ?SearchQueryInfo
    {
        return $this->queryInfo;
    }

    /**
     * Set the queryInfo
     *
     * @param  SearchQueryInfo $queryInfo
     * @return self
     */
    public function setQueryInfo(SearchQueryInfo $queryInfo): self
    {
        $this->queryInfo = $queryInfo;
        return $this;
    }
}
