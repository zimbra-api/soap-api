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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Soap\Request;

/**
 * CompleteTaskInstanceRequest class
 * Complete a task instance
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CompleteTaskInstanceRequest")
 */
class CompleteTaskInstanceRequest extends Request
{
    /**
     * ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Exception ID
     * @Accessor(getter="getExceptionId", setter="setExceptionId")
     * @SerializedName("exceptId")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement
     */
    private $exceptionId;

    /**
     * Timezone information
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("tz")
     * @Type("Zimbra\Mail\Struct\CalTZInfo")
     * @XmlElement
     */
    private $timezone;

    /**
     * Constructor method for CompleteTaskInstanceRequest
     *
     * @param  string $id
     * @param  DtTimeInfo $exceptionId
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function __construct(
        string $id,
        DtTimeInfo $exceptionId,
        ?CalTZInfo $timezone = NULL
    )
    {
        $this->setId($id)
             ->setExceptionId($exceptionId);
        if (NULL !== $timezone) {
            $this->setTimezone($timezone);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
     * Gets exceptionId
     *
     * @return DtTimeInfo
     */
    public function getExceptionId(): DtTimeInfo
    {
        return $this->exceptionId;
    }

    /**
     * Sets exceptionId
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
     * Gets timezone
     *
     * @return CalTZInfo
     */
    public function getTimezone(): ?CalTZInfo
    {
        return $this->timezone;
    }

    /**
     * Sets timezone
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CompleteTaskInstanceEnvelope)) {
            $this->envelope = new CompleteTaskInstanceEnvelope(
                new CompleteTaskInstanceBody($this)
            );
        }
    }
}
