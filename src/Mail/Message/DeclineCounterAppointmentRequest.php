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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\Msg;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * DeclineCounterAppointmentRequest class
 * Add a message
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeclineCounterAppointmentRequest extends Request
{
    /**
     * Details of the Decline Counter.
     * Should have an <inv> which encodes an iCalendar DECLINECOUNTER object
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\Msg")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?Msg $msg = NULL;

    /**
     * Constructor method for DeclineCounterAppointmentRequest
     *
     * @param  Msg $msg
     * @return self
     */
    public function __construct(?Msg $msg = NULL)
    {
        if ($msg instanceof Msg) {
            $this->setMsg($msg);
        }
    }

    /**
     * Sets msg
     *
     * @param  Msg $msg
     * @return self
     */
    public function setMsg(Msg $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Gets msg
     *
     * @return Msg
     */
    public function getMsg(): ?Msg
    {
        return $this->msg;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new DeclineCounterAppointmentEnvelope(
            new DeclineCounterAppointmentBody($this)
        );
    }
}
