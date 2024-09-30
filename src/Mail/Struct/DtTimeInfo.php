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
use Zimbra\Common\Struct\DtTimeInfoInterface;

/**
 * DtTimeInfo struct class
 * Date/time information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DtTimeInfo implements DtTimeInfoInterface
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
     * @Accessor(getter="getDateTime", setter="setDateTime")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getDateTime", setter: "setDateTime")]
    #[SerializedName("d")]
    #[Type("string")]
    #[XmlAttribute]
    private $dateTime;

    /**
     * Java timezone identifier
     *
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("tz")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getTimezone", setter: "setTimezone")]
    #[SerializedName("tz")]
    #[Type("string")]
    #[XmlAttribute]
    private $timezone;

    /**
     * UTC time as milliseconds since the epoch.  Set if non-all-day
     *
     * @Accessor(getter="getUtcTime", setter="setUtcTime")
     * @SerializedName("u")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getUtcTime", setter: "setUtcTime")]
    #[SerializedName("u")]
    #[Type("int")]
    #[XmlAttribute]
    private $utcTime;

    /**
     * Constructor
     *
     * @param string $dateTime
     * @param string $timezone
     * @param int $utcTime
     * @return self
     */
    public function __construct(
        ?string $dateTime = null,
        ?string $timezone = null,
        ?int $utcTime = null
    ) {
        if (null !== $dateTime) {
            $this->setDateTime($dateTime);
        }
        if (null !== $timezone) {
            $this->setTimezone($timezone);
        }
        if (null !== $utcTime) {
            $this->setUtcTime($utcTime);
        }
    }

    /**
     * Get the dateTime
     *
     * @return string
     */
    public function getDateTime(): ?string
    {
        return $this->dateTime;
    }

    /**
     * Set the dateTime
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
     * Get the timezone
     *
     * @return string
     */
    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    /**
     * Set the timezone
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
     * Get the utcTime
     *
     * @return int
     */
    public function getUtcTime(): ?int
    {
        return $this->utcTime;
    }

    /**
     * Set the utcTime
     *
     * @param  int $utcTime
     * @return self
     */
    public function setUtcTime(int $utcTime): self
    {
        $this->utcTime = $utcTime;
        return $this;
    }
}
