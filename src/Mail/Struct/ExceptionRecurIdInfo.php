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
use Zimbra\Common\Struct\ExceptionRecurIdInfoInterface;

/**
 * ExceptionRecurIdInfo class
 * Exception recurrence id information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ExceptionRecurIdInfo implements ExceptionRecurIdInfoInterface
{
    /**
     * Date and/or time.  Format is : YYYYMMDD['T'HHMMSS[Z]]
     * where:
     *     YYYY - 4 digit year
     *     MM   - 2 digit month
     *     DD   - 2 digit day
     * Optionally:
     *     'T' the literal char "T" then 
     *     HH - 2 digit hour (00-23)
     *     MM - 2 digit minute (00-59)
     *     SS - 2 digit second (00-59)
     *     ...and finally an optional "Z" meaning that the time is UTC,
     *     otherwise the tz="TIMEZONE" param MUST be specified with the DATETIME
     *     e.g:
     *         20050612  June 12, 2005
     *         20050315T18302305Z  March 15, 2005 6:30:23.05 PM UTC
     * 
     * @var string
     */
    #[Accessor(getter: 'getDateTime', setter: 'setDateTime')]
    #[SerializedName(name: 'd')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $dateTime;

    /**
     * Java timezone identifier
     * 
     * @var string
     */
    #[Accessor(getter: 'getTimezone', setter: 'setTimezone')]
    #[SerializedName(name: 'tz')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $timezone;

    /**
     * Range type - 1 means NONE, 2 means THISANDFUTURE, 3 means THISANDPRIOR
     * 
     * @var int
     */
    #[Accessor(getter: 'getRecurrenceRangeType', setter: 'setRecurrenceRangeType')]
    #[SerializedName(name: 'rangeType')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $recurrenceRangeType;

    /**
     * Constructor
     *
     * @param  string $dateTime
     * @param  string $timezone
     * @param  int $recurrenceRangeType
     * @return self
     */
    public function __construct(
        string $dateTime = '',
        ?string $timezone = NULL,
        ?int $recurrenceRangeType = NULL
    )
    {
        $this->setDateTime($dateTime);
        if (NULL !== $timezone) {
            $this->setTimezone($timezone);
        }
        if (NULL !== $recurrenceRangeType) {
            $this->setRecurrenceRangeType($recurrenceRangeType);
        }
    }

    /**
     * Get recurrenceRangeType
     *
     * @return int
     */
    public function getRecurrenceRangeType(): ?int
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
        $this->recurrenceRangeType = RangeType::tryFrom($rangeType) ? $rangeType : 1;
        return $this;
    }

    /**
     * Get dateTime
     *
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * Set dateTime
     *
     * @param  string $dateTime
     * @return self
     */
    public function setDateTime(string $dateTime): self
    {
        $this->dateTime = $dateTime;
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
}
