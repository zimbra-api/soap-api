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
use Zimbra\Mail\Struct\{MessageInfo, ChatMessageInfo};
use Zimbra\Common\Struct\SoapResponse;

/**
 * RemoveAttachmentsResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RemoveAttachmentsResponse extends SoapResponse
{
    /**
     * Information about the message
     *
     * @Accessor(getter="getMsgMessage", setter="setMsgMessage")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MessageInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var MessageInfo
     */
    #[Accessor(getter: "getMsgMessage", setter: "setMsgMessage")]
    #[SerializedName("m")]
    #[Type(MessageInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?MessageInfo $msgMessage;

    /**
     * Information about the chat message
     *
     * @Accessor(getter="getChatMessage", setter="setChatMessage")
     * @SerializedName("chat")
     * @Type("Zimbra\Mail\Struct\ChatMessageInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var ChatMessageInfo
     */
    #[Accessor(getter: "getChatMessage", setter: "setChatMessage")]
    #[SerializedName("chat")]
    #[Type(ChatMessageInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?ChatMessageInfo $chatMessage;

    /**
     * Constructor
     *
     * @param  MessageInfo $message
     * @return self
     */
    public function __construct(?MessageInfo $message = null)
    {
        $this->msgMessage = $this->chatMessage = null;
        if (null !== $message) {
            $this->setMessage($message);
        }
    }

    /**
     * Get msg message
     *
     * @return MessageInfo
     */
    public function getMsgMessage(): ?MessageInfo
    {
        return $this->msgMessage;
    }

    /**
     * Set msg message
     *
     * @param  MessageInfo $message
     * @return self
     */
    public function setMsgMessage(MessageInfo $message): self
    {
        $this->msgMessage = $message;
        return $this;
    }

    /**
     * Get chat message
     *
     * @return ChatMessageInfo
     */
    public function getChatMessage(): ?ChatMessageInfo
    {
        return $this->chatMessage;
    }

    /**
     * Set chat message
     *
     * @param  ChatMessageInfo $message
     * @return self
     */
    public function setChatMessage(ChatMessageInfo $message): self
    {
        $this->chatMessage = $message;
        return $this;
    }

    /**
     * Set message
     *
     * @return self
     */
    private function setMessage(MessageInfo $message): self
    {
        if ($message instanceof ChatMessageInfo) {
            $this->chatMessage = $message;
        } else {
            $this->msgMessage = $message;
        }
        return $this;
    }
}
