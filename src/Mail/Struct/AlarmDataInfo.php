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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AlarmDataInfo
{
    /**
     * Time in millis to show the alarm
     * 
     * @Accessor(getter="getNextAlarm", setter="setNextAlarm")
     * @SerializedName("nextAlarm")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getNextAlarm', setter: 'setNextAlarm')]
    #[SerializedName('nextAlarm')]
    #[Type('int')]
    #[XmlAttribute]
    private $nextAlarm;

    /**
     * Start time of the meeting instance the alarm is reminding about
     * 
     * @Accessor(getter="getAlarmInstanceStart", setter="setAlarmInstanceStart")
     * @SerializedName("alarmInstStart")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getAlarmInstanceStart', setter: 'setAlarmInstanceStart')]
    #[SerializedName('alarmInstStart')]
    #[Type('int')]
    #[XmlAttribute]
    private $alarmInstanceStart;

    /**
     * Mail Item ID of the invite message with detailed information
     * 
     * @Accessor(getter="getInvId", setter="setInvId")
     * @SerializedName("invId")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getInvId', setter: 'setInvId')]
    #[SerializedName('invId')]
    #[Type('int')]
    #[XmlAttribute]
    private $invId;

    /**
     * Component number
     * 
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("compNum")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getComponentNum', setter: 'setComponentNum')]
    #[SerializedName('compNum')]
    #[Type('int')]
    #[XmlAttribute]
    private $componentNum;

    /**
     * Meeting subject
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Meeting location
     * 
     * @Accessor(getter="getLocation", setter="setLocation")
     * @SerializedName("loc")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getLocation', setter: 'setLocation')]
    #[SerializedName('loc')]
    #[Type('string')]
    #[XmlAttribute]
    private $location;

    /**
     * Details of the alarm
     * 
     * @Accessor(getter="getAlarm", setter="setAlarm")
     * @SerializedName("alarm")
     * @Type("Zimbra\Mail\Struct\AlarmInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var AlarmInfo
     */
    #[Accessor(getter: 'getAlarm', setter: 'setAlarm')]
    #[SerializedName('alarm')]
    #[Type(AlarmInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?AlarmInfo $alarm;

    /**
     * Constructor
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
        $this->alarm = $alarm;
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
    }

    /**
     * Get nextAlarm
     *
     * @return int
     */
    public function getNextAlarm(): ?int
    {
        return $this->nextAlarm;
    }

    /**
     * Set nextAlarm
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
     * Get alarmInstanceStart
     *
     * @return int
     */
    public function getAlarmInstanceStart(): ?int
    {
        return $this->alarmInstanceStart;
    }

    /**
     * Set alarmInstanceStart
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
     * Get invId
     *
     * @return int
     */
    public function getInvId(): ?int
    {
        return $this->invId;
    }

    /**
     * Set invId
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
     * Get componentNum
     *
     * @return int
     */
    public function getComponentNum(): ?int
    {
        return $this->componentNum;
    }

    /**
     * Set componentNum
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
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get location
     *
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * Set location
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
     * Get alarm
     *
     * @return AlarmInfo
     */
    public function getAlarm(): ?AlarmInfo
    {
        return $this->alarm;
    }

    /**
     * Set alarm
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
