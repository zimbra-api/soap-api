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
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Component number of default invite
     * 
     * @var int
     */
    #[Accessor(getter: 'getComponentNum', setter: 'setComponentNum')]
    #[SerializedName(name: 'comp')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $componentNum;

    /**
     * Modified sequence
     * 
     * @var int
     */
    #[Accessor(getter: 'getModifiedSequence', setter: 'setModifiedSequence')]
    #[SerializedName(name: 'ms')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $modifiedSequence;

    /**
     * Revision
     * 
     * @var int
     */
    #[Accessor(getter: 'getRevision', setter: 'setRevision')]
    #[SerializedName(name: 'rev')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $revision;

    /**
     * Instance recurrence ID information
     * 
     * @var InstanceRecurIdInfo
     */
    #[Accessor(getter: "getInstance", setter: "setInstance")]
    #[SerializedName(name: 'inst')]
    #[Type(name: InstanceRecurIdInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $instance;

    /**
     * Definition for TZID referenced by DATETIME in instance
     * 
     * @var CalTZInfo
     */
    #[Accessor(getter: "getTimezone", setter: "setTimezone")]
    #[SerializedName(name: 'tz')]
    #[Type(name: CalTZInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $timezone;

    /**
     * Message
     * 
     * @var Msg
     */
    #[Accessor(getter: "getMsg", setter: "setMsg")]
    #[SerializedName(name: 'm')]
    #[Type(name: Msg::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $msg;

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
        ?string $id = NULL,
        ?int $componentNum = NULL,
        ?int $modifiedSequence = NULL,
        ?int $revision = NULL,
        ?InstanceRecurIdInfo $instance = NULL,
        ?CalTZInfo $timezone = NULL,
        ?Msg $msg = NULL
    )
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $componentNum) {
            $this->setComponentNum($componentNum);
        }
        if (NULL !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (NULL !== $revision) {
            $this->setRevision($revision);
        }
        if ($instance instanceof InstanceRecurIdInfo) {
            $this->setInstance($instance);
        }
        if ($timezone instanceof CalTZInfo) {
            $this->setTimezone($timezone);
        }
        if ($msg instanceof Msg) {
            $this->setMsg($msg);
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
        return new CancelAppointmentEnvelope(
            new CancelAppointmentBody($this)
        );
    }
}
