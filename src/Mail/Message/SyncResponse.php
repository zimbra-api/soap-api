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
use Zimbra\Mail\Struct\{
    SyncDeletedInfo,
    SyncFolder,
    TagInfo,
    NoteInfo,
    ContactInfo,
    CalendarItemInfo,
    TaskItemInfo,
    ConversationSummary,
    CommonDocumentInfo,
    DocumentInfo,
    MessageSummary,
    ChatSummary
};
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * SyncResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SyncResponse implements SoapResponseInterface
{
    /**
     * Change date
     * 
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("integer")
     * @XmlAttribute
     */
    private $changeDate;

    /**
     * New sync token
     * 
     * @Accessor(getter="getToken", setter="setToken")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     */
    private $token;

    /**
     * size
     * 
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $size;

    /**
     * If set, the response does not bring the client completely up to date.
     * More changes are still queued, and another SyncRequest (using the new returned token) is necessary.
     * 
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Information on deletes
     * 
     * @Accessor(getter="getDeleted", setter="setDeleted")
     * @SerializedName("deleted")
     * @Type("Zimbra\Mail\Struct\SyncDeletedInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?SyncDeletedInfo $deleted = NULL;

    /**
     * Sync folder items
     * 
     * @Accessor(getter="getFolderItems", setter="setFolderItems")
     * @Type("array<Zimbra\Mail\Struct\SyncFolder>")
     * @XmlList(inline=true, entry="folder", namespace="urn:zimbraMail")
     */
    private $folderItems = [];

    /**
     * Tag items
     * 
     * @Accessor(getter="getTagItems", setter="setTagItems")
     * @Type("array<Zimbra\Mail\Struct\TagInfo>")
     * @XmlList(inline=true, entry="tag", namespace="urn:zimbraMail")
     */
    private $tagItems = [];

    /**
     * Note items
     * 
     * @Accessor(getter="getNoteItems", setter="setNoteItems")
     * @Type("array<Zimbra\Mail\Struct\NoteInfo>")
     * @XmlList(inline=true, entry="note", namespace="urn:zimbraMail")
     */
    private $noteItems = [];

    /**
     * Contact items
     * 
     * @Accessor(getter="getContactItems", setter="setContactItems")
     * @Type("array<Zimbra\Mail\Struct\ContactInfo>")
     * @XmlList(inline=true, entry="cn", namespace="urn:zimbraMail")
     */
    private $contactItems = [];

    /**
     * Calendar items
     * 
     * @Accessor(getter="getApptItems", setter="setApptItems")
     * @Type("array<Zimbra\Mail\Struct\CalendarItemInfo>")
     * @XmlList(inline=true, entry="appt", namespace="urn:zimbraMail")
     */
    private $apptItems = [];

    /**
     * Task items
     * 
     * @Accessor(getter="getTaskItems", setter="setTaskItems")
     * @Type("array<Zimbra\Mail\Struct\TaskItemInfo>")
     * @XmlList(inline=true, entry="task", namespace="urn:zimbraMail")
     */
    private $taskItems = [];

    /**
     * Conversation items
     * 
     * @Accessor(getter="getConvItems", setter="setConvItems")
     * @Type("array<Zimbra\Mail\Struct\ConversationSummary>")
     * @XmlList(inline=true, entry="c", namespace="urn:zimbraMail")
     */
    private $convItems = [];

    /**
     * Wiki items
     * 
     * @Accessor(getter="getWikiItems", setter="setWikiItems")
     * @Type("array<Zimbra\Mail\Struct\CommonDocumentInfo>")
     * @XmlList(inline=true, entry="w", namespace="urn:zimbraMail")
     */
    private $wikiItems = [];

    /**
     * Document items
     * 
     * @Accessor(getter="getDocItems", setter="setDocItems")
     * @Type("array<Zimbra\Mail\Struct\DocumentInfo>")
     * @XmlList(inline=true, entry="doc", namespace="urn:zimbraMail")
     */
    private $docItems = [];

    /**
     * Message items
     * 
     * @Accessor(getter="getMsgItems", setter="setMsgItems")
     * @Type("array<Zimbra\Mail\Struct\MessageSummary>")
     * @XmlList(inline=true, entry="m", namespace="urn:zimbraMail")
     */
    private $msgItems = [];

    /**
     * Chat items
     * 
     * @Accessor(getter="getChatItems", setter="setChatItems")
     * @Type("array<Zimbra\Mail\Struct\ChatSummary>")
     * @XmlList(inline=true, entry="chat", namespace="urn:zimbraMail")
     */
    private $chatItems = [];

    /**
     * Constructor method for SyncResponse
     *
     * @param  int $changeDate
     * @param  string $token
     * @param  int $size
     * @param  bool $more
     * @param  SyncDeletedInfo $deleted
     * @param  array $items
     * @return self
     */
    public function __construct(
        int $changeDate = 0,
        ?string $token = NULL,
        ?int $size = NULL,
        ?bool $more = NULL,
        ?SyncDeletedInfo $deleted = NULL,
        array $items = []
    )
    {
        $this->setChangeDate($changeDate)
             ->setItems($items);
        if (NULL !== $token) {
            $this->setToken($token);
        }
        if (NULL !== $size) {
            $this->setSize($size);
        }
        if (NULL !== $more) {
            $this->setMore($more);
        }
        if ($deleted instanceof SyncDeletedInfo) {
            $this->setDeleted($deleted);
        }
    }

    /**
     * Gets changeDate
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Sets changeDate
     *
     * @param  int $changeDate
     * @return self
     */
    public function setChangeDate(int $changeDate): self
    {
        $this->changeDate = $changeDate;
        return $this;
    }

    /**
     * Gets token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Sets token
     *
     * @param  string $token
     * @return self
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Gets size
     *
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Sets size
     *
     * @param  int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Gets more
     *
     * @return bool
     */
    public function getMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Sets more
     *
     * @param  bool $more
     * @return self
     */
    public function setMore(bool $more): self
    {
        $this->more = $more;
        return $this;
    }
    /**
     * Gets deleted
     *
     * @return SyncDeletedInfo
     */
    public function getDeleted(): ?SyncDeletedInfo
    {
        return $this->deleted;
    }

    /**
     * Sets deleted
     *
     * @param  SyncDeletedInfo $deleted
     * @return self
     */
    public function setDeleted(SyncDeletedInfo $deleted): self
    {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * Sets items
     *
     * @param  array $items
     * @return self
     */
    public function setItems(array $items = []): self
    {
        $this->setFolderItems($items)
             ->setTagItems($items)
             ->setNoteItems($items)
             ->setContactItems($items)
             ->setApptItems($items)
             ->setTaskItems($items)
             ->setConvItems($items)
             ->setWikiItems($items)
             ->setDocItems($items)
             ->setMsgItems($items)
             ->setChatItems($items);
        return $this;
    }

    /**
     * Gets items
     *
     * @return array
     */
    public function getItems(): array
    {
        return array_merge(
            $this->folderItems,
            $this->tagItems,
            $this->noteItems,
            $this->contactItems,
            $this->apptItems,
            $this->taskItems,
            $this->convItems,
            $this->wikiItems,
            $this->docItems,
            $this->msgItems,
            $this->chatItems
        );
    }

    /**
     * Sets folderItems
     *
     * @param  array $folderItems
     * @return self
     */
    public function setFolderItems(array $items): self
    {
        $this->folderItems = array_values(
            array_filter($items, static fn ($item) => $item instanceof SyncFolder)
        );
        return $this;
    }

    /**
     * Gets folderItems
     *
     * @return array
     */
    public function getFolderItems(): array
    {
        return $this->folderItems;
    }

    /**
     * Sets tagItems
     *
     * @param  array $tagItems
     * @return self
     */
    public function setTagItems(array $items): self
    {
        $this->tagItems = array_values(
            array_filter($items, static fn ($item) => $item instanceof TagInfo)
        );
        return $this;
    }

    /**
     * Gets tagItems
     *
     * @return array
     */
    public function getTagItems(): array
    {
        return $this->tagItems;
    }

    /**
     * Sets noteItems
     *
     * @param  array $noteItems
     * @return self
     */
    public function setNoteItems(array $items): self
    {
        $this->noteItems = array_values(
            array_filter($items, static fn ($item) => $item instanceof NoteInfo)
        );
        return $this;
    }

    /**
     * Gets noteItems
     *
     * @return array
     */
    public function getNoteItems(): array
    {
        return $this->noteItems;
    }

    /**
     * Sets contactItems
     *
     * @param  array $contactItems
     * @return self
     */
    public function setContactItems(array $items): self
    {
        $this->contactItems = array_values(
            array_filter($items, static fn ($item) => $item instanceof ContactInfo)
        );
        return $this;
    }

    /**
     * Gets contactItems
     *
     * @return array
     */
    public function getContactItems(): array
    {
        return $this->contactItems;
    }

    /**
     * Sets apptItems
     *
     * @param  array $apptItems
     * @return self
     */
    public function setApptItems(array $items): self
    {
        $this->apptItems = array_values(
            array_filter($items, static fn ($item) => get_class($item) === CalendarItemInfo::class)
        );
        return $this;
    }

    /**
     * Gets apptItems
     *
     * @return array
     */
    public function getApptItems(): array
    {
        return $this->apptItems;
    }

    /**
     * Sets taskItems
     *
     * @param  array $taskItems
     * @return self
     */
    public function setTaskItems(array $items): self
    {
        $this->taskItems = array_values(
            array_filter($items, static fn ($item) => $item instanceof TaskItemInfo)
        );
        return $this;
    }

    /**
     * Gets taskItems
     *
     * @return array
     */
    public function getTaskItems(): array
    {
        return $this->taskItems;
    }

    /**
     * Sets convItems
     *
     * @param  array $convItems
     * @return self
     */
    public function setConvItems(array $items): self
    {
        $this->convItems = array_values(
            array_filter($items, static fn ($item) => $item instanceof ConversationSummary)
        );
        return $this;
    }

    /**
     * Gets convItems
     *
     * @return array
     */
    public function getConvItems(): array
    {
        return $this->convItems;
    }

    /**
     * Sets wikiItems
     *
     * @param  array $wikiItems
     * @return self
     */
    public function setWikiItems(array $items): self
    {
        $this->wikiItems = array_values(
            array_filter($items, static fn ($item) => get_class($item) === CommonDocumentInfo::class)
        );
        return $this;
    }

    /**
     * Gets wikiItems
     *
     * @return array
     */
    public function getWikiItems(): array
    {
        return $this->wikiItems;
    }

    /**
     * Sets docItems
     *
     * @param  array $docItems
     * @return self
     */
    public function setDocItems(array $items): self
    {
        $this->docItems = array_values(
            array_filter($items, static fn ($item) => $item instanceof DocumentInfo)
        );
        return $this;
    }

    /**
     * Gets docItems
     *
     * @return array
     */
    public function getDocItems(): array
    {
        return $this->docItems;
    }

    /**
     * Sets msgItems
     *
     * @param  array $msgItems
     * @return self
     */
    public function setMsgItems(array $items): self
    {
        $this->msgItems = array_values(
            array_filter($items, static fn ($item) => get_class($item) === MessageSummary::class)
        );
        return $this;
    }

    /**
     * Gets msgItems
     *
     * @return array
     */
    public function getMsgItems(): array
    {
        return $this->msgItems;
    }

    /**
     * Sets chatItems
     *
     * @param  array $chatItems
     * @return self
     */
    public function setChatItems(array $items): self
    {
        $this->chatItems = array_values(
            array_filter($items, static fn ($item) => $item instanceof ChatSummary)
        );
        return $this;
    }

    /**
     * Gets chatItems
     *
     * @return array
     */
    public function getChatItems(): array
    {
        return $this->chatItems;
    }
}
