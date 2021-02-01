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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Mail\Struct\ChatSummary;
use Zimbra\Mail\Struct\MessageSummary;
use Zimbra\Soap\ResponseInterface;

/**
 * AddMsgResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AddMsgResponse")
 */
class AddMsgResponse implements ResponseInterface
{
    /**
     * Details of added message
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MessageSummary")
     * @XmlElement
     */
    private $message;

    /**
     * Details of added chat message
     * @Accessor(getter="getChatMessage", setter="setMessage")
     * @SerializedName("chat")
     * @Type("Zimbra\Mail\Struct\ChatSummary")
     * @XmlElement
     */
    private $chatMessage;

    /**
     * Constructor method for AddMsgResponse
     *
     * @param  MessageSummary $message
     * @return self
     */
    public function __construct(?MessageSummary $message = NULL)
    {
        if ($message instanceof MessageSummary) {
            $this->setMessage($message);
        }
    }

    /**
     * Sets message
     *
     * @param  MessageSummary $message
     * @return self
     */
    public function setMessage(MessageSummary $message): self
    {
        if ($message instanceof ChatSummary) {
            $this->chatMessage = $message;
            $this->message = NULL;
        }
        else {
            $this->message = $message;
            $this->chatMessage = NULL;
        }
        return $this;
    }

    /**
     * Gets message
     *
     * @return MessageSummary
     */
    public function getMessage(): ?MessageSummary
    {
        return $this->message;
    }

    /**
     * Gets chatMessage
     *
     * @return ChatSummary
     */
    public function getChatMessage(): ?ChatSummary
    {
        return $this->chatMessage;
    }
}
