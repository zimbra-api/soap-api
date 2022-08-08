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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\RangeType;
use Zimbra\Common\Struct\RecurIdInfoInterface;

/**
 * RecurIdInfo class
 * Recurrence ID Information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RecurIdInfo implements RecurIdInfoInterface
{
    /**
     * Recurrence range type
     * 
     * @Accessor(getter="getRecurrenceRangeType", setter="setRecurrenceRangeType")
     * @SerializedName("rangeType")
     * @Type("integer")
     * @XmlAttribute
     */
    private $recurrenceRangeType;

    /**
     * Recurrence ID in format : YYMMDD[THHMMSS[Z]]
     * 
     * @Accessor(getter="getRecurrenceId", setter="setRecurrenceId")
     * @SerializedName("recurId")
     * @Type("string")
     * @XmlAttribute
     */
    private $recurrenceId;

    /**
     * Timezone name
     * 
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("tz")
     * @Type("string")
     * @XmlAttribute
     */
    private $timezone;

    /**
     * Recurrence-id in UTC time zone; used in non-all-day appointments only
     * 
     * Format: YYMMDDTHHMMSSZ
     * @Accessor(getter="getRecurIdZ", setter="setRecurIdZ")
     * @SerializedName("ridZ")
     * @Type("string")
     * @XmlAttribute
     */
    private $recurIdZ;

    /**
     * Constructor
     *
     * @param  int $recurrenceRangeType
     * @param  string $recurrenceId
     * @param  string $timezone
     * @param  string $recurIdZ
     * @return self
     */
    public function __construct(
        int $recurrenceRangeType = 0,
        string $recurrenceId = '',
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
     * Get recurrenceRangeType
     *
     * @return int
     */
    public function getRecurrenceRangeType(): int
    {
        return $this->recurrenceRangeType;
    }

    /**
     * Set recurrenceRangeType
     *
     * @param  int $rangeType
     * @return self
     */
    public function setRecurrenceRangeType(int $rangeType): self
    {
        $this->recurrenceRangeType = RangeType::isValid($rangeType) ? $rangeType : 1;
        return $this;
    }

    /**
     * Get recurrenceId
     *
     * @return string
     */
    public function getRecurrenceId(): string
    {
        return $this->recurrenceId;
    }

    /**
     * Set recurrenceId
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
     * Get timezone
     *
     * @return string
     */
    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    /**
     * Set timezone
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
     * Get recurIdZ
     *
     * @return string
     */
    public function getRecurIdZ(): ?string
    {
        return $this->recurIdZ;
    }

    /**
     * Set recurIdZ
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
