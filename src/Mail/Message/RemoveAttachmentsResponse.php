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

use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * RemoveAttachmentsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RemoveAttachmentsResponse implements SoapResponseInterface
{
    /**
     * Information about the message
     * 
     * @Accessor(getter="getMsgMessage", setter="setMessage")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MessageInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MessageInfo $msgMessage = NULL;

    /**
     * Information about the chat message
     * 
     * @Accessor(getter="getChatMessage", setter="setMessage")
     * @SerializedName("chat")
     * @Type("Zimbra\Mail\Struct\ChatMessageInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ChatMessageInfo $chatMessage = NULL;

    /**
     * Constructor method for RemoveAttachmentsResponse
     *
     * @param  mix $message
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
     * Get chat message
     * 
     * @return ChatMessageInfo
     */
    public function getChatMessage(): ?ChatMessageInfo
    {
        return $this->chatMessage;
    }

    /**
     * Set message
     * 
     * @return self
     */
    public function setMessage(MessageInfo $message): self
    {
        $this->msgMessage =
        $this->chatMessage = NULL;

        if (get_class($message) === MessageInfo::class) {
            $this->msgMessage = $message;
        }
        if ($message instanceof ChatMessageInfo) {
            $this->chatMessage = $message;
        }
        return $this;
    }
}
