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
use Zimbra\Mail\Struct\{CalTZInfo, DtTimeInfo, Msg};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ForwardAppointmentRequest class
 * Used by an attendee to forward an instance or entire appointment to another user who is not already an attendee.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ForwardAppointmentRequest extends SoapRequest
{
    /**
     * Appointment item ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * RECURRENCE-ID information if forwarding a single instance of a recurring appointment
     * 
     * @var DtTimeInfo
     */
    #[Accessor(getter: 'getExceptionId', setter: 'setExceptionId')]
    #[SerializedName('exceptId')]
    #[Type(DtTimeInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?DtTimeInfo $exceptionId;

    /**
     * Definition for TZID referenced by DATETIME in <exceptId>
     * 
     * @var CalTZInfo
     */
    #[Accessor(getter: 'getTimezone', setter: 'setTimezone')]
    #[SerializedName('tz')]
    #[Type(CalTZInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?CalTZInfo $timezone;

    /**
     * Details of the appointment
     * 
     * @var Msg
     */
    #[Accessor(getter: 'getMsg', setter: 'setMsg')]
    #[SerializedName('m')]
    #[Type(Msg::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?Msg $msg;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  DtTimeInfo $exceptionId
     * @param  CalTZInfo $timezone
     * @param  Msg $msg
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?DtTimeInfo $exceptionId = NULL,
        ?CalTZInfo $timezone = NULL,
        ?Msg $msg = NULL
    )
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        $this->exceptionId = $exceptionId;
        $this->timezone = $timezone;
        $this->msg = $msg;
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
     * Set exceptionId
     *
     * @param  DtTimeInfo $exceptionId
     * @return self
     */
    public function setExceptionId(DtTimeInfo $exceptionId): self
    {
        $this->exceptionId = $exceptionId;
        return $this;
    }

    /**
     * Get exceptionId
     *
     * @return DtTimeInfo
     */
    public function getExceptionId(): ?DtTimeInfo
    {
        return $this->exceptionId;
    }

    /**
     * Set timezone
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function setTimezone(CalTZInfo $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Get timezone
     *
     * @return CalTZInfo
     */
    public function getTimezone(): ?CalTZInfo
    {
        return $this->timezone;
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
        return new ForwardAppointmentEnvelope(
            new ForwardAppointmentBody($this)
        );
    }
}
