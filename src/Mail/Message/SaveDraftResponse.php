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
    MessageInfo,
    ChatMessageInfo
};

use Zimbra\Common\Struct\SoapResponse;

/**
 * SaveDraftResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SaveDraftResponse extends SoapResponse
{
    /**
     * Information on saved draft
     * 
     * @var MessageInfo
     */
    #[Accessor(getter: "getMsgMessage", setter: "setMsgMessage")]
    #[SerializedName(name: 'm')]
    #[Type(name: MessageInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $msgMessage;

    /**
     * Information on saved chat draft
     * 
     * @var ChatMessageInfo
     */
    #[Accessor(getter: "getChatMessage", setter: "setChatMessage")]
    #[SerializedName(name: 'chat')]
    #[Type(name: ChatMessageInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $chatMessage;

    /**
     * Constructor
     *
     * @param  MessageInfo $message
     * @return self
     */
    public function __construct(?MessageInfo $message = NULL)
    {
        if (NULL !== $message) {
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
        }
        else {
            $this->msgMessage = $message;
        }
        return $this;
    }
}
