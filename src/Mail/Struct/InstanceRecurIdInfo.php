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

/**
 * InstanceRecurIdInfo class
 * Instance recurrence ID information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="inst")
 */
class InstanceRecurIdInfo
{
    /**
     * Range - THISANDFUTURE|THISANDPRIOR
     * @Accessor(getter="getRange", setter="setRange")
     * @SerializedName("range")
     * @Type("string")
     * @XmlAttribute
     */
    private $range;

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
     * @Accessor(getter="getDateTime", setter="setDateTime")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $dateTime;

    /**
     * Java timezone identifier
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("tz")
     * @Type("string")
     * @XmlAttribute
     */
    private $timezone;

    /**
     * Constructor method for InstanceRecurIdInfo
     *
     * @param  string $dateTime
     * @param  string $timezone
     * @param  string $range
     * @return self
     */
    public function __construct(
        ?string $range = NULL,
        ?string $dateTime = NULL,
        ?string $timezone = NULL
    )
    {
        if (NULL !== $range) {
            $this->setRange($range);
        }
        if (NULL !== $dateTime) {
            $this->setDateTime($dateTime);
        }
        if (NULL !== $timezone) {
            $this->setTimezone($timezone);
        }
    }

    /**
     * Gets range
     *
     * @return string
     */
    public function getRange(): ?string
    {
        return $this->range;
    }

    /**
     * Sets range
     *
     * @param  string $range
     * @return self
     */
    public function setRange(string $range): self
    {
        if (in_array(trim($range), ['THISANDFUTURE', 'THISANDPRIOR'])) {
            $this->range = trim($range);
        }
        return $this;
    }

    /**
     * Gets dateTime
     *
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * Sets dateTime
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
}
