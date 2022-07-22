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
use Zimbra\Common\Soap\EnvelopeInterface;

/**
 * CreateAppointmentExceptionRequest class
 * Create Appointment Exception.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateAppointmentExceptionRequest extends CalItemRequestBase
{
    /**
     * ID of default invite
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Component of default invite
     * @Accessor(getter="getNumComponents", setter="setNumComponents")
     * @SerializedName("comp")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numComponents;

    /**
     * Change sequence of fetched series
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("integer")
     * @XmlAttribute
     */
    private $modifiedSequence;

    /**
     * Revision of fetched series
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("integer")
     * @XmlAttribute
     */
    private $revision;

    /**
     * Constructor method for CreateAppointmentExceptionRequest
     *
     * @param  string $id
     * @param  int $numComponents
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
        ?int $numComponents = NULL,
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
        parent::__construct($msg, $echo, $maxSize, $wantHtml, $neuter, $forceSend);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $numComponents) {
            $this->setNumComponents($numComponents);
        }
        if (NULL !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (NULL !== $revision) {
            $this->setRevision($revision);
        }
    }

    /**
     * Sets id
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
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets numComponents
     *
     * @param  int $numComponents
     * @return self
     */
    public function setNumComponents(int $numComponents): self
    {
        $this->numComponents = $numComponents;
        return $this;
    }

    /**
     * Gets numComponents
     *
     * @return int
     */
    public function getNumComponents(): ?int
    {
        return $this->numComponents;
    }

    /**
     * Sets modifiedSequence
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
     * Gets modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Sets revision
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
     * Gets revision
     *
     * @return int
     */
    public function getRevision(): ?int
    {
        return $this->revision;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new CreateAppointmentExceptionEnvelope(
            new CreateAppointmentExceptionBody($this)
        );
    }
}
