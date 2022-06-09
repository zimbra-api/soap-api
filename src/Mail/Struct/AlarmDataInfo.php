<?php declare(strict_types=1);
/**
 * This file is nextAlarm of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * AlarmDataInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AlarmDataInfo
{
    /**
     * Time in millis to show the alarm
     * @Accessor(getter="getNextAlarm", setter="setNextAlarm")
     * @SerializedName("nextAlarm")
     * @Type("integer")
     * @XmlAttribute
     */
    private $nextAlarm;

    /**
     * Start time of the meeting instance the alarm is reminding about
     * @Accessor(getter="getAlarmInstanceStart", setter="setAlarmInstanceStart")
     * @SerializedName("alarmInstStart")
     * @Type("integer")
     * @XmlAttribute
     */
    private $alarmInstanceStart;

    /**
     * Mail Item ID of the invite message with detailed information
     * @Accessor(getter="getInvId", setter="setInvId")
     * @SerializedName("invId")
     * @Type("integer")
     * @XmlAttribute
     */
    private $invId;

    /**
     * Component number
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("compNum")
     * @Type("integer")
     * @XmlAttribute
     */
    private $componentNum;

    /**
     * Meeting subject
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Meeting location
     * @Accessor(getter="getLocation", setter="setLocation")
     * @SerializedName("loc")
     * @Type("string")
     * @XmlAttribute
     */
    private $location;

    /**
     * Details of the alarm
     * @Accessor(getter="getAlarm", setter="setAlarm")
     * @SerializedName("alarm")
     * @Type("Zimbra\Mail\Struct\AlarmInfo")
     * @XmlElement
     */
    private ?AlarmInfo $alarm = NULL;

    /**
     * Constructor method
     * 
     * @param int $nextAlarm
     * @param int $alarmInstanceStart
     * @param int $invId
     * @param int $componentNum
     * @param string $name
     * @param string $location
     * @param AlarmInfo $alarm
     * @return self
     */
    public function __construct(
        ?int $nextAlarm = NULL,
        ?int $alarmInstanceStart = NULL,
        ?int $invId = NULL,
        ?int $componentNum = NULL,
        ?string $name = NULL,
        ?string $location = NULL,
        ?AlarmInfo $alarm = NULL
    )
    {
        if (NULL !== $nextAlarm) {
            $this->setNextAlarm($nextAlarm);
        }
        if (NULL !== $alarmInstanceStart) {
            $this->setAlarmInstanceStart($alarmInstanceStart);
        }
        if (NULL !== $invId) {
            $this->setInvId($invId);
        }
        if (NULL !== $componentNum) {
            $this->setComponentNum($componentNum);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $location) {
            $this->setLocation($location);
        }
        if ($alarm instanceof AlarmInfo) {
            $this->setAlarm($alarm);
        }
    }

    /**
     * Gets nextAlarm
     *
     * @return int
     */
    public function getNextAlarm(): ?int
    {
        return $this->nextAlarm;
    }

    /**
     * Sets nextAlarm
     *
     * @param  int $nextAlarm
     * @return self
     */
    public function setNextAlarm(int $nextAlarm): self
    {
        $this->nextAlarm = $nextAlarm;
        return $this;
    }

    /**
     * Gets alarmInstanceStart
     *
     * @return int
     */
    public function getAlarmInstanceStart(): ?int
    {
        return $this->alarmInstanceStart;
    }

    /**
     * Sets alarmInstanceStart
     *
     * @param  int $alarmInstanceStart
     * @return self
     */
    public function setAlarmInstanceStart(int $alarmInstanceStart): self
    {
        $this->alarmInstanceStart = $alarmInstanceStart;
        return $this;
    }

    /**
     * Gets invId
     *
     * @return int
     */
    public function getInvId(): ?int
    {
        return $this->invId;
    }

    /**
     * Sets invId
     *
     * @param  int $invId
     * @return self
     */
    public function setInvId(int $invId): self
    {
        $this->invId = $invId;
        return $this;
    }

    /**
     * Gets componentNum
     *
     * @return int
     */
    public function getComponentNum(): ?int
    {
        return $this->componentNum;
    }

    /**
     * Sets componentNum
     *
     * @param  int $componentNum
     * @return self
     */
    public function setComponentNum(int $componentNum): self
    {
        $this->componentNum = $componentNum;
        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets location
     *
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * Sets location
     *
     * @param  string $location
     * @return self
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Gets alarm
     *
     * @return AlarmInfo
     */
    public function getAlarm(): ?AlarmInfo
    {
        return $this->alarm;
    }

    /**
     * Sets alarm
     *
     * @param  AlarmInfo $alarm
     * @return self
     */
    public function setAlarm(AlarmInfo $alarm): self
    {
        $this->alarm = $alarm;
        return $this;
    }
}
