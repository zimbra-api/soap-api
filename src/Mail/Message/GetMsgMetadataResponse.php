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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\{ChatSummary, MessageSummary};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetMsgMetadataResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMsgMetadataResponse extends SoapResponse
{
    /**
     * Chat message metadata
     * 
     * @var array
     */
    #[Accessor(getter: 'getChatMessages', setter: 'setChatMessages')]
    #[Type(name: 'array<Zimbra\Mail\Struct\ChatSummary>')]
    #[XmlList(inline: true, entry: 'chat', namespace: 'urn:zimbraMail')]
    private $chatMessages = [];

    /**
     * Message metadata
     * 
     * @var array
     */
    #[Accessor(getter: 'getMsgMessages', setter: 'setMsgMessages')]
    #[Type(name: 'array<Zimbra\Mail\Struct\MessageSummary>')]
    #[XmlList(inline: true, entry: 'm', namespace: 'urn:zimbraMail')]
    private $msgMessages = [];

    /**
     * Constructor
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
     * Set chatMessages
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
     * Get chatMessages
     *
     * @return array
     */
    public function getChatMessages(): array
    {
        return $this->chatMessages;
    }

    /**
     * Set msgMessages
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
     * Get msgMessages
     *
     * @return array
     */
    public function getMsgMessages(): array
    {
        return $this->msgMessages;
    }
}
