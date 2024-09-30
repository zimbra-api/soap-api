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
use Zimbra\Mail\Struct\MsgSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetMsgRequest class
 * Get Message
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMsgRequest extends SoapRequest
{
    /**
     * Message specification
     *
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MsgSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var MsgSpec
     */
    #[Accessor(getter: "getMsg", setter: "setMsg")]
    #[SerializedName("m")]
    #[Type(MsgSpec::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private MsgSpec $msg;

    /**
     * Constructor
     *
     * @param  MsgSpec $msg
     * @return self
     */
    public function __construct(MsgSpec $msg)
    {
        $this->setMsg($msg);
    }

    /**
     * Get msg
     *
     * @return MsgSpec
     */
    public function getMsg(): MsgSpec
    {
        return $this->msg;
    }

    /**
     * Set msg
     *
     * @param  MsgSpec $msg
     * @return self
     */
    public function setMsg(MsgSpec $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetMsgEnvelope(new GetMsgBody($this));
    }
}
