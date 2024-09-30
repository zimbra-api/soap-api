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
 * CreateAppointmentExceptionRequest class
 * Create Appointment Exception.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateAppointmentExceptionRequest extends CalItemRequestBase
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
     * Component of default invite
     *
     * @Accessor(getter="getNumComponents", setter="setNumComponents")
     * @SerializedName("comp")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getNumComponents", setter: "setNumComponents")]
    #[SerializedName("comp")]
    #[Type("int")]
    #[XmlAttribute]
    private $numComponents;

    /**
     * Change sequence of fetched series
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
     * Revision of fetched series
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
     * Constructor
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
        ?string $id = null,
        ?int $numComponents = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?Msg $msg = null,
        ?bool $echo = null,
        ?int $maxSize = null,
        ?bool $wantHtml = null,
        ?bool $neuter = null,
        ?bool $forceSend = null
    ) {
        parent::__construct(
            $msg,
            $echo,
            $maxSize,
            $wantHtml,
            $neuter,
            $forceSend
        );
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $numComponents) {
            $this->setNumComponents($numComponents);
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
     * Set numComponents
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
     * Get numComponents
     *
     * @return int
     */
    public function getNumComponents(): ?int
    {
        return $this->numComponents;
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
        return new CreateAppointmentExceptionEnvelope(
            new CreateAppointmentExceptionBody($this)
        );
    }
}
