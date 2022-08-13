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
use Zimbra\Common\Struct\SoapResponse;

/**
 * SyncResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SyncResponse extends SoapResponse
{
    /**
     * Change date
     * 
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("int")
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
     * @Type("int")
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
     * @var SyncDeletedInfo
     */
    private $deleted;

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
     * Constructor
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
     * Get changeDate
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Set changeDate
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
     * Get token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set token
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
     * Get size
     *
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set size
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
     * Get more
     *
     * @return bool
     */
    public function getMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Set more
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
     * Get deleted
     *
     * @return SyncDeletedInfo
     */
    public function getDeleted(): ?SyncDeletedInfo
    {
        return $this->deleted;
    }

    /**
     * Set deleted
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
     * Set items
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
     * Get items
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
     * Set folderItems
     *
     * @param  array $items
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
     * Get folderItems
     *
     * @return array
     */
    public function getFolderItems(): array
    {
        return $this->folderItems;
    }

    /**
     * Set tagItems
     *
     * @param  array $items
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
     * Get tagItems
     *
     * @return array
     */
    public function getTagItems(): array
    {
        return $this->tagItems;
    }

    /**
     * Set noteItems
     *
     * @param  array $items
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
     * Get noteItems
     *
     * @return array
     */
    public function getNoteItems(): array
    {
        return $this->noteItems;
    }

    /**
     * Set contactItems
     *
     * @param  array $items
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
     * Get contactItems
     *
     * @return array
     */
    public function getContactItems(): array
    {
        return $this->contactItems;
    }

    /**
     * Set apptItems
     *
     * @param  array $items
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
     * Get apptItems
     *
     * @return array
     */
    public function getApptItems(): array
    {
        return $this->apptItems;
    }

    /**
     * Set taskItems
     *
     * @param  array $items
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
     * Get taskItems
     *
     * @return array
     */
    public function getTaskItems(): array
    {
        return $this->taskItems;
    }

    /**
     * Set convItems
     *
     * @param  array $items
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
     * Get convItems
     *
     * @return array
     */
    public function getConvItems(): array
    {
        return $this->convItems;
    }

    /**
     * Set wikiItems
     *
     * @param  array $items
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
     * Get wikiItems
     *
     * @return array
     */
    public function getWikiItems(): array
    {
        return $this->wikiItems;
    }

    /**
     * Set docItems
     *
     * @param  array $items
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
     * Get docItems
     *
     * @return array
     */
    public function getDocItems(): array
    {
        return $this->docItems;
    }

    /**
     * Set msgItems
     *
     * @param  array $items
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
     * Get msgItems
     *
     * @return array
     */
    public function getMsgItems(): array
    {
        return $this->msgItems;
    }

    /**
     * Set chatItems
     *
     * @param  array $items
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
     * Get chatItems
     *
     * @return array
     */
    public function getChatItems(): array
    {
        return $this->chatItems;
    }
}
