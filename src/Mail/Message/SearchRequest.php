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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Mail\Struct\{CalTZInfo, MailSearchParams};
use Zimbra\Common\Enum\{MsgContent, SearchSortBy, WantRecipsSetting};
use Zimbra\Common\Struct\{
    CursorInfo,
    SearchParameters,
    SoapEnvelopeInterface,
    SoapRequest
};

/**
 * SearchRequest class
 * Search
 * For a response, the order of the returned results represents the sorted order.
 * There is not a separate index attribute or element.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchRequest extends SoapRequest implements SearchParameters
{
    use MailSearchParams;

    /**
     * Warmup: When this option is specified, all other options are simply ignored,
     * so you can't include this option in regular search requests.
     * This option gives a hint to the index system to open the index data and primes it for search.
     * The client should send this warm-up request as soon as the user puts the cursor on the search bar.
     * This will not only prime the index but also opens a persistent HTTP connection
     * (HTTP 1.1 Keep-Alive) to the server, hence smaller latencies in subseqent search requests.
     * Sending this warm-up request too early (e.g. login time) will be in vain in most cases because
     * the index data is evicted from the cache due to inactivity timeout by the time you actually send a search request.
     *
     * @Accessor(getter="getWarmup", setter="setWarmup")
     * @SerializedName("warmup")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getWarmup", setter: "setWarmup")]
    #[SerializedName("warmup")]
    #[Type("bool")]
    #[XmlAttribute]
    private $warmup;

    /**
     * Constructor
     *
     * @param string $query
     * @param bool $inDumpster
     * @param string $searchTypes
     * @param string $groupBy
     * @param bool $quick
     * @param SearchSortBy $sortBy
     * @param bool $includeTagDeleted
     * @param bool $includeTagMuted
     * @param string $taskStatus
     * @param int $calItemExpandStart
     * @param int $calItemExpandEnd
     * @param string $fetch
     * @param bool $markRead
     * @param int $maxInlinedLength
     * @param bool $wantHtml
     * @param bool $needCanExpand
     * @param bool $neuterImages
     * @param WantRecipsSetting $wantRecipients
     * @param bool $prefetch
     * @param string $resultMode
     * @param bool $fullConversation
     * @param string $field
     * @param int $limit
     * @param int $offset
     * @param array $headers
     * @param CalTZInfo $calTz
     * @param string $locale
     * @param CursorInfo $cursor
     * @param MsgContent $wantContent
     * @param bool $includeMemberOf
     * @param bool $warmup
     * @return self
     */
    public function __construct(
        ?string $query = null,
        ?bool $inDumpster = null,
        ?string $searchTypes = null,
        ?string $groupBy = null,
        ?int $calItemExpandStart = null,
        ?int $calItemExpandEnd = null,
        ?bool $quick = null,
        ?SearchSortBy $sortBy = null,
        ?bool $includeTagDeleted = null,
        ?bool $includeTagMuted = null,
        ?string $taskStatus = null,
        ?string $fetch = null,
        ?bool $markRead = null,
        ?int $maxInlinedLength = null,
        ?bool $wantHtml = null,
        ?bool $needCanExpand = null,
        ?bool $neuterImages = null,
        ?WantRecipsSetting $wantRecipients = null,
        ?bool $prefetch = null,
        ?string $resultMode = null,
        ?bool $fullConversation = null,
        ?string $field = null,
        ?int $limit = null,
        ?int $offset = null,
        array $headers = [],
        ?CalTZInfo $calTz = null,
        ?string $locale = null,
        ?CursorInfo $cursor = null,
        ?MsgContent $wantContent = null,
        ?bool $includeMemberOf = null,
        ?bool $warmup = null
    ) {
        $this->setHeaders($headers);
        $this->sortBy = $sortBy;
        $this->wantRecipients = $wantRecipients;
        $this->calTz = $calTz;
        $this->cursor = $cursor;
        $this->wantContent = $wantContent;
        if (null !== $query) {
            $this->setQuery($query);
        }
        if (null !== $inDumpster) {
            $this->setInDumpster($inDumpster);
        }
        if (null !== $searchTypes) {
            $this->setSearchTypes($searchTypes);
        }
        if (null !== $groupBy) {
            $this->setGroupBy($groupBy);
        }
        if (null !== $quick) {
            $this->setQuick($quick);
        }
        if (null !== $includeTagDeleted) {
            $this->setIncludeTagDeleted($includeTagDeleted);
        }
        if (null !== $includeTagMuted) {
            $this->setIncludeTagMuted($includeTagMuted);
        }
        if (null !== $taskStatus) {
            $this->setAllowableTaskStatus($taskStatus);
        }
        if (null !== $calItemExpandStart) {
            $this->setCalItemExpandStart($calItemExpandStart);
        }
        if (null !== $calItemExpandEnd) {
            $this->setCalItemExpandEnd($calItemExpandEnd);
        }
        if (null !== $fetch) {
            $this->setFetch($fetch);
        }
        if (null !== $markRead) {
            $this->setMarkRead($markRead);
        }
        if (null !== $maxInlinedLength) {
            $this->setMaxInlinedLength($maxInlinedLength);
        }
        if (null !== $wantHtml) {
            $this->setWantHtml($wantHtml);
        }
        if (null !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
        if (null !== $neuterImages) {
            $this->setNeuterImages($neuterImages);
        }
        if (null !== $prefetch) {
            $this->setPrefetch($prefetch);
        }
        if (null !== $resultMode) {
            $this->setResultMode($resultMode);
        }
        if (null !== $fullConversation) {
            $this->setFullConversation($fullConversation);
        }
        if (null !== $field) {
            $this->setField($field);
        }
        if (null !== $limit) {
            $this->setLimit($limit);
        }
        if (null !== $offset) {
            $this->setOffset($offset);
        }
        if (null !== $locale) {
            $this->setLocale($locale);
        }
        if (null !== $includeMemberOf) {
            $this->setIncludeMemberOf($includeMemberOf);
        }
        if (null !== $warmup) {
            $this->setWarmup($warmup);
        }
    }

    /**
     * Get warmup
     *
     * @return bool
     */
    public function getWarmup(): ?bool
    {
        return $this->warmup;
    }

    /**
     * Set warmup
     *
     * @param bool $warmup
     * @return self
     */
    public function setWarmup(bool $warmup): self
    {
        $this->warmup = $warmup;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SearchEnvelope(new SearchBody($this));
    }
}
