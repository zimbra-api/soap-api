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
use Zimbra\Mail\Struct\{CalTZInfo, InstanceRecurIdInfo, Msg};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CancelAppointmentRequest class
 * Cancel appointment
 * NOTE: If canceling an exception, the original instance (ie the one the exception was "excepting") WILL NOT be
 * restored when you cancel this exception.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CancelAppointmentRequest extends SoapRequest
{
    /**
     * ID of default invite
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Component number of default invite
     *
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("comp")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getComponentNum", setter: "setComponentNum")]
    #[SerializedName("comp")]
    #[Type("int")]
    #[XmlAttribute]
    private $componentNum;

    /**
     * Modified sequence
     *
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getModifiedSequence", setter: "setModifiedSequence")]
    #[SerializedName("ms")]
    #[Type("int")]
    #[XmlAttribute]
    private $modifiedSequence;

    /**
     * Revision
     *
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getRevision", setter: "setRevision")]
    #[SerializedName("rev")]
    #[Type("int")]
    #[XmlAttribute]
    private $revision;

    /**
     * Instance recurrence ID information
     *
     * @Accessor(getter="getInstance", setter="setInstance")
     * @SerializedName("inst")
     * @Type("Zimbra\Mail\Struct\InstanceRecurIdInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var InstanceRecurIdInfo
     */
    #[Accessor(getter: "getInstance", setter: "setInstance")]
    #[SerializedName("inst")]
    #[Type(InstanceRecurIdInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?InstanceRecurIdInfo $instance;

    /**
     * Definition for TZID referenced by DATETIME in instance
     *
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("tz")
     * @Type("Zimbra\Mail\Struct\CalTZInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var CalTZInfo
     */
    #[Accessor(getter: "getTimezone", setter: "setTimezone")]
    #[SerializedName("tz")]
    #[Type(CalTZInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?CalTZInfo $timezone;

    /**
     * Message
     *
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\Msg")
     * @XmlElement(namespace="urn:zimbraMail")
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
     * @param  int $componentNum
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  InstanceRecurIdInfo $instance
     * @param  CalTZInfo $timezone
     * @param  Msg $msg
     * @return self
     */
    public function __construct(
        ?string $id = null,
        ?int $componentNum = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?InstanceRecurIdInfo $instance = null,
        ?CalTZInfo $timezone = null,
        ?Msg $msg = null
    ) {
        $this->instance = $instance;
        $this->timezone = $timezone;
        $this->msg = $msg;
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $componentNum) {
            $this->setComponentNum($componentNum);
        }
        if (null !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (null !== $revision) {
            $this->setRevision($revision);
        }
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
     * Set componentNum
     *
     * @param  int $componentNum
     * @return self
     */
    public function setComponentNum(int $componentNum): self
    {
        $this->componentNum = $componentNum;
        return $this;
    }

    /**
     * Get componentNum
     *
     * @return int
     */
    public function getComponentNum(): ?int
    {
        return $this->componentNum;
    }

    /**
     * Set modifiedSequence
     *
     * @param  int $modifiedSequence
     * @return self
     */
    public function setModifiedSequence(int $modifiedSequence): self
    {
        $this->modifiedSequence = $modifiedSequence;
        return $this;
    }

    /**
     * Get modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Set revision
     *
     * @param  int $revision
     * @return self
     */
    public function setRevision(int $revision): self
    {
        $this->revision = $revision;
        return $this;
    }

    /**
     * Get revision
     *
     * @return int
     */
    public function getRevision(): ?int
    {
        return $this->revision;
    }

    /**
     * Set instance
     *
     * @param  InstanceRecurIdInfo $instance
     * @return self
     */
    public function setInstance(InstanceRecurIdInfo $instance): self
    {
        $this->instance = $instance;
        return $this;
    }

    /**
     * Get instance
     *
     * @return InstanceRecurIdInfo
     */
    public function getInstance(): ?InstanceRecurIdInfo
    {
        return $this->instance;
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CancelAppointmentEnvelope(new CancelAppointmentBody($this));
    }
}
