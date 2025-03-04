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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Struct\{CalTZInfoInterface, TzOnsetInfo};

/**
 * CalTZInfo struct class
 * Timezone specification
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalTZInfo implements CalTZInfoInterface
{
    /**
     * Timezone ID.
     * If this is the only detail present then this should be an existing server-known timezone's ID
     * Otherwise, it must be present, although it will be ignored by the server
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private string $id;

    /**
     * Standard Time's offset in minutes from UTC; local = UTC + offset
     *
     * @var int
     */
    #[Accessor(getter: "getTzStdOffset", setter: "setTzStdOffset")]
    #[SerializedName("stdoff")]
    #[Type("int")]
    #[XmlAttribute]
    private int $tzStdOffset;

    /**
     * Daylight Saving Time's offset in minutes from UTC; present only if DST is used
     *
     * @var int
     */
    #[Accessor(getter: "getTzDayOffset", setter: "setTzDayOffset")]
    #[SerializedName("dayoff")]
    #[Type("int")]
    #[XmlAttribute]
    private int $tzDayOffset;

    /**
     * Time/rule for transitioning from daylight time to standard time.
     * Either specify week/wkday combo, or mday.
     *
     * @var TzOnsetInfo
     */
    #[Accessor(getter: "getStandardTzOnset", setter: "setStandardTzOnset")]
    #[SerializedName("standard")]
    #[Type(TzOnsetInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?TzOnsetInfo $standardTzOnset;

    /**
     * Time/rule for transitioning from standard time to daylight time
     *
     * @var TzOnsetInfo
     */
    #[Accessor(getter: "getDaylightTzOnset", setter: "setDaylightTzOnset")]
    #[SerializedName("daylight")]
    #[Type(TzOnsetInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?TzOnsetInfo $daylightTzOnset;

    /**
     * Standard Time component's timezone name
     *
     * @var string
     */
    #[Accessor(getter: "getStandardTZName", setter: "setStandardTZName")]
    #[SerializedName("stdname")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $standardTZName = null;

    /**
     * Daylight Saving Time component's timezone name
     *
     * @var string
     */
    #[Accessor(getter: "getDaylightTZName", setter: "setDaylightTZName")]
    #[SerializedName("dayname")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $daylightTZName = null;

    /**
     * Constructor
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
        string $id = "",
        int $tzStdOffset = 0,
        int $tzDayOffset = 0,
        ?TzOnsetInfo $standardTzOnset = null,
        ?TzOnsetInfo $daylightTzOnset = null,
        ?string $standardTZName = null,
        ?string $daylightTZName = null
    ) {
        $this->setId($id)
            ->setTzStdOffset($tzStdOffset)
            ->setTzDayOffset($tzDayOffset);
        $this->standardTzOnset = $standardTzOnset;
        $this->daylightTzOnset = $daylightTzOnset;
        if (null !== $standardTZName) {
            $this->setStandardTZName($standardTZName);
        }
        if (null !== $daylightTZName) {
            $this->setDaylightTZName($daylightTZName);
        }
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get addressType
     *
     * @return int
     */
    public function getTzStdOffset(): int
    {
        return $this->tzStdOffset;
    }

    /**
     * Set tzStdOffset
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
     * Get the tzDayOffset
     *
     * @return int
     */
    public function getTzDayOffset(): int
    {
        return $this->tzDayOffset;
    }

    /**
     * Set the tzDayOffset
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
     * Get the standardTzOnset
     *
     * @return TzOnsetInfo
     */
    public function getStandardTzOnset(): ?TzOnsetInfo
    {
        return $this->standardTzOnset;
    }

    /**
     * Set the standardTzOnset
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
     * Get the daylightTzOnset
     *
     * @return TzOnsetInfo
     */
    public function getDaylightTzOnset(): ?TzOnsetInfo
    {
        return $this->daylightTzOnset;
    }

    /**
     * Set the daylightTzOnset
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
     * Get the standardTZName
     *
     * @return string
     */
    public function getStandardTZName(): ?string
    {
        return $this->standardTZName;
    }

    /**
     * Set the standardTZName
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
     * Get the daylightTZName
     *
     * @return string
     */
    public function getDaylightTZName(): ?string
    {
        return $this->daylightTZName;
    }

    /**
     * Set the daylightTZName
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
