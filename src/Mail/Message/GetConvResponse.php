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
use Zimbra\Mail\Struct\ConversationInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetConvResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetConvResponse extends SoapResponse
{
    /**
     * Conversation information
     *
     * @var ConversationInfo
     */
    #[Accessor(getter: "getConversation", setter: "setConversation")]
    #[SerializedName("c")]
    #[Type(ConversationInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?ConversationInfo $conversation;

    /**
     * Constructor
     *
     * @param  ConversationInfo $conversation
     * @return self
     */
    public function __construct(?ConversationInfo $conversation = null)
    {
        $this->conversation = $conversation;
    }

    /**
     * Get conversation
     *
     * @return ConversationInfo
     */
    public function getConversation(): ?ConversationInfo
    {
        return $this->conversation;
    }

    /**
     * Set conversation
     *
     * @param  ConversationInfo $conversation
     * @return self
     */
    public function setConversation(ConversationInfo $conversation): self
    {
        $this->conversation = $conversation;
        return $this;
    }
}
