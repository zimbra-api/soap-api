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
 * SearchConvRequest class
 * Search a conversation
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchConvRequest extends SoapRequest implements SearchParameters
{
    use MailSearchParams;

    /**
     * The ID of the conversation to search within. REQUIRED.
     *
     * @var string
     */
    #[Accessor(getter: "getConversationId", setter: "setConversationId")]
    #[SerializedName("cid")]
    #[Type("string")]
    #[XmlAttribute]
    private string $conversationId;

    /**
     * If set then the response will contain a top level <c> element representing
     * the conversation with child <m> elements representing messages in the conversation.
     * If unset, no <c> element is included - <m> elements will be top level elements.
     *
     * @var bool
     */
    #[Accessor(getter: "getNestMessages", setter: "setNestMessages")]
    #[SerializedName("nest")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $nestMessages = null;

    /**
     * Constructor
     *
     * @param string $conversationId
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
     * @param bool $nestMessages
     * @return self
     */
    public function __construct(
        string $conversationId = "",
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
        ?bool $nestMessages = null
    ) {
        $this->setHeaders($headers)->setConversationId($conversationId);
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
        if (null !== $nestMessages) {
            $this->setNestMessages($nestMessages);
        }
    }

    /**
     * Get conversationId
     *
     * @return string
     */
    public function getConversationId(): string
    {
        return $this->conversationId;
    }

    /**
     * Set conversationId
     *
     * @param  string $conversationId
     * @return self
     */
    public function setConversationId(string $conversationId): self
    {
        $this->conversationId = $conversationId;
        return $this;
    }

    /**
     * Get nestMessages
     *
     * @return bool
     */
    public function getNestMessages(): ?bool
    {
        return $this->nestMessages;
    }

    /**
     * Set nestMessages
     *
     * @param bool $nestMessages
     * @return self
     */
    public function setNestMessages(bool $nestMessages): self
    {
        $this->nestMessages = $nestMessages;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SearchConvEnvelope(new SearchConvBody($this));
    }
}
