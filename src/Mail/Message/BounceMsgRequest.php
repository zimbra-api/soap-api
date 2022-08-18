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
use Zimbra\Mail\Struct\BounceMsgSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BounceMsgRequest extends SoapRequest
{
    /**
     * Specification of message to be resent
     * 
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\BounceMsgSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var BounceMsgSpec
     */
    #[Accessor(getter: "getMsg", setter: "setMsg")]
    #[SerializedName('m')]
    #[Type(BounceMsgSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $msg;

    /**
     * Constructor
     *
     * @param  BounceMsgSpec $msg
     * @return self
     */
    public function __construct(BounceMsgSpec $msg)
    {
        $this->setMsg($msg);
    }

    /**
     * Get msg
     *
     * @return BounceMsgSpec
     */
    public function getMsg(): BounceMsgSpec
    {
        return $this->msg;
    }

    /**
     * Set msg
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new BounceMsgEnvelope(
            new BounceMsgBody($this)
        );
    }
}
