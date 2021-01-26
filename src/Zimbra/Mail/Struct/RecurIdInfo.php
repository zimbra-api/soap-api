<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

use Zimbra\Struct\RecurIdInfoInterface;

/**
 * RecurIdInfo class
 * Recurrence ID Information
 *
 * @package   Zimbra
 * @subpackage Mail
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="recurId")
 */
class RecurIdInfo implements RecurIdInfoInterface
{
    /**
     * Recurrence range type
     * @Accessor(getter="getRecurrenceRangeType", setter="setRecurrenceRangeType")
     * @SerializedName("rangeType")
     * @Type("integer")
     * @XmlAttribute
     */
    private $recurrenceRangeType;

    /**
     * Recurrence ID in format : YYMMDD[THHMMSS[Z]]
     * @Accessor(getter="getRecurrenceId", setter="setRecurrenceId")
     * @SerializedName("recurId")
     * @Type("string")
     * @XmlAttribute
     */
    private $recurrenceId;

    /**
     * Timezone name
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("tz")
     * @Type("string")
     * @XmlAttribute
     */
    private $timezone;

    /**
     * Recurrence-id in UTC time zone; used in non-all-day appointments only
     * Format: YYMMDDTHHMMSSZ
     * @Accessor(getter="getRecurIdZ", setter="setRecurIdZ")
     * @SerializedName("ridZ")
     * @Type("string")
     * @XmlAttribute
     */
    private $recurIdZ;

    /**
     * Constructor method for RecurIdInfo
     *
     * @param  int $recurrenceRangeType
     * @param  string $recurrenceId
     * @param  string $timezone
     * @param  string $recurIdZ
     * @return self
     */
    public function __construct(
        int $recurrenceRangeType,
        string $recurrenceId,
        ?string $timezone = NULL,
        ?string $recurIdZ = NULL
    )
    {
        $this->setRecurrenceRangeType($recurrenceRangeType)
             ->setRecurrenceId($recurrenceId);
        if (NULL !== $timezone) {
            $this->setTimezone($timezone);
        }
        if (NULL !== $recurIdZ) {
            $this->setRecurIdZ($recurIdZ);
        }
    }

    /**
     * Gets recurrenceRangeType
     *
     * @return int
     */
    public function getRecurrenceRangeType(): int
    {
        return $this->recurrenceRangeType;
    }

    /**
     * Sets recurrenceRangeType
     *
     * @param  int $recurrenceRangeType
     * @return self
     */
    public function setRecurrenceRangeType(int $recurrenceRangeType): self
    {
        $this->recurrenceRangeType = $recurrenceRangeType;
        return $this;
    }

    /**
     * Gets recurrenceId
     *
     * @return string
     */
    public function getRecurrenceId(): string
    {
        return $this->recurrenceId;
    }

    /**
     * Sets recurrenceId
     *
     * @param  string $recurrenceId
     * @return self
     */
    public function setRecurrenceId(string $recurrenceId): self
    {
        $this->recurrenceId = $recurrenceId;
        return $this;
    }

    /**
     * Gets timezone
     *
     * @return string
     */
    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    /**
     * Sets timezone
     *
     * @param  string $timezone
     * @return self
     */
    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Gets recurIdZ
     *
     * @return string
     */
    public function getRecurIdZ(): ?string
    {
        return $this->recurIdZ;
    }

    /**
     * Sets recurIdZ
     *
     * @param  string $recurIdZ
     * @return self
     */
    public function setRecurIdZ(string $recurIdZ): self
    {
        $this->recurIdZ = $recurIdZ;
        return $this;
    }
}
