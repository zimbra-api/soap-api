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
use Zimbra\Mail\Struct\ConversationSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetConvRequest class
 * Get Conversation
 *
 * GetConvRequest gets information about the 1 conversation named by id's value.
 * It will return exactly 1 conversation element.
 *
 * If fetch="1|all" is included, the full expanded message structure is inlined for the first (or for all) messages
 * in the conversation.  If fetch="{item-id}", only the message with the given {item-id} is expanded inline.
 *
 * if headers are requested, any matching headers are inlined into the response (not available when raw="1")
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetConvRequest extends SoapRequest
{
    /**
     * Conversation specification
     *
     * @var ConversationSpec
     */
    #[Accessor(getter: "getConversation", setter: "setConversation")]
    #[SerializedName("c")]
    #[Type(ConversationSpec::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ConversationSpec $conversation;

    /**
     * Constructor
     *
     * @param  ConversationSpec $conversation
     * @return self
     */
    public function __construct(ConversationSpec $conversation)
    {
        $this->setConversation($conversation);
    }

    /**
     * Get conversation
     *
     * @return ConversationSpec
     */
    public function getConversation(): ConversationSpec
    {
        return $this->conversation;
    }

    /**
     * Set conversation
     *
     * @param  ConversationSpec $conversation
     * @return self
     */
    public function setConversation(ConversationSpec $conversation): self
    {
        $this->conversation = $conversation;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetConvEnvelope(new GetConvBody($this));
    }
}
