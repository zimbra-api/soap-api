<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Struct\TzOnsetInfo;

/**
 * CalTZInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="tz")
 */
class CalTZInfo
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getTzStdOffset", setter="setTzStdOffset")
     * @SerializedName("stdoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $tzStdOffset;

    /**
     * @Accessor(getter="getTzDayOffset", setter="setTzDayOffset")
     * @SerializedName("dayoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $tzDayOffset;

    /**
     * @Accessor(getter="getStandardTzOnset", setter="setStandardTzOnset")
     * @SerializedName("standard")
     * @Type("Zimbra\Struct\TzOnsetInfo")
     * @XmlElement
     */
    private $standardTzOnset;

    /**
     * @Accessor(getter="getDaylightTzOnset", setter="setDaylightTzOnset")
     * @SerializedName("daylight")
     * @Type("Zimbra\Struct\TzOnsetInfo")
     * @XmlElement
     */
    private $daylightTzOnset;

    /**
     * @Accessor(getter="getStandardTZName", setter="setStandardTZName")
     * @SerializedName("stdname")
     * @Type("string")
     * @XmlAttribute
     */
    private $standardTZName;

    /**
     * @Accessor(getter="getDaylightTZName", setter="setDaylightTZName")
     * @SerializedName("dayname")
     * @Type("string")
     * @XmlAttribute
     */
    private $daylightTZName;

    /**
     * Constructor method for CalTZInfo
     * @param string $id Timezone ID. If this is the only detail present then this should be an existing server-known timezone's ID Otherwise, it must be present, although it will be ignored by the server
     * @param int $stdoff Standard Time's offset in minutes from UTC; local = UTC + offset
     * @param int $dayoff Daylight Saving Time's offset in minutes from UTC; present only if DST is used
     * @param TzOnsetInfo $standard Time/rule for transitioning from daylight time to standard time. Either specify week/wkday combo, or mday.
     * @param TzOnsetInfo $daylight Time/rule for transitioning from standard time to daylight time
     * @param string $stdname Standard Time component's timezone name
     * @param string $dayname Daylight Saving Time component's timezone name
     * @return self
     */
    public function __construct(
        $id,
        $stdoff,
        $dayoff,
        TzOnsetInfo $standard = NULL,
        TzOnsetInfo $daylight = NULL,
        $stdname = NULL,
        $dayname = NULL
    )
    {
        $this->setId($id)
             ->setTzStdOffset($stdoff)
             ->setTzDayOffset($dayoff);

        if ($standard instanceof TzOnsetInfo) {
            $this->setStandardTzOnset($standard);
        }
        if ($daylight instanceof TzOnsetInfo) {
            $this->setDaylightTzOnset($daylight);
        }
        if (NULL !== $stdname) {
            $this->setStandardTZName($stdname);
        }
        if (NULL !== $dayname) {
            $this->setDaylightTZName($dayname);
        }
    }

    /**
     * Gets timezone ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets timezone ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets the Standard Time's offset in minutes from UTC
     *
     * @return int
     */
    public function getTzStdOffset(): int
    {
        return $this->tzStdOffset;
    }

    /**
     * Sets the Standard Time's offset in minutes from UTC
     *
     * @param  int $stdoff
     * @return self
     */
    public function setTzStdOffset($stdoff): self
    {
        $this->tzStdOffset = (int) $stdoff;
        return $this;
    }

    /**
     * Gets the Daylight Saving Time's offset in minutes from UTC
     *
     * @return int
     */
    public function getTzDayOffset(): int
    {
        return $this->tzDayOffset;
    }

    /**
     * Sets the Daylight Saving Time's offset in minutes from UTC
     *
     * @param  int $dayoff
     * @return self
     */
    public function setTzDayOffset($dayoff): self
    {
        $this->tzDayOffset = (int) $dayoff;
        return $this;
    }

    /**
     * Gets the Standard Time component's timezone name
     *
     * @return string
     */
    public function getStandardTZName(): string
    {
        return $this->standardTZName;
    }

    /**
     * Sets the Standard Time component's timezone name
     *
     * @param  string $stdname
     * @return self
     */
    public function setStandardTZName($stdname): self
    {
        $this->standardTZName = trim($stdname);
        return $this;
    }

    /**
     * Gets the Daylight Saving Time component's timezone name
     *
     * @return string
     */
    public function getDaylightTZName(): string
    {
        return $this->daylightTZName;
    }

    /**
     * Sets the Daylight Saving Time component's timezone name
     *
     * @param  string $dayname
     * @return self
     */
    public function setDaylightTZName($dayname): self
    {
        $this->daylightTZName = trim($dayname);
        return $this;
    }

    /**
     * Gets the Time/rule for transitioning from daylight time to standard time.
     *
     * @return TzOnsetInfo
     */
    public function getStandardTzOnset(): TzOnsetInfo
    {
        return $this->standardTzOnset;
    }

    /**
     * Sets the Time/rule for transitioning from daylight time to standard time.
     *
     * @param  TzOnsetInfo $standard
     * @return self
     */
    public function setStandardTzOnset(TzOnsetInfo $standard): self
    {
        $this->standardTzOnset = $standard;
        return $this;
    }

    /**
     * Gets the Time/rule for transitioning from standard time to daylight time
     *
     * @return TzOnsetInfo
     */
    public function getDaylightTzOnset(): TzOnsetInfo
    {
        return $this->daylightTzOnset;
    }

    /**
     * Sets the Time/rule for transitioning from standard time to daylight time
     *
     * @param  TzOnsetInfo $daylight
     * @return self
     */
    public function setDaylightTzOnset(TzOnsetInfo $daylight): self
    {
        $this->daylightTzOnset = $daylight;
        return $this;
    }
}
