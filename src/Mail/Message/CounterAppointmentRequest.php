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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CounterAppointmentRequest class
 * Propose a new time/location.  Sent by meeting attendee to organizer.
 * The syntax is very similar to CreateAppointmentRequest.
 * Should include an <inv> element which encodes an iCalendar COUNTER object
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CounterAppointmentRequest extends SoapRequest
{
    /**
     * Invite ID of default invite
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Component number of default component
     * 
     * @var int
     */
    #[Accessor(getter: 'getComponentNum', setter: 'setComponentNum')]
    #[SerializedName(name: 'comp')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $componentNum;

    /**
     * Changed sequence of fetched version.
     * Used for conflict detection.  By setting this, the request indicates which version of the appointment it is
     * attempting to propose.  If the appointment was updated on the server between the fetch and modify, an
     * INVITE_OUT_OF_DATE exception will be thrown.
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
     * Details of counter proposal.
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
     * @param  Msg $msg
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?int $componentNum = NULL,
        ?int $modifiedSequence = NULL,
        ?int $revision = NULL,
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
        return new CounterAppointmentEnvelope(
            new CounterAppointmentBody($this)
        );
    }
}
