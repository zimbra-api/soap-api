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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Struct\TzOnsetInfo;

/**
 * CalTZInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CalTZInfo
{
    /**
     * Timezone ID. If this is the only detail present then this should be an existing server-known timezone's ID Otherwise, it must be present, although it will be ignored by the server
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Standard Time's offset in minutes from UTC; local = UTC + offset
     * @Accessor(getter="getTzStdOffset", setter="setTzStdOffset")
     * @SerializedName("stdoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $tzStdOffset;

    /**
     * Daylight Saving Time's offset in minutes from UTC; present only if DST is used
     * @Accessor(getter="getTzDayOffset", setter="setTzDayOffset")
     * @SerializedName("dayoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $tzDayOffset;

    /**
     * Time/rule for transitioning from daylight time to standard time. Either specify week/wkday combo, or mday.
     * @Accessor(getter="getStandardTzOnset", setter="setStandardTzOnset")
     * @SerializedName("standard")
     * @Type("Zimbra\Struct\TzOnsetInfo")
     * @XmlElement
     */
    private $standardTzOnset;

    /**
     * Time/rule for transitioning from standard time to daylight time
     * @Accessor(getter="getDaylightTzOnset", setter="setDaylightTzOnset")
     * @SerializedName("daylight")
     * @Type("Zimbra\Struct\TzOnsetInfo")
     * @XmlElement
     */
    private $daylightTzOnset;

    /**
     * Standard Time component's timezone name
     * @Accessor(getter="getStandardTZName", setter="setStandardTZName")
     * @SerializedName("stdname")
     * @Type("string")
     * @XmlAttribute
     */
    private $standardTZName;

    /**
     * Daylight Saving Time component's timezone name
     * @Accessor(getter="getDaylightTZName", setter="setDaylightTZName")
     * @SerializedName("dayname")
     * @Type("string")
     * @XmlAttribute
     */
    private $daylightTZName;

    /**
     * Constructor method for CalTZInfo
     * @param string $id
     * @param int $stdoff
     * @param int $dayoff
     * @param TzOnsetInfo $standard
     * @param TzOnsetInfo $daylight
     * @param string $stdname
     * @param string $dayname
     * @return self
     */
    public function __construct(
        string $id,
        int $stdoff,
        int $dayoff,
        ?TzOnsetInfo $standard = NULL,
        ?TzOnsetInfo $daylight = NULL,
        ?string $stdname = NULL,
        ?string $dayname = NULL
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
    public function setId(string $id): self
    {
        $this->id = $id;
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
    public function setTzStdOffset(int $stdoff): self
    {
        $this->tzStdOffset = $stdoff;
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
    public function setTzDayOffset(int $dayoff): self
    {
        $this->tzDayOffset = $dayoff;
        return $this;
    }

    /**
     * Gets the Standard Time component's timezone name
     *
     * @return string
     */
    public function getStandardTZName(): ?string
    {
        return $this->standardTZName;
    }

    /**
     * Sets the Standard Time component's timezone name
     *
     * @param  string $stdname
     * @return self
     */
    public function setStandardTZName(string $stdname): self
    {
        $this->standardTZName = $stdname;
        return $this;
    }

    /**
     * Gets the Daylight Saving Time component's timezone name
     *
     * @return string
     */
    public function getDaylightTZName(): ?string
    {
        return $this->daylightTZName;
    }

    /**
     * Sets the Daylight Saving Time component's timezone name
     *
     * @param  string $dayname
     * @return self
     */
    public function setDaylightTZName(string $dayname): self
    {
        $this->daylightTZName = $dayname;
        return $this;
    }

    /**
     * Gets the Time/rule for transitioning from daylight time to standard time.
     *
     * @return TzOnsetInfo
     */
    public function getStandardTzOnset(): ?TzOnsetInfo
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
    public function getDaylightTzOnset(): ?TzOnsetInfo
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
