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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetICalRequest class
 *
 * Retrieve the unparsed (but XML-encoded) iCalendar data for an Invite
 * This is intended for interfacing with 3rd party programs
 * If <id> attribute specified, gets the iCalendar representation for one invite
 * If <id> attribute is not specified, then start/end MUST be, Calendar data is returned for entire specified range
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetICalRequest extends SoapRequest
{
    /**
     * If specified, gets the iCalendar representation for one invite
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
     * Range start in milliseconds
     *
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getStartTime", setter: "setStartTime")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private $startTime;

    /**
     * Range end in milliseconds
     *
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getEndTime", setter: "setEndTime")]
    #[SerializedName("e")]
    #[Type("int")]
    #[XmlAttribute]
    private $endTime;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  int $startTime
     * @param  int $endTime
     * @return self
     */
    public function __construct(
        ?string $id = null,
        ?int $startTime = null,
        ?int $endTime = null
    ) {
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $startTime) {
            $this->setStartTime($startTime);
        }
        if (null !== $endTime) {
            $this->setEndTime($endTime);
        }
    }

    /**
     * Get startTime
     *
     * @return int
     */
    public function getStartTime(): ?int
    {
        return $this->startTime;
    }

    /**
     * Set startTime
     *
     * @param  int $startTime
     * @return self
     */
    public function setStartTime(int $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Get endTime
     *
     * @return int
     */
    public function getEndTime(): ?int
    {
        return $this->endTime;
    }

    /**
     * Set endTime
     *
     * @param  int $endTime
     * @return self
     */
    public function setEndTime(int $endTime): self
    {
        $this->endTime = $endTime;
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetICalEnvelope(new GetICalBody($this));
    }
}
