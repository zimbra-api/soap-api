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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Mail\Struct\{CalItemRequestBase, Msg};
use Zimbra\Common\Struct\SoapEnvelopeInterface;

/**
 * ModifyAppointmentRequest class
 * Modify an appointment, or if the appointment is a recurrence then modify the "default"
 * invites. That is, all instances that do not have exceptions.
 * If the appointment has a <recur>, then the following caveats are worth mentioning:
 * If any of: START, DURATION, END or RECUR change, then all exceptions are implicitly canceled!
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyAppointmentRequest extends CalItemRequestBase
{
    /**
     * Invite ID of default invite
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Component number of default component
     * 
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("comp")
     * @Type("integer")
     * @XmlAttribute
     */
    private $componentNum;

    /**
     * Changed sequence of fetched version.
     * Used for conflict detection. By setting this, the request indicates which version of the appointment it is
     * attempting to modify.  If the appointment was updated on the server between the fetch and modify, an
     * INVITE_OUT_OF_DATE exception will be thrown.
     * 
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("integer")
     * @XmlAttribute
     */
    private $modifiedSequence;

    /**
     * Revision
     * 
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("integer")
     * @XmlAttribute
     */
    private $revision;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  int $componentNum
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  Msg $msg
     * @param  bool $echo
     * @param  int $maxSize
     * @param  bool $wantHtml
     * @param  bool $neuter
     * @param  bool $forceSend
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?int $componentNum = NULL,
        ?int $modifiedSequence = NULL,
        ?int $revision = NULL,
        ?Msg $msg = NULL,
        ?bool $echo = NULL,
        ?int $maxSize = NULL,
        ?bool $wantHtml = NULL,
        ?bool $neuter = NULL,
        ?bool $forceSend = NULL
    )
    {
        parent::__construct(
            $msg,
            $echo,
            $maxSize,
            $wantHtml,
            $neuter,
            $forceSend
        );
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyAppointmentEnvelope(
            new ModifyAppointmentBody($this)
        );
    }
}
