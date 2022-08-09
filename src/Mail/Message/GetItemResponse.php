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

use Zimbra\Common\Struct\SoapResponse;

/**
 * GetItemResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetItemResponse extends SoapResponse
{
    /**
     * Folder item
     * 
     * @Accessor(getter="getFolderItem", setter="setFolderItem")
     * @SerializedName("folder")
     * @Type("Zimbra\Mail\Struct\Folder")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var Folder
     */
    private $folderItem;

    /**
     * Tag item
     * 
     * @Accessor(getter="getTagItem", setter="setTagItem")
     * @SerializedName("tag")
     * @Type("Zimbra\Mail\Struct\TagInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var TagInfo
     */
    private $tagItem;

    /**
     * Note item
     * 
     * @Accessor(getter="getNoteItem", setter="setNoteItem")
     * @SerializedName("note")
     * @Type("Zimbra\Mail\Struct\NoteInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var NoteInfo
     */
    private $noteItem;

    /**
     * Contact item
     * 
     * @Accessor(getter="getContactItem", setter="setContactItem")
     * @SerializedName("cn")
     * @Type("Zimbra\Mail\Struct\ContactInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var ContactInfo
     */
    private $contactItem;

    /**
     * Calendar item
     * 
     * @Accessor(getter="getApptItem", setter="setApptItem")
     * @SerializedName("appt")
     * @Type("Zimbra\Mail\Struct\CalendarItemInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var CalendarItemInfo
     */
    private $apptItem;

    /**
     * Task item
     * 
     * @Accessor(getter="getTaskItem", setter="setTaskItem")
     * @SerializedName("task")
     * @Type("Zimbra\Mail\Struct\TaskItemInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var TaskItemInfo
     */
    private $taskItem;

    /**
     * Conversation item
     * 
     * @Accessor(getter="getConvItem", setter="setConvItem")
     * @SerializedName("c")
     * @Type("Zimbra\Mail\Struct\ConversationSummary")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var ConversationSummary
     */
    private $convItem;

    /**
     * Wiki item
     * 
     * @Accessor(getter="getWikiItem", setter="setWikiItem")
     * @SerializedName("w")
     * @Type("Zimbra\Mail\Struct\CommonDocumentInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var CommonDocumentInfo
     */
    private $wikiItem;

    /**
     * Document item
     * 
     * @Accessor(getter="getDocItem", setter="setDocItem")
     * @SerializedName("doc")
     * @Type("Zimbra\Mail\Struct\DocumentInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var DocumentInfo
     */
    private $docItem;

    /**
     * Message item
     * 
     * @Accessor(getter="getMsgItem", setter="setMsgItem")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MessageSummary")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var MessageSummary
     */
    private $msgItem;

    /**
     * Chat item
     * 
     * @Accessor(getter="getChatItem", setter="setChatItem")
     * @SerializedName("chat")
     * @Type("Zimbra\Mail\Struct\ChatSummary")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var ChatSummary
     */
    private $chatItem;

    /**
     * Constructor
     *
     * @param  mixed $item
     * @return self
     */
    public function __construct($item = NULL)
    {
        if (NULL !== $item) {
            $this->setItem($item);
        }
    }

    /**
     * Set item
     * 
     * @param  mixed $item
     * @return self
     */
    public function setItem($item): self
    {
        if ($item instanceof Folder) {
            return $this->setFolderItem($item);
        }
        if ($item instanceof TagInfo) {
            return $this->setTagItem($item);
        }
        if ($item instanceof NoteInfo) {
            return $this->setNoteItem($item);
        }
        if ($item instanceof ContactInfo) {
            return $this->setContactItem($item);
        }

        if ($item instanceof TaskItemInfo) {
            return $this->setTaskItem($item);
        }
        else if ($item instanceof CalendarItemInfo) {
            return $this->setApptItem($item);
        }

        if ($item instanceof ConversationSummary) {
            return $this->setConvItem($item);
        }

        if ($item instanceof DocumentInfo) {
            return $this->setDocItem($item);
        }
        else if ($item instanceof CommonDocumentInfo) {
            return $this->setWikiItem($item);
        }

        if ($item instanceof ChatSummary) {
            return $this->setChatItem($item);
        }
        else if ($item instanceof MessageSummary) {
            return $this->setMsgItem($item);
        }
        return $this;
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
     * Set folder item
     * 
     * @param  Folder $item
     * @return self
     */
    public function setFolderItem(Folder $item): self
    {
        $this->folderItem = $item;
        return $this;
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
     * Set tag item
     * 
     * @param  TagInfo $item
     * @return self
     */
    public function setTagItem(TagInfo $item): self
    {
        $this->tagItem = $item;
        return $this;
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
     * Set note item
     * 
     * @param  NoteInfo $item
     * @return self
     */
    public function setNoteItem(NoteInfo $item): self
    {
        $this->noteItem = $item;
        return $this;
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
     * Set contact item
     * 
     * @param  ContactInfo $item
     * @return self
     */
    public function setContactItem(ContactInfo $item): self
    {
        $this->contactItem = $item;
        return $this;
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
     * Set appt item
     * 
     * @param  CalendarItemInfo $item
     * @return self
     */
    public function setApptItem(CalendarItemInfo $item): self
    {
        $this->apptItem = $item;
        return $this;
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
     * Set task item
     * 
     * @param  TaskItemInfo $item
     * @return self
     */
    public function setTaskItem(TaskItemInfo $item): self
    {
        $this->taskItem = $item;
        return $this;
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
     * Set conv item
     * 
     * @param  ConversationSummary $item
     * @return self
     */
    public function setConvItem(ConversationSummary $item): self
    {
        $this->convItem = $item;
        return $this;
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
     * Set wiki item
     * 
     * @param  CommonDocumentInfo $item
     * @return self
     */
    public function setWikiItem(CommonDocumentInfo $item): self
    {
        $this->wikiItem = $item;
        return $this;
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
     * Set doc item
     * 
     * @param  DocumentInfo $item
     * @return self
     */
    public function setDocItem(DocumentInfo $item): self
    {
        $this->docItem = $item;
        return $this;
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
     * Set msg item
     * 
     * @param  MessageSummary $item
     * @return self
     */
    public function setMsgItem(MessageSummary $item): self
    {
        $this->msgItem = $item;
        return $this;
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
     * Set chat item
     * 
     * @param  ChatSummary $item
     * @return self
     */
    public function setChatItem(ChatSummary $item): self
    {
        $this->chatItem = $item;
        return $this;
    }
}
