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
use Zimbra\Common\Struct\{CursorInfo, SearchParameters, SoapEnvelopeInterface, SoapRequest};

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
     * @Accessor(getter="getConversationId", setter="setConversationId")
     * @SerializedName("cid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getConversationId', setter: 'setConversationId')]
    #[SerializedName('cid')]
    #[Type('string')]
    #[XmlAttribute]
    private $conversationId;

    /**
     * If set then the response will contain a top level <c> element representing
     * the conversation with child <m> elements representing messages in the conversation.
     * If unset, no <c> element is included - <m> elements will be top level elements.
     * 
     * @Accessor(getter="getNestMessages", setter="setNestMessages")
     * @SerializedName("nest")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getNestMessages', setter: 'setNestMessages')]
    #[SerializedName('nest')]
    #[Type('bool')]
    #[XmlAttribute]
    private $nestMessages;

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
        string $conversationId = '',
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
        ?bool $nestMessages = NULL
    )
    {
        $this->setHeaders($headers)
             ->setConversationId($conversationId);
        $this->sortBy = $sortBy;
        $this->wantRecipients = $wantRecipients;
        $this->calTz = $calTz;
        $this->cursor = $cursor;
        $this->wantContent = $wantContent;
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
        if (NULL !== $locale) {
            $this->setLocale($locale);
        }
        if (NULL !== $includeMemberOf) {
            $this->setIncludeMemberOf($includeMemberOf);
        }
        if (NULL !== $nestMessages) {
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
        return new SearchConvEnvelope(
            new SearchConvBody($this)
        );
    }
}
