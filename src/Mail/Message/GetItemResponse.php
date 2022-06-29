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

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, Type, VirtualProperty, XmlElement};

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
     * Item
     * @Exclude
     */
    private $item;

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
     * @SerializedName("folder")
     * @Type("Zimbra\Mail\Struct\Folder")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getFolderItem(): ?Folder
    {
        return ($this->item instanceof Folder) ? $this->item : NULL;
    }

    /**
     * @SerializedName("tag")
     * @Type("Zimbra\Mail\Struct\TagInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getTagItem(): ?TagInfo
    {
        return ($this->item instanceof TagInfo) ? $this->item : NULL;
    }

    /**
     * @SerializedName("note")
     * @Type("Zimbra\Mail\Struct\NoteInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getNoteIItem(): ?NoteInfo
    {
        return ($this->item instanceof NoteInfo) ? $this->item : NULL;
    }

    /**
     * @SerializedName("cn")
     * @Type("Zimbra\Mail\Struct\YabItemId")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getContactItem(): ?ContactInfo
    {
        return ($this->item instanceof ContactInfo) ? $this->item : NULL;
    }

    /**
     * @SerializedName("appt")
     * @Type("Zimbra\Mail\Struct\CalendarItemInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getApptItem(): ?CalendarItemInfo
    {
        return ($this->item instanceof CalendarItemInfo) ? $this->item : NULL;
    }

    /**
     * @SerializedName("task")
     * @Type("Zimbra\Mail\Struct\TaskItemInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getTaskItem(): ?TaskItemInfo
    {
        return ($this->item instanceof TaskItemInfo) ? $this->item : NULL;
    }

    /**
     * @SerializedName("c")
     * @Type("Zimbra\Mail\Struct\ConversationSummary")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getConvItem(): ?ConversationSummary
    {
        return ($this->item instanceof ConversationSummary) ? $this->item : NULL;
    }

    /**
     * @SerializedName("w")
     * @Type("Zimbra\Mail\Struct\CommonDocumentInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getWikiItem(): ?CommonDocumentInfo
    {
        return ($this->item instanceof CommonDocumentInfo) ? $this->item : NULL;
    }

    /**
     * @SerializedName("doc")
     * @Type("Zimbra\Mail\Struct\DocumentInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getDocItem(): ?DocumentInfo
    {
        return ($this->item instanceof DocumentInfo) ? $this->item : NULL;
    }

    /**
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MessageSummary")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getMsgItem(): ?MessageSummary
    {
        return ($this->item instanceof MessageSummary) ? $this->item : NULL;
    }

    /**
     * @SerializedName("chat")
     * @Type("Zimbra\Mail\Struct\ChatSummary")
     * @XmlElement(namespace="urn:zimbraMail")
     * @VirtualProperty
     */
    public function getChatItem(): ?ChatSummary
    {
        return ($this->item instanceof ChatSummary) ? $this->item : NULL;
    }

    /**
     * Gets item
     *
     * @return mix
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Sets item
     *
     * @param  mix $item
     * @return self
     */
    public function setItem($item): self
    {
        if (is_object($item)) {
            foreach (self::itemTypes() as $type) {
                if (get_class($item) === $type) {
                    $this->item = $item;
                    break;
                }
            }
        }
        return $this;
    }

    public static function itemTypes(): array
    {
        return [
            'folder' => Folder::class,
            'tag' => TagInfo::class,
            'note' => NoteInfo::class,
            'cn' => ContactInfo::class,
            'appt' => CalendarItemInfo::class,
            'task' => TaskItemInfo::class,
            'c' => ConversationSummary::class,
            'w' => CommonDocumentInfo::class,
            'doc' => DocumentInfo::class,
            'm' => MessageSummary::class,
            'chat' => ChatSummary::class,
        ];
    }
}
