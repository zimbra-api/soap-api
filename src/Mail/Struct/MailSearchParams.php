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
    Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList
};
use Zimbra\Common\Enum\{
    MsgContent, SearchSortBy, SearchType, TaskStatus, WantRecipsSetting
};
use Zimbra\Common\Struct\{AttributeName, CalTZInfoInterface, CursorInfo};

/**
 * MailSearchParams trait
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
trait MailSearchParams
{
    /**
     * Set to 1 (true) to include items with the Deleted calItemExpandStart set in results
     * 
     * @Accessor(getter="getIncludeTagDeleted", setter="setIncludeTagDeleted")
     * @SerializedName("includeTagDeleted")
     * @Type("bool")
     * @XmlAttribute
     */
    private $includeTagDeleted;

    /**
     * Set to 1 (true) to include items with the Muted calItemExpandStart set in results
     * 
     * @Accessor(getter="getIncludeTagMuted", setter="setIncludeTagMuted")
     * @SerializedName("includeTagMuted")
     * @Type("bool")
     * @XmlAttribute
     */
    private $includeTagMuted;

    /**
     * Comma separated list of allowable Task statuses.
     * Valid values : NEED, INPR, WAITING, DEFERRED, COMP
     * 
     * @Accessor(getter="getAllowableTaskStatus", setter="setAllowableTaskStatus")
     * @SerializedName("allowableTaskStatus")
     * @Type("string")
     * @XmlAttribute
     */
    private $allowableTaskStatus;

    /**
     * Start time in milliseconds for the range to include instances for calendar items from.
     * 
     * @Accessor(getter="getCalItemExpandStart", setter="setCalItemExpandStart")
     * @SerializedName("calExpandInstStart")
     * @Type("integer")
     * @XmlAttribute
     */
    private $calItemExpandStart;

    /**
     * End time in milliseconds for the range to include instances for calendar items from.
     * 
     * @Accessor(getter="getCalItemExpandEnd", setter="setCalItemExpandEnd")
     * @SerializedName("calExpandInstEnd")
     * @Type("integer")
     * @XmlAttribute
     */
    private $calItemExpandEnd;

    /**
     * Query string
     * 
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $query;

    /**
     * Set this flat to 1 (true) to search dumpster data instead of live data.
     * 
     * @Accessor(getter="getInDumpster", setter="setInDumpster")
     * @SerializedName("inDumpster")
     * @Type("bool")
     * @XmlAttribute
     */
    private $inDumpster;

    /**
     * Comma separated list of search types
     * Legal values are: conversation|message|contact|appointment|task|wiki|document
     * Default is "conversation".
     * 
     * @Accessor(getter="getSearchTypes", setter="setSearchTypes")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     */
    private $searchTypes;

    /**
     * Deprecated. Use {searchTypes} instead
     * 
     * @Accessor(getter="getGroupBy", setter="setGroupBy")
     * @SerializedName("groupBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $groupBy;

    /**
     * "Quick" flag.
     * For performance reasons, the index system accumulates messages with not-indexed-yet state until a certain
     * threshold and indexes them as a batch. To return up-to-date search results, the index system also indexes those
     * pending messages right before a search. To lower latencies, this option gives a hint to the index system not to
     * cursor this catch-up index prior to the search by giving up the freshness of the search results, i.e. recent
     * messages may not be included in the search results.
     * 
     * @Accessor(getter="getQuick", setter="setQuick")
     * @SerializedName("quick")
     * @Type("bool")
     * @XmlAttribute
     */
    private $quick;

    /**
     * SortBy setting.
     * Default value is "dateDesc"
     * Possible values:
     * none|dateAsc|dateDesc|subjAsc|subjDesc|nameAsc|nameDesc|rcptAsc|rcptDesc|calTzAsc|calTzDesc|flagAsc|flagDesc|priorityAsc|priorityDesc|idAsc|idDesc|readAsc|readDesc
     * 
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("Enum<Zimbra\Common\Enum\SearchSortBy>")
     * @XmlAttribute
     */
    private ?SearchSortBy $sortBy = NULL;

    /**
     * Select setting for hit expansion.
     * if fetch="1" (or fetch="first") is specified, the first hit will be expanded inline (messages only at present)
     * if fetch="{item-id}", only the message with the given {item-id} is expanded inline
     * if fetch="{item-id-1,item-id-2,...,item-id-n}", messages with ids in the comma-separated list will be expanded
     * if fetch="all", all messages are expanded inline
     * if fetch="!", only the first message in the conversation will be expanded, whether it's a hit or not
     * if fetch="u" (or fetch="unread"), all unread hits are expanded
     * if fetch="u1" (or fetch="unread-first"), if there are any unread hits, they are expanded, otherwise the first hit is expanded.
     * if fetch="u1!", if there are any unread hits, they are expanded, otherwise the first hit and the first message are expanded (those may be the same)
     * if fetch="hits", all hits are expanded
     * if fetch="hits!", all hits are expanded if there are any, otherwise the first message is expanded
     * 
     * @Accessor(getter="getFetch", setter="setFetch")
     * @SerializedName("fetch")
     * @Type("string")
     * @XmlAttribute
     */
    private $fetch;

    /**
     * Inlined hits will be marked as read
     * @Accessor(getter="getMarkRead", setter="setMarkRead")
     * @SerializedName("read")
     * @Type("bool")
     * @XmlAttribute
     */
    private $markRead;

    /**
     * If specified, inlined body content in limited to the given length;
     * if the part is truncated, truncated="1" is specified on the <mp> in question
     * 
     * @Accessor(getter="getMaxInlinedLength", setter="setMaxInlinedLength")
     * @SerializedName("max")
     * @Type("integer")
     * @XmlAttribute
     */
    private $maxInlinedLength;

    /**
     * Set to 1 (true) to cause inlined hits to return HTML parts if available
     * 
     * @Accessor(getter="getWantHtml", setter="setWantHtml")
     * @SerializedName("html")
     * @Type("bool")
     * @XmlAttribute
     */
    private $wantHtml;

    /**
     * If 'needExp' is set in the request, two additional flags may be included in <e> elements for messages returned inline.
     * 
     * @Accessor(getter="getNeedCanExpand", setter="setNeedCanExpand")
     * @SerializedName("needExp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needCanExpand;

    /**
     * Set to 0 (false) to stop images in inlined HTML parts from being "neutered"
     * @Accessor(getter="getNeuterImages", setter="setNeuterImages")
     * @SerializedName("neuter")
     * @Type("bool")
     * @XmlAttribute
     */
    private $neuterImages;

    /**
     * Setting specifying which recipients should be returned.
     * 0 [default]:
     *    - returned sent messages will contain "From:" Senders only
     *    - returned conversations will contain an aggregated list of "From:" Senders from messages in the conversation (maximum of 8)
     * 1:
     *    - returned sent messages will contain the set of "To:" Recipients instead of the Sender
     *    - returned conversations whose first hit was sent by the user will contain that hit's "To:" recipients instead of the conversation's sender list (maximum of 8)
     * 2:
     *    - returned sent messages will contain the sets of both "From:" Senders and "To:" Recipients
     *    - returned conversations will contain an aggregated list of "From:" Senders and "To:" Recipients from messages in the conversation (maximum of 8 of each)
     * 
     * @Accessor(getter="getWantRecipients", setter="setWantRecipients")
     * @SerializedName("recip")
     * @Type("Enum<Zimbra\Common\Enum\WantRecipsSetting>")
     * @XmlAttribute
     */
    private ?WantRecipsSetting $wantRecipients = NULL;

    /**
     * Prefetch
     * 
     * @Accessor(getter="getPrefetch", setter="setPrefetch")
     * @SerializedName("prefetch")
     * @Type("bool")
     * @XmlAttribute
     */
    private $prefetch;

    /**
     * Specifies the type of result.
     * NORMAL [default]: Everything
     * IDS: Only IDs
     * 
     * @Accessor(getter="getResultMode", setter="setResultMode")
     * @SerializedName("resultMode")
     * @Type("string")
     * @XmlAttribute
     */
    private $resultMode;

    /**
     * By default, only matching messages are included in conversation results.
     * Set to 1 (true) to include all messages in the conversation, even if they don't match the search,
     * including items in Trash and Junk folders.
     * 
     * @Accessor(getter="getFullConversation", setter="setFullConversation")
     * @SerializedName("fullConversation")
     * @Type("bool")
     * @XmlAttribute
     */
    private $fullConversation;

    /**
     * By default, text without an operator searches the CONTENT field.  By setting the
     * {default-field} value, you can control the default operator. Specify any of the text operators that are
     * available in query.txt, e.g. 'content:' [the default] or 'subject:', etc.  The date operators
     * (date, after, before) and the "item:" operator should not be specified as default fields because of quirks in
     * the search grammar.
     * 
     * @Accessor(getter="getField", setter="setField")
     * @SerializedName("field")
     * @Type("string")
     * @XmlAttribute
     */
    private $field;

    /**
     * The maximum number of results to return. It defaults to 10 if not specified, and is capped by 1000
     * 
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * Specifies the 0-based offset into the results list to return as the first result for this search operation.
     * For example, limit=10 offset=30 will return the 31st through 40th results inclusive.
     * 
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * if <header>s are requested, any matching headers are included in inlined message hits
     * 
     * @Accessor(getter="getHeaders", setter="setHeaders")
     * @Type("array<Zimbra\Common\Struct\AttributeName>")
     * @XmlList(inline=true, entry="header", namespace="urn:zimbraMail")
     */
    private $headers = [];

    /**
     * Timezone specification
     * 
     * @Accessor(getter="getCalTz", setter="setCalTz")
     * @SerializedName("tz")
     * @Type("Zimbra\Mail\Struct\CalTZInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?CalTZInfoInterface $calTz = NULL;

    /**
     * Client locale identification.
     * Value is of the form LL-CC[-V+] where:
     * LL is two character language code
     * CC is two character country code
     * V+ is optional variant identifier string
     * ISO Language Codes: http://www.ics.uci.edu/pub/ietf/http/related/iso639.txt
     * ISO Country Codes: http://www.chemie.fu-berlin.de/diverse/doc/ISO_3166.html
     * 
     * @Accessor(getter="getLocale", setter="setLocale")
     * @SerializedName("locale")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraMail")
     */
    private $locale;

    /**
     * Cursor specification
     * @Accessor(getter="getCursor", setter="setCursor")
     * @SerializedName("cursor")
     * @Type("Zimbra\Common\Struct\CursorInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?CursorInfo $cursor = NULL;

    /**
     * used by clients if they want mail content with/without quoted text
     * 
     * @Accessor(getter="getWantContent", setter="setWantContent")
     * @SerializedName("wantContent")
     * @Type("Enum<Zimbra\Common\Enum\MsgContent>")
     * @XmlAttribute
     */
    private ?MsgContent $wantContent = NULL;

    /**
     * If set, Include the list of contact groups this contact is a member of.
     * Note: use sparingly, there is a performance penalty associated with computing this information
     * 
     * @Accessor(getter="getIncludeMemberOf", setter="setIncludeMemberOf")
     * @SerializedName("memberOf")
     * @Type("bool")
     * @XmlAttribute
     */
    private $includeMemberOf;

    /**
     * Get includeTagDeleted
     *
     * @return bool
     */
    public function getIncludeTagDeleted(): ?bool
    {
        return $this->includeTagDeleted;
    }

    /**
     * Set includeTagDeleted
     *
     * @param  bool $includeTagDeleted
     * @return self
     */
    public function setIncludeTagDeleted(bool $includeTagDeleted): self
    {
        $this->includeTagDeleted = $includeTagDeleted;
        return $this;
    }

    /**
     * Get includeTagMuted
     *
     * @return bool
     */
    public function getIncludeTagMuted(): ?bool
    {
        return $this->includeTagMuted;
    }

    /**
     * Set includeTagMuted
     *
     * @param  bool $includeTagMuted
     * @return self
     */
    public function setIncludeTagMuted(bool $includeTagMuted): self
    {
        $this->includeTagMuted = $includeTagMuted;
        return $this;
    }

    /**
     * Get allowableTaskStatus
     *
     * @return string
     */
    public function getAllowableTaskStatus(): ?string
    {
        return $this->allowableTaskStatus;
    }

    /**
     * Set allowableTaskStatus
     *
     * @param  string $allowableTaskStatus
     * @return self
     */
    public function setAllowableTaskStatus(string $allowableTaskStatus): self
    {
        $taskStatuses = array_filter(
            explode(',', $allowableTaskStatus), static fn($status) => TaskStatus::isValid(trim($status))
        );
        $this->allowableTaskStatus = implode(',', $taskStatuses);
        return $this;
    }

    /**
     * Get calItemExpandStart
     *
     * @return int
     */
    public function getCalItemExpandStart(): ?int
    {
        return $this->calItemExpandStart;
    }

    /**
     * Set calItemExpandStart
     *
     * @param  int $calItemExpandStart
     * @return self
     */
    public function setCalItemExpandStart(int $calItemExpandStart): self
    {
        $this->calItemExpandStart = $calItemExpandStart;
        return $this;
    }

    /**
     * Get calItemExpandEnd
     *
     * @return int
     */
    public function getCalItemExpandEnd(): ?int
    {
        return $this->calItemExpandEnd;
    }

    /**
     * Set calItemExpandEnd
     *
     * @param  int $calItemExpandEnd
     * @return self
     */
    public function setCalItemExpandEnd(int $calItemExpandEnd): self
    {
        $this->calItemExpandEnd = $calItemExpandEnd;
        return $this;
    }

    /**
     * Get query
     *
     * @return string
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * Set query
     *
     * @param  string $query
     * @return self
     */
    public function setQuery(string $query): self
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Get inDumpster
     *
     * @return bool
     */
    public function getInDumpster(): ?bool
    {
        return $this->inDumpster;
    }

    /**
     * Set inDumpster
     *
     * @param  bool $inDumpster
     * @return self
     */
    public function setInDumpster(bool $inDumpster): self
    {
        $this->inDumpster = $inDumpster;
        return $this;
    }

    /**
     * Get searchTypes
     *
     * @return string
     */
    public function getSearchTypes(): ?string
    {
        return $this->searchTypes;
    }

    /**
     * Set searchTypes
     *
     * @param  string $searchTypes
     * @return self
     */
    public function setSearchTypes(string $searchTypes): self
    {
        $validTypes = array_filter(
            explode(',', $searchTypes), static fn($type) => SearchType::isValid(trim($type))
        );
        $this->searchTypes = implode(',', $validTypes);
        return $this;
    }

    /**
     * Get groupBy
     *
     * @return string
     */
    public function getGroupBy(): ?string
    {
        return $this->groupBy;
    }

    /**
     * Set groupBy
     *
     * @param  string $groupBy
     * @return self
     */
    public function setGroupBy(string $groupBy): self
    {
        $this->groupBy = $groupBy;
        return $this;
    }

    /**
     * Get quick
     *
     * @return bool
     */
    public function getQuick(): ?bool
    {
        return $this->quick;
    }

    /**
     * Set quick
     *
     * @param  bool $quick
     * @return self
     */
    public function setQuick(bool $quick): self
    {
        $this->quick = $quick;
        return $this;
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
     * Get fetch
     *
     * @return string
     */
    public function getFetch(): ?string
    {
        return $this->fetch;
    }

    /**
     * Set fetch
     *
     * @param  string $fetch
     * @return self
     */
    public function setFetch(string $fetch): self
    {
        $this->fetch = $fetch;
        return $this;
    }

    /**
     * Get markRead
     *
     * @return bool
     */
    public function getMarkRead(): ?bool
    {
        return $this->markRead;
    }

    /**
     * Set markRead
     *
     * @param  bool $markRead
     * @return self
     */
    public function setMarkRead(bool $markRead): self
    {
        $this->markRead = $markRead;
        return $this;
    }

    /**
     * Get maxInlinedLength
     *
     * @return int
     */
    public function getMaxInlinedLength(): ?int
    {
        return $this->maxInlinedLength;
    }

    /**
     * Set maxInlinedLength
     *
     * @param  int $maxInlinedLength
     * @return self
     */
    public function setMaxInlinedLength(int $maxInlinedLength): self
    {
        $this->maxInlinedLength = $maxInlinedLength;
        return $this;
    }

    /**
     * Get wantHtml
     *
     * @return bool
     */
    public function getWantHtml(): ?bool
    {
        return $this->wantHtml;
    }

    /**
     * Set wantHtml
     *
     * @param  bool $wantHtml
     * @return self
     */
    public function setWantHtml(bool $wantHtml): self
    {
        $this->wantHtml = $wantHtml;
        return $this;
    }

    /**
     * Get needCanExpand
     *
     * @return bool
     */
    public function getNeedCanExpand(): ?bool
    {
        return $this->needCanExpand;
    }

    /**
     * Set needCanExpand
     *
     * @param  bool $needCanExpand
     * @return self
     */
    public function setNeedCanExpand(bool $needCanExpand): self
    {
        $this->needCanExpand = $needCanExpand;
        return $this;
    }

    /**
     * Get neuterImages
     *
     * @return bool
     */
    public function getNeuterImages(): ?bool
    {
        return $this->neuterImages;
    }

    /**
     * Set neuterImages
     *
     * @param  bool $neuterImages
     * @return self
     */
    public function setNeuterImages(bool $neuterImages): self
    {
        $this->neuterImages = $neuterImages;
        return $this;
    }

    /**
     * Get wantRecipients
     *
     * @return WantRecipsSetting
     */
    public function getWantRecipients(): ?WantRecipsSetting
    {
        return $this->wantRecipients;
    }

    /**
     * Set wantRecipients
     *
     * @param  WantRecipsSetting $wantRecipients
     * @return self
     */
    public function setWantRecipients(WantRecipsSetting $wantRecipients): self
    {
        $this->wantRecipients = $wantRecipients;
        return $this;
    }

    /**
     * Get prefetch
     *
     * @return bool
     */
    public function getPrefetch(): ?bool
    {
        return $this->prefetch;
    }

    /**
     * Set prefetch
     *
     * @param  bool $prefetch
     * @return self
     */
    public function setPrefetch(bool $prefetch): self
    {
        $this->prefetch = $prefetch;
        return $this;
    }

    /**
     * Get resultMode
     *
     * @return string
     */
    public function getResultMode(): ?string
    {
        return $this->resultMode;
    }

    /**
     * Set resultMode
     *
     * @param  string $resultMode
     * @return self
     */
    public function setResultMode(string $resultMode): self
    {
        $this->resultMode = $resultMode;
        return $this;
    }

    /**
     * Get fullConversation
     *
     * @return bool
     */
    public function getFullConversation(): ?bool
    {
        return $this->fullConversation;
    }

    /**
     * Set fullConversation
     *
     * @param  bool $fullConversation
     * @return self
     */
    public function setFullConversation(bool $fullConversation): self
    {
        $this->fullConversation = $fullConversation;
        return $this;
    }

    /**
     * Get field
     *
     * @return string
     */
    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * Set field
     *
     * @param  string $field
     * @return self
     */
    public function setField(string $field): self
    {
        $this->field = $field;
        return $this;
    }

    /**
     * Get limit
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Get offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Set offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Add header
     *
     * @param  AttributeName $header
     * @return self
     */
    public function addHeader(AttributeName $header): self
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Set headers
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = array_filter($headers, static fn($header) => $header instanceof AttributeName);
        return $this;
    }

    /**
     * Get headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Get the calTz
     *
     * @return CalTZInfoInterface
     */
    public function getCalTz(): ?CalTZInfoInterface
    {
        return $this->calTz;
    }

    /**
     * Set the calTz
     *
     * @param  CalTZInfoInterface $calTz
     * @return self
     */
    public function setCalTz(CalTZInfoInterface $calTz): self
    {
        $this->calTz = $calTz;
        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * Set locale
     *
     * @param  string $locale
     * @return self
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Get the cursor
     *
     * @return CursorInfo
     */
    public function getCursor(): ?CursorInfo
    {
        return $this->cursor;
    }

    /**
     * Set the cursor
     *
     * @param  CursorInfo $cursor
     * @return self
     */
    public function setCursor(CursorInfo $cursor): self
    {
        $this->cursor = $cursor;
        return $this;
    }

    /**
     * Get wantContent
     *
     * @return MsgContent
     */
    public function getWantContent(): ?MsgContent
    {
        return $this->wantContent;
    }

    /**
     * Set wantContent
     *
     * @param  MsgContent $wantContent
     * @return self
     */
    public function setWantContent(MsgContent $wantContent): self
    {
        $this->wantContent = $wantContent;
        return $this;
    }

    /**
     * Get includeMemberOf
     *
     * @return bool
     */
    public function getIncludeMemberOf(): ?bool
    {
        return $this->includeMemberOf;
    }

    /**
     * Set includeMemberOf
     *
     * @param  bool $includeMemberOf
     * @return self
     */
    public function setIncludeMemberOf(bool $includeMemberOf): self
    {
        $this->includeMemberOf = $includeMemberOf;
        return $this;
    }
}
