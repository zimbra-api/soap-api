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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Struct\TzOnsetInfo;

/**
 * CalTZInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalTZInfo
{
    /**
     * Timezone ID.
     * If this is the only detail present then this should be an existing server-known timezone's ID Otherwise,
     * it must be present, although it will be ignored by the server
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
     * Standard Time's offset in minutes from UTC; local = UTC + offset
     *
     * @Accessor(getter="getTzStdOffset", setter="setTzStdOffset")
     * @SerializedName("stdoff")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getTzStdOffset", setter: "setTzStdOffset")]
    #[SerializedName("stdoff")]
    #[Type("int")]
    #[XmlAttribute]
    private $tzStdOffset;

    /**
     * Daylight Saving Time's offset in minutes from UTC; present only if DST is used
     *
     * @Accessor(getter="getTzDayOffset", setter="setTzDayOffset")
     * @SerializedName("dayoff")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getTzDayOffset", setter: "setTzDayOffset")]
    #[SerializedName("dayoff")]
    #[Type("int")]
    #[XmlAttribute]
    private $tzDayOffset;

    /**
     * Time/rule for transitioning from daylight time to standard time. Either specify week/wkday combo, or mday.
     *
     * @Accessor(getter="getStandardTzOnset", setter="setStandardTzOnset")
     * @SerializedName("standard")
     * @Type("Zimbra\Common\Struct\TzOnsetInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var TzOnsetInfo
     */
    #[Accessor(getter: "getStandardTzOnset", setter: "setStandardTzOnset")]
    #[SerializedName("standard")]
    #[Type(TzOnsetInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?TzOnsetInfo $standardTzOnset;

    /**
     * Time/rule for transitioning from standard time to daylight time
     *
     * @Accessor(getter="getDaylightTzOnset", setter="setDaylightTzOnset")
     * @SerializedName("daylight")
     * @Type("Zimbra\Common\Struct\TzOnsetInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var TzOnsetInfo
     */
    #[Accessor(getter: "getDaylightTzOnset", setter: "setDaylightTzOnset")]
    #[SerializedName("daylight")]
    #[Type(TzOnsetInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?TzOnsetInfo $daylightTzOnset;

    /**
     * Standard Time component's timezone name
     *
     * @Accessor(getter="getStandardTZName", setter="setStandardTZName")
     * @SerializedName("stdname")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getStandardTZName", setter: "setStandardTZName")]
    #[SerializedName("stdname")]
    #[Type("string")]
    #[XmlAttribute]
    private $standardTZName;

    /**
     * Daylight Saving Time component's timezone name
     *
     * @Accessor(getter="getDaylightTZName", setter="setDaylightTZName")
     * @SerializedName("dayname")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getDaylightTZName", setter: "setDaylightTZName")]
    #[SerializedName("dayname")]
    #[Type("string")]
    #[XmlAttribute]
    private $daylightTZName;

    /**
     * Constructor
     *
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
        string $id = "",
        int $stdoff = 0,
        int $dayoff = 0,
        ?TzOnsetInfo $standard = null,
        ?TzOnsetInfo $daylight = null,
        ?string $stdname = null,
        ?string $dayname = null
    ) {
        $this->setId($id)->setTzStdOffset($stdoff)->setTzDayOffset($dayoff);
        $this->standardTzOnset = $standard;
        $this->daylightTzOnset = $daylight;
        if (null !== $stdname) {
            $this->setStandardTZName($stdname);
        }
        if (null !== $dayname) {
            $this->setDaylightTZName($dayname);
        }
    }

    /**
     * Get timezone ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set timezone ID
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
     * Get the Standard Time's offset in minutes from UTC
     *
     * @return int
     */
    public function getTzStdOffset(): int
    {
        return $this->tzStdOffset;
    }

    /**
     * Set the Standard Time's offset in minutes from UTC
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
     * Get the Daylight Saving Time's offset in minutes from UTC
     *
     * @return int
     */
    public function getTzDayOffset(): int
    {
        return $this->tzDayOffset;
    }

    /**
     * Set the Daylight Saving Time's offset in minutes from UTC
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
     * Get the Standard Time component's timezone name
     *
     * @return string
     */
    public function getStandardTZName(): ?string
    {
        return $this->standardTZName;
    }

    /**
     * Set the Standard Time component's timezone name
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
     * Get the Daylight Saving Time component's timezone name
     *
     * @return string
     */
    public function getDaylightTZName(): ?string
    {
        return $this->daylightTZName;
    }

    /**
     * Set the Daylight Saving Time component's timezone name
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
     * Get the Time/rule for transitioning from daylight time to standard time.
     *
     * @return TzOnsetInfo
     */
    public function getStandardTzOnset(): ?TzOnsetInfo
    {
        return $this->standardTzOnset;
    }

    /**
     * Set the Time/rule for transitioning from daylight time to standard time.
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
     * Get the Time/rule for transitioning from standard time to daylight time
     *
     * @return TzOnsetInfo
     */
    public function getDaylightTzOnset(): ?TzOnsetInfo
    {
        return $this->daylightTzOnset;
    }

    /**
     * Set the Time/rule for transitioning from standard time to daylight time
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
