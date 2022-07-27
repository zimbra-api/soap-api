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
use Zimbra\Common\Enum\{MsgContent, SearchSortBy, WantRecipsSetting};
use Zimbra\Common\Struct\{CursorInfo, SearchParameters};
use Zimbra\Mail\Struct\{CalTZInfo, MailSearchParams};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SearchRequest extends SoapRequest implements SearchParameters
{
    use MailSearchParams;

    /**
     * Warmup: When this option is specified, all other options are simply ignored, so you
     * can't include this option in regular search requests. This option gives a hint to the index system to open the
     * index data and primes it for search. The client should send this warm-up request as soon as the user puts the
     * cursor on the search bar. This will not only prime the index but also opens a persistent HTTP connection
     * (HTTP 1.1 Keep-Alive) to the server, hence smaller latencies in subseqent search requests. Sending this warm-up
     * request too early (e.g. login time) will be in vain in most cases because the index data is evicted from the
     * cache due to inactivity timeout by the time you actually send a search request.
     * 
     * @Accessor(getter="getWarmup", setter="setWarmup")
     * @SerializedName("warmup")
     * @Type("bool")
     * @XmlAttribute
     */
    private $warmup;

    /**
     * Constructor method for SearchRequest
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
     * @param string $wantContent
     * @param bool $includeMemberOf
     * @param bool $warmup
     * @return self
     */
    public function __construct(
        ?string $query = NULL,
        ?bool $inDumpster = NULL,
        ?string $searchTypes = NULL,
        ?string $groupBy = NULL,
        ?int $calItemExpandStart = NULL,
        ?int $calItemExpandEnd = NULL,
        ?bool $quick = NULL,
        ?SearchSortBy $sortBy = NULL,
        ?bool $includeTagDeleted = NULL,
        ?bool $includeTagMuted = NULL,
        ?string $taskStatus = NULL,
        ?string $fetch = NULL,
        ?bool $markRead = NULL,
        ?int $maxInlinedLength = NULL,
        ?bool $wantHtml = NULL,
        ?bool $needCanExpand = NULL,
        ?bool $neuterImages = NULL,
        ?WantRecipsSetting $wantRecipients = NULL,
        ?bool $prefetch = NULL,
        ?string $resultMode = NULL,
        ?bool $fullConversation = NULL,
        ?string $field = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        array $headers = [],
        ?CalTZInfo $calTz = NULL,
        ?string $locale = NULL,
        ?CursorInfo $cursor = NULL,
        ?MsgContent $wantContent = NULL,
        ?bool $includeMemberOf = NULL,
        ?bool $warmup = NULL
    )
    {
        $this->setHeaders($headers);
        if (NULL !== $query) {
            $this->setQuery($query);
        }
        if (NULL !== $inDumpster) {
            $this->setInDumpster($inDumpster);
        }
        if (NULL !== $searchTypes) {
            $this->setSearchTypes($searchTypes);
        }
        if (NULL !== $groupBy) {
            $this->setGroupBy($groupBy);
        }
        if (NULL !== $quick) {
            $this->setQuick($quick);
        }
        if (NULL !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $includeTagDeleted) {
            $this->setIncludeTagDeleted($includeTagDeleted);
        }
        if (NULL !== $includeTagMuted) {
            $this->setIncludeTagMuted($includeTagMuted);
        }
        if (NULL !== $taskStatus) {
            $this->setAllowableTaskStatus($taskStatus);
        }
        if (NULL !== $calItemExpandStart) {
            $this->setCalItemExpandStart($calItemExpandStart);
        }
        if (NULL !== $calItemExpandEnd) {
            $this->setCalItemExpandEnd($calItemExpandEnd);
        }
        if (NULL !== $fetch) {
            $this->setFetch($fetch);
        }
        if (NULL !== $markRead) {
            $this->setMarkRead($markRead);
        }
        if (NULL !== $maxInlinedLength) {
            $this->setMaxInlinedLength($maxInlinedLength);
        }
        if (NULL !== $wantHtml) {
            $this->setWantHtml($wantHtml);
        }
        if (NULL !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
        if (NULL !== $neuterImages) {
            $this->setNeuterImages($neuterImages);
        }
        if (NULL !== $wantRecipients) {
            $this->setWantRecipients($wantRecipients);
        }
        if (NULL !== $prefetch) {
            $this->setPrefetch($prefetch);
        }
        if (NULL !== $resultMode) {
            $this->setResultMode($resultMode);
        }
        if (NULL !== $fullConversation) {
            $this->setFullConversation($fullConversation);
        }
        if (NULL !== $field) {
            $this->setField($field);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if ($calTz instanceof CalTZInfo) {
            $this->setCalTz($calTz);
        }
        if (NULL !== $locale) {
            $this->setLocale($locale);
        }
        if ($cursor instanceof CursorInfo) {
            $this->setCursor($cursor);
        }
        if (NULL !== $wantContent) {
            $this->setWantContent($wantContent);
        }
        if (NULL !== $includeMemberOf) {
            $this->setIncludeMemberOf($includeMemberOf);
        }
        if (NULL !== $warmup) {
            $this->setWarmup($warmup);
        }
    }

    /**
     * Gets warmup
     *
     * @return bool
     */
    public function getWarmup(): ?bool
    {
        return $this->warmup;
    }

    /**
     * Sets warmup
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
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SearchEnvelope(
            new SearchBody($this)
        );
    }
}
