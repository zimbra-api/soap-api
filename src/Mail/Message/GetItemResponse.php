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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

use Zimbra\Mail\Struct\{
    Folder,
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

use Zimbra\Soap\ResponseInterface;

/**
 * GetItemResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetItemResponse implements ResponseInterface
{
    /**
     * Folder item
     * 
     * @Accessor(getter="getFolderItem", setter="setItem")
     * @SerializedName("folder")
     * @Type("Zimbra\Mail\Struct\Folder")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?Folder $folderItem = NULL;

    /**
     * Tag item
     * 
     * @Accessor(getter="getTagItem", setter="setItem")
     * @SerializedName("tag")
     * @Type("Zimbra\Mail\Struct\TagInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?TagInfo $tagItem = NULL;

    /**
     * Note item
     * 
     * @Accessor(getter="getNoteItem", setter="setItem")
     * @SerializedName("note")
     * @Type("Zimbra\Mail\Struct\NoteInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?NoteInfo $noteItem = NULL;

    /**
     * Contact item
     * 
     * @Accessor(getter="getContactItem", setter="setItem")
     * @SerializedName("cn")
     * @Type("Zimbra\Mail\Struct\ContactInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ContactInfo $contactItem = NULL;

    /**
     * Calendar item
     * 
     * @Accessor(getter="getApptItem", setter="setItem")
     * @SerializedName("appt")
     * @Type("Zimbra\Mail\Struct\CalendarItemInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?CalendarItemInfo $apptItem = NULL;

    /**
     * Task item
     * 
     * @Accessor(getter="getTaskItem", setter="setItem")
     * @SerializedName("task")
     * @Type("Zimbra\Mail\Struct\TaskItemInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?TaskItemInfo $taskItem = NULL;

    /**
     * Conversation item
     * 
     * @Accessor(getter="getConvItem", setter="setItem")
     * @SerializedName("c")
     * @Type("Zimbra\Mail\Struct\ConversationSummary")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ConversationSummary $convItem = NULL;

    /**
     * Wiki item
     * 
     * @Accessor(getter="getWikiItem", setter="setItem")
     * @SerializedName("w")
     * @Type("Zimbra\Mail\Struct\CommonDocumentInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?CommonDocumentInfo $wikiItem = NULL;

    /**
     * Document item
     * 
     * @Accessor(getter="getDocItem", setter="setItem")
     * @SerializedName("doc")
     * @Type("Zimbra\Mail\Struct\DocumentInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?DocumentInfo $docItem = NULL;

    /**
     * Message item
     * 
     * @Accessor(getter="getMsgItem", setter="setItem")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MessageSummary")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MessageSummary $msgItem = NULL;

    /**
     * Chat item
     * 
     * @Accessor(getter="getChatItem", setter="setItem")
     * @SerializedName("chat")
     * @Type("Zimbra\Mail\Struct\ChatSummary")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ChatSummary $chatItem = NULL;

    /**
     * Constructor method for GetItemResponse
     *
     * @param  mix $item
     * @return self
     */
    public function __construct($item = NULL)
    {
        if (NULL !== $item) {
            $this->setItem($item);
        }
    }

    /**
     * Get folder item
     * 
     * @return Folder
     */
    public function getFolderItem(): ?Folder
    {
        return $this->folderItem;
    }

    /**
     * Get tag item
     * 
     * @return TagInfo
     */
    public function getTagItem(): ?TagInfo
    {
        return $this->tagItem;
    }

    /**
     * Get note item
     * 
     * @return NoteInfo
     */
    public function getNoteItem(): ?NoteInfo
    {
        return $this->noteItem;
    }

    /**
     * Get contact item
     * 
     * @return ContactInfo
     */
    public function getContactItem(): ?ContactInfo
    {
        return $this->contactItem;
    }

    /**
     * Get appt item
     * 
     * @return CalendarItemInfo
     */
    public function getApptItem(): ?CalendarItemInfo
    {
        return $this->apptItem;
    }

    /**
     * Get task item
     * 
     * @return TaskItemInfo
     */
    public function getTaskItem(): ?TaskItemInfo
    {
        return $this->taskItem;
    }

    /**
     * Get conv item
     * 
     * @return ConversationSummary
     */
    public function getConvItem(): ?ConversationSummary
    {
        return $this->convItem;
    }

    /**
     * Get wiki item
     * 
     * @return CommonDocumentInfo
     */
    public function getWikiItem(): ?CommonDocumentInfo
    {
        return $this->wikiItem;
    }

    /**
     * Get doc item
     * 
     * @return DocumentInfo
     */
    public function getDocItem(): ?DocumentInfo
    {
        return $this->docItem;
    }

    /**
     * Get msg item
     * 
     * @return MessageSummary
     */
    public function getMsgItem(): ?MessageSummary
    {
        return $this->msgItem;
    }

    /**
     * Get chat item
     * 
     * @return ChatSummary
     */
    public function getChatItem(): ?ChatSummary
    {
        return $this->chatItem;
    }

    /**
     * Set item
     * 
     * @return self
     */
    public function setItem($item): self
    {
        $this->folderItem =
        $this->tagItem =
        $this->noteItem =
        $this->contactItem =
        $this->apptItem =
        $this->taskItem =
        $this->convItem =
        $this->wikiItem =
        $this->docItem =
        $this->msgItem =
        $this->chatItem = NULL;

        if ($item instanceof Folder) {
            $this->folderItem = $item;
        }
        if ($item instanceof TagInfo) {
            $this->tagItem = $item;
        }
        if ($item instanceof NoteInfo) {
            $this->noteItem = $item;
        }
        if ($item instanceof ContactInfo) {
            $this->contactItem = $item;
        }
        if ($item instanceof CalendarItemInfo) {
            $this->apptItem = $item;
        }
        if ($item instanceof TaskItemInfo) {
            $this->taskItem = $item;
        }
        if ($item instanceof ConversationSummary) {
            $this->convItem = $item;
        }
        if ($item instanceof CommonDocumentInfo) {
            $this->wikiItem = $item;
        }
        if ($item instanceof DocumentInfo) {
            $this->docItem = $item;
        }
        if ($item instanceof MessageSummary) {
            $this->msgItem = $item;
        }
        if ($item instanceof ChatSummary) {
            $this->chatItem = $item;
        }
        return $this;
    }
}
