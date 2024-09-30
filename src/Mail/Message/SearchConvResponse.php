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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Mail\Struct\{
    NestedSearchConversation,
    MessageHitInfo,
    SearchQueryInfo
};
use Zimbra\Common\Enum\SearchSortBy;
use Zimbra\Common\Struct\SoapResponse;

/**
 * SearchConvResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchConvResponse extends SoapResponse
{
    /**
     * What to sort by. Default is "dateDesc"
     * Possible values:
     * none|dateAsc|dateDesc|subjAsc|subjDesc|nameAsc|nameDesc|rcptAsc|rcptDesc|attachAsc|attachDesc|
     * flagAsc|flagDesc|priorityAsc|priorityDesc|idAsc|idDesc|readAsc|readDesc
     * If sort-by is "none" then queryInfos MUST NOT be used, and some searches are impossible
     * (searches that require intersection of complex sub-ops).
     * Server will throw an IllegalArgumentException if the search is invalid.
     * ADDITIONAL SORT MODES FOR TASKS: valid only if types="task" (and task alone):
     * taskDueAsc|taskDueDesc|taskStatusAsc|taskStatusDesc|taskPercCompletedAsc|taskPercCompletedDesc
     *
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("Enum<Zimbra\Common\Enum\SearchSortBy>")
     * @XmlAttribute
     *
     * @var SearchSortBy
     */
    #[Accessor(getter: "getSortBy", setter: "setSortBy")]
    #[SerializedName("sortBy")]
    #[Type("Enum<Zimbra\Common\Enum\SearchSortBy>")]
    #[XmlAttribute]
    private ?SearchSortBy $sortBy;

    /**
     * Offset - an int specifying the 0-based offset into the results list returned as
     * the first result for this search operation.
     *
     * @Accessor(getter="getQueryOffset", setter="setQueryOffset")
     * @SerializedName("offset")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getQueryOffset", setter: "setQueryOffset")]
    #[SerializedName("offset")]
    #[Type("int")]
    #[XmlAttribute]
    private $queryOffset;

    /**
     * Set if there are more search results remaining.
     *
     * @Accessor(getter="getQueryMore", setter="setQueryMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getQueryMore", setter: "setQueryMore")]
    #[SerializedName("more")]
    #[Type("bool")]
    #[XmlAttribute]
    private $queryMore;

    /**
     * Nested Search Conversation (Only returned if request had "nest" attribute set)
     *
     * @Accessor(getter="getConversation", setter="setConversation")
     * @SerializedName("c")
     * @Type("Zimbra\Mail\Struct\NestedSearchConversation")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var NestedSearchConversation
     */
    #[Accessor(getter: "getConversation", setter: "setConversation")]
    #[SerializedName("c")]
    #[Type(NestedSearchConversation::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?NestedSearchConversation $conversation;

    /**
     * Message search hits
     *
     * @Accessor(getter="getMessages", setter="setMessages")
     * @Type("array<Zimbra\Mail\Struct\MessageHitInfo>")
     * @XmlList(inline=true, entry="m", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getMessages", setter: "setMessages")]
    #[Type("array<Zimbra\Mail\Struct\MessageHitInfo>")]
    #[XmlList(inline: true, entry: "m", namespace: "urn:zimbraMail")]
    private $messages = [];

    /**
     * Used to return general status information about your search.
     * The <wildcard> element tells you about the status of wildcard expansions within your search.
     * If expanded is set, then the wildcard was expanded and the matches are included in the search.
     * If expanded is unset then the wildcard was not specific enough and therefore no wildcard matches are included
     * (exact-match is included in results).
     *
     * @Accessor(getter="getQueryInfo", setter="setQueryInfo")
     * @SerializedName("info")
     * @Type("Zimbra\Mail\Struct\SearchQueryInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var SearchQueryInfo
     */
    #[Accessor(getter: "getQueryInfo", setter: "setQueryInfo")]
    #[SerializedName("info")]
    #[Type(SearchQueryInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?SearchQueryInfo $queryInfo;

    /**
     * Constructor
     *
     * @param  SearchSortBy $sortBy
     * @param  int $queryOffset
     * @param  bool $queryMore
     * @param  NestedSearchConversation $conversation
     * @param  array $messages
     * @param  SearchQueryInfo $queryInfo
     * @return self
     */
    public function __construct(
        ?SearchSortBy $sortBy = null,
        ?int $queryOffset = null,
        ?bool $queryMore = null,
        ?NestedSearchConversation $conversation = null,
        array $messages = [],
        ?SearchQueryInfo $queryInfo = null
    ) {
        $this->setMessages($messages);
        $this->sortBy = $sortBy;
        $this->conversation = $conversation;
        $this->queryInfo = $queryInfo;
        if (null !== $queryOffset) {
            $this->setQueryOffset($queryOffset);
        }
        if (null !== $queryMore) {
            $this->setQueryMore($queryMore);
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
     * Get the conversation
     *
     * @return NestedSearchConversation
     */
    public function getConversation(): ?NestedSearchConversation
    {
        return $this->conversation;
    }

    /**
     * Set the conversation
     *
     * @param  NestedSearchConversation $conversation
     * @return self
     */
    public function setConversation(
        NestedSearchConversation $conversation
    ): self {
        $this->conversation = $conversation;
        return $this;
    }

    /**
     * Set messages
     *
     * @param  array $messages
     * @return self
     */
    public function setMessages(array $messages): self
    {
        $this->messages = array_filter(
            $messages,
            static fn($message) => $message instanceof MessageHitInfo
        );
        return $this;
    }

    /**
     * Get messages
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
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
