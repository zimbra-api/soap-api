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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\{CalTZInfoInterface, TzOnsetInfo};

/**
 * CalTZInfo struct class
 * Timezone specification
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CalTZInfo implements CalTZInfoInterface
{
    /**
     * Timezone ID.
     * If this is the only detail present then this should be an existing server-known timezone's ID
     * Otherwise, it must be present, although it will be ignored by the server
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
     * Time/rule for transitioning from daylight time to standard time.
     * Either specify week/wkday combo, or mday.
     * @Accessor(getter="getStandardTzOnset", setter="setStandardTzOnset")
     * @SerializedName("standard")
     * @Type("Zimbra\Common\Struct\TzOnsetInfo")
     * @XmlElement
     */
    private ?TzOnsetInfo $standardTzOnset = NULL;

    /**
     * Time/rule for transitioning from standard time to daylight time
     * @Accessor(getter="getDaylightTzOnset", setter="setDaylightTzOnset")
     * @SerializedName("daylight")
     * @Type("Zimbra\Common\Struct\TzOnsetInfo")
     * @XmlElement
     */
    private ?TzOnsetInfo $daylightTzOnset = NULL;

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
     * Constructor method
     *
     * @param string $id
     * @param int $tzStdOffset
     * @param int $tzDayOffset
     * @param TzOnsetInfo $standardTzOnset
     * @param TzOnsetInfo $daylightTzOnset
     * @param string $standardTZName
     * @param string $daylightTZName
     * @return self
     */
    public function __construct(
        string $id,
        int $tzStdOffset,
        int $tzDayOffset,
        ?TzOnsetInfo $standardTzOnset = NULL,
        ?TzOnsetInfo $daylightTzOnset = NULL,
        ?string $standardTZName = NULL,
        ?string $daylightTZName = NULL
    )
    {
        $this->setId($id)
             ->setTzStdOffset($tzStdOffset)
             ->setTzDayOffset($tzDayOffset);
        if ($standardTzOnset instanceof TzOnsetInfo) {
            $this->setStandardTzOnset($standardTzOnset);
        }
        if ($daylightTzOnset instanceof TzOnsetInfo) {
            $this->setDaylightTzOnset($daylightTzOnset);
        }
        if (NULL !== $standardTZName) {
            $this->setStandardTZName($standardTZName);
        }
        if (NULL !== $daylightTZName) {
            $this->setDaylightTZName($daylightTZName);
        }
    }

    /**
     * Gets address
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
     * Gets addressType
     *
     * @return int
     */
    public function getTzStdOffset(): int
    {
        return $this->tzStdOffset;
    }

    /**
     * Sets tzStdOffset
     *
     * @param  int $tzStdOffset
     * @return self
     */
    public function setTzStdOffset(int $tzStdOffset): self
    {
        $this->tzStdOffset = $tzStdOffset;
        return $this;
    }

    /**
     * Gets the tzDayOffset
     *
     * @return int
     */
    public function getTzDayOffset(): int
    {
        return $this->tzDayOffset;
    }

    /**
     * Sets the tzDayOffset
     *
     * @param  int $tzDayOffset
     * @return self
     */
    public function setTzDayOffset(int $tzDayOffset): self
    {
        $this->tzDayOffset = $tzDayOffset;
        return $this;
    }

    /**
     * Gets the standardTzOnset
     *
     * @return TzOnsetInfo
     */
    public function getStandardTzOnset(): ?TzOnsetInfo
    {
        return $this->standardTzOnset;
    }

    /**
     * Sets the standardTzOnset
     *
     * @param  TzOnsetInfo $standardTzOnset
     * @return self
     */
    public function setStandardTzOnset(TzOnsetInfo $standardTzOnset): self
    {
        $this->standardTzOnset = $standardTzOnset;
        return $this;
    }

    /**
     * Gets the daylightTzOnset
     *
     * @return TzOnsetInfo
     */
    public function getDaylightTzOnset(): ?TzOnsetInfo
    {
        return $this->daylightTzOnset;
    }

    /**
     * Sets the daylightTzOnset
     *
     * @param  TzOnsetInfo $daylightTzOnset
     * @return self
     */
    public function setDaylightTzOnset(TzOnsetInfo $daylightTzOnset): self
    {
        $this->daylightTzOnset = $daylightTzOnset;
        return $this;
    }

    /**
     * Gets the standardTZName
     *
     * @return string
     */
    public function getStandardTZName(): ?string
    {
        return $this->standardTZName;
    }

    /**
     * Sets the standardTZName
     *
     * @param  string $standardTZName
     * @return self
     */
    public function setStandardTZName(string $standardTZName): self
    {
        $this->standardTZName = $standardTZName;
        return $this;
    }

    /**
     * Gets the daylightTZName
     *
     * @return string
     */
    public function getDaylightTZName(): ?string
    {
        return $this->daylightTZName;
    }

    /**
     * Sets the daylightTZName
     *
     * @param  string $daylightTZName
     * @return self
     */
    public function setDaylightTZName(string $daylightTZName): self
    {
        $this->daylightTZName = $daylightTZName;
        return $this;
    }
}
