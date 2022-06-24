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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Mail\Struct\{ChatSummary, MessageSummary};
use Zimbra\Soap\ResponseInterface;

/**
 * GetMsgMetadataResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetMsgMetadataResponse implements ResponseInterface
{
    /**
     * Chat message metadata
     * 
     * @Accessor(getter="getChatMessages", setter="setChatMessages")
     * @SerializedName("chat")
     * @Type("array<Zimbra\Mail\Struct\ChatSummary>")
     * @XmlList(inline = true, entry = "chat")
     */
    private $chatMessages = [];

    /**
     * Message metadata
     * 
     * @Accessor(getter="getMsgMessages", setter="setMsgMessages")
     * @SerializedName("m")
     * @Type("array<Zimbra\Mail\Struct\MessageSummary>")
     * @XmlList(inline = true, entry = "m")
     */
    private $msgMessages = [];

    /**
     * Constructor method for GetMsgMetadataResponse
     *
     * @param  array $chatMessages
     * @param  array $msgMessages
     * @return self
     */
    public function __construct(array $chatMessages = [], array $msgMessages = [])
    {
        $this->setChatMessages($chatMessages)
             ->setMsgMessages($msgMessages);
    }

    /**
     * Add chat message
     *
     * @param  ChatMessage $msg
     * @return self
     */
    public function addChatMessage(ChatSummary $msg): self
    {
        $this->chatMessages[] = $msg;
        return $this;
    }

    /**
     * Sets chatMessages
     *
     * @param  array $messages
     * @return self
     */
    public function setChatMessages(array $messages): self
    {
        $this->chatMessages = array_filter($messages, static fn ($msg) => $msg instanceof ChatSummary);
        return $this;
    }

    /**
     * Gets chatMessages
     *
     * @return array
     */
    public function getChatMessages(): array
    {
        return $this->chatMessages;
    }

    /**
     * Add msg message
     *
     * @param  MessageSummary $msg
     * @return self
     */
    public function addMsgMessage(MessageSummary $msg): self
    {
        $this->msgMessages[] = $msg;
        return $this;
    }

    /**
     * Sets msgMessages
     *
     * @param  array $messages
     * @return self
     */
    public function setMsgMessages(array $messages): self
    {
        $this->msgMessages = array_filter($messages, static fn ($msg) => $msg instanceof MessageSummary);
        return $this;
    }

    /**
     * Gets msgMessages
     *
     * @return array
     */
    public function getMsgMessages(): array
    {
        return $this->msgMessages;
    }
}
