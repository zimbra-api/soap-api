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
use Zimbra\Mail\Struct\BounceMsgSpec;
use Zimbra\Soap\Request;

/**
 * BounceMsgRequest class
 * Resend a message
 * 
 * Supports (f)rom, (t)o, (c)c, (b)cc, (s)ender "type" on <e> elements
 * (these get mapped to Resent-From, Resent-To, Resent-CC, Resent-Bcc, Resent-Sender headers, which are prepended to
 * copy of existing message)
 * Aside from these prepended headers, message is reinjected verbatim
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="BounceMsgRequest")
 */
class BounceMsgRequest extends Request
{
    /**
     * Specification of message to be resent
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\BounceMsgSpec")
     * @XmlElement
     */
    private $msg;

    /**
     * Constructor method for BounceMsgRequest
     *
     * @param  BounceMsgSpec $msg
     * @return self
     */
    public function __construct(BounceMsgSpec $msg)
    {
        $this->setMsg($msg);
    }

    /**
     * Gets msg
     *
     * @return BounceMsgSpec
     */
    public function getMsg(): BounceMsgSpec
    {
        return $this->msg;
    }

    /**
     * Sets msg
     *
     * @param  BounceMsgSpec $msg
     * @return self
     */
    public function setMsg(BounceMsgSpec $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof BounceMsgEnvelope)) {
            $this->envelope = new BounceMsgEnvelope(
                new BounceMsgBody($this)
            );
        }
    }
}