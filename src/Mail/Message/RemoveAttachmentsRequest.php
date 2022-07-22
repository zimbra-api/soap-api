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
use Zimbra\Mail\Struct\MsgPartIds;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * RemoveAttachmentsRequest class
 * Remove attachments from a message body
 * NOTE: that this operation is effectively a create and a delete, and thus the message's item ID will change
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RemoveAttachmentsRequest extends Request
{
    /**
     * Specification of parts to remove
     * 
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MsgPartIds")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private MsgPartIds $msg;

    /**
     * Constructor method for RemoveAttachmentsRequest
     *
     * @param  MsgPartIds $msg
     * @return self
     */
    public function __construct(MsgPartIds $msg)
    {
        $this->setMsg($msg);
    }

    /**
     * Gets msg
     *
     * @return MsgPartIds
     */
    public function getMsg(): MsgPartIds
    {
        return $this->msg;
    }

    /**
     * Sets msg
     *
     * @param  MsgPartIds $msg
     * @return self
     */
    public function setMsg(MsgPartIds $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RemoveAttachmentsEnvelope(
            new RemoveAttachmentsBody($this)
        );
    }
}
