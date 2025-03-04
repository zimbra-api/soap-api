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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Mail\Struct\Msg;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ForwardAppointmentInviteRequest class
 * Used by an attendee to forward an appointment invite email to another user who is not already an attendee.
 * To forward an appointment item, use ForwardAppointmentRequest instead.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ForwardAppointmentInviteRequest extends SoapRequest
{
    /**
     * Invite message item ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $id = null;

    /**
     * Details of the invite
     *
     * @var Msg
     */
    #[Accessor(getter: "getMsg", setter: "setMsg")]
    #[SerializedName("m")]
    #[Type(Msg::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?Msg $msg;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  Msg $msg
     * @return self
     */
    public function __construct(?string $id = null, ?Msg $msg = null)
    {
        $this->msg = $msg;
        if (null !== $id) {
            $this->setId($id);
        }
    }

    /**
     * Set msg
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
     * Get msg
     *
     * @return Msg
     */
    public function getMsg(): ?Msg
    {
        return $this->msg;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ForwardAppointmentInviteEnvelope(
            new ForwardAppointmentInviteBody($this)
        );
    }
}
