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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Common\Enum\{FreeBusyStatus, InviteClass, InviteStatus, ParticipationStatus, Transparency};

/**
 * LegacyCalendaringData struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class LegacyCalendaringData extends CommonCalendaringData implements CalendaringDataInterface
{
    /**
     * Organizer
     * 
     * @Accessor(getter="getOrganizer", setter="setOrganizer")
     * @SerializedName("or")
     * @Type("Zimbra\Mail\Struct\CalOrganizer")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var CalOrganizer
     */
    #[Accessor(getter: "getOrganizer", setter: "setOrganizer")]
    #[SerializedName('or')]
    #[Type(CalOrganizer::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $organizer;

    /**
     * Categories
     * 
     * @Accessor(getter="getCategories", setter="setCategories")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="category", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getCategories', setter: 'setCategories')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'category', namespace: 'urn:zimbraMail')]
    private $categories = [];

    /**
     * Information for iCalendar GEO property
     * 
     * @Accessor(getter="getGeo", setter="setGeo")
     * @SerializedName("geo")
     * @Type("Zimbra\Mail\Struct\GeoInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var GeoInfo
     */
    #[Accessor(getter: "getGeo", setter: "setGeo")]
    #[SerializedName('geo')]
    #[Type(GeoInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $geo;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * 
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     * 
     * @var string
     */
    #[Accessor(getter: "getFragment", setter: "setFragment")]
    #[SerializedName('fr')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $fragment;

    /**
     * Instances
     * 
     * @Accessor(getter="getInstances", setter="setInstances")
     * @Type("array<Zimbra\Mail\Struct\LegacyInstanceDataInfo>")
     * @XmlList(inline=true, entry="inst", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getInstances', setter: 'setInstances')]
    #[Type('array<Zimbra\Mail\Struct\LegacyInstanceDataInfo>')]
    #[XmlList(inline: true, entry: 'inst', namespace: 'urn:zimbraMail')]
    private $instances = [];

    /**
     * Alarm information
     * 
     * @Accessor(getter="getAlarmData", setter="setAlarmData")
     * @SerializedName("alarmData")
     * @Type("Zimbra\Mail\Struct\AlarmDataInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var AlarmDataInfo
     */
    #[Accessor(getter: "getAlarmData", setter: "setAlarmData")]
    #[SerializedName('alarmData')]
    #[Type(AlarmDataInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $alarmData;

    /**
     * Constructor
     *
     * @param  string $xUid
     * @param  string $uid
     * @param  CalOrganizer $organizer
     * @param  array $categories
     * @param  GeoInfo $geo
     * @param  string $fragment
     * @param  array $instances
     * @param  AlarmDataInfo $alarmData
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $folderId
     * @param  int $size
     * @param  int $changeDate
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  string $id
     * @param  int $duration
     * @param  ParticipationStatus $partStat
     * @param  string $recurIdZ
     * @param  int $tzOffset
     * @param  FreeBusyStatus $freeBusyActual
     * @param  string $taskPercentComplete
     * @param  bool $isRecurring
     * @param  bool $hasExceptions
     * @param  string $priority
     * @param  FreeBusyStatus $freeBusyIntended
     * @param  Transparency $transparency
     * @param  string $name
     * @param  string $location
     * @param  bool $hasOtherAttendees
     * @param  bool $hasAlarm
     * @param  bool $isOrganizer
     * @param  string $invId
     * @param  int $componentNum
     * @param  InviteStatus $status
     * @param  InviteClass $calClass
     * @param  bool $allDay
     * @param  bool $draft
     * @param  bool $neverSent
     * @param  int $taskDueDate
     * @param  int $taskTzOffsetDue
     * @return self
     */
    public function __construct(
        string $xUid = '',
        string $uid = '',
        ?CalOrganizer $organizer = NULL,
        array $categories = [],
        ?GeoInfo $geo = NULL,
        ?string $fragment = NULL,
        array $instances = [],
        ?AlarmDataInfo $alarmData = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?string $folderId = NULL,
        ?int $size = NULL,
        ?int $changeDate = NULL,
        ?int $modifiedSequence = NULL,
        ?int $revision = NULL,
        ?string $id = NULL,
        ?int $duration = NULL,
        ?ParticipationStatus $partStat = NULL,
        ?string $recurIdZ = NULL,
        ?int $tzOffset = NULL,
        ?FreeBusyStatus $freeBusyActual = NULL,
        ?string $taskPercentComplete = NULL,
        ?bool $isRecurring = NULL,
        ?bool $hasExceptions = NULL,
        ?string $priority = NULL,
        ?FreeBusyStatus $freeBusyIntended = NULL,
        ?Transparency $transparency = NULL,
        ?string $name = NULL,
        ?string $location = NULL,
        ?bool $hasOtherAttendees = NULL,
        ?bool $hasAlarm = NULL,
        ?bool $isOrganizer = NULL,
        ?string $invId = NULL,
        ?int $componentNum = NULL,
        ?InviteStatus $status = NULL,
        ?InviteClass $calClass = NULL,
        ?bool $allDay = NULL,
        ?bool $draft = NULL,
        ?bool $neverSent = NULL,
        ?int $taskDueDate = NULL,
        ?int $taskTzOffsetDue = NULL
    )
    {
        parent::__construct(
            $xUid,
            $uid,
            $flags,
            $tags,
            $tagNames,
            $folderId,
            $size,
            $changeDate,
            $modifiedSequence,
            $revision,
            $id,
            $duration,
            $partStat,
            $recurIdZ,
            $tzOffset,
            $freeBusyActual,
            $taskPercentComplete,
            $isRecurring,
            $hasExceptions,
            $priority,
            $freeBusyIntended,
            $transparency,
            $name,
            $location,
            $hasOtherAttendees,
            $hasAlarm,
            $isOrganizer,
            $invId,
            $componentNum,
            $status,
            $calClass,
            $allDay,
            $draft,
            $neverSent,
            $taskDueDate,
            $taskTzOffsetDue
        );
        $this->setCategories($categories)
             ->setInstances($instances);
        if ($organizer instanceof CalOrganizer) {
            $this->setOrganizer($organizer);
        }
        if ($geo instanceof GeoInfo) {
            $this->setGeo($geo);
        }
        if (NULL !== $fragment) {
            $this->setFragment($fragment);
        }
        if ($alarmData instanceof AlarmDataInfo) {
            $this->setAlarmData($alarmData);
        }
    }

    /**
     * Get organizer
     *
     * @return CalOrganizer
     */
    public function getOrganizer(): ?CalOrganizer
    {
        return $this->organizer;
    }

    /**
     * Set organizer
     *
     * @param  CalOrganizer $organizer
     * @return self
     */
    public function setOrganizer(CalOrganizer $organizer): self
    {
        $this->organizer = $organizer;
        return $this;
    }

    /**
     * Get categories
     *
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * Set categories
     *
     * @param  array $categories
     * @return self
     */
    public function setCategories(array $categories): self
    {
        $this->categories = array_unique(array_map(static fn ($category) => trim($category), $categories));
        return $this;
    }

    /**
     * Get geo
     *
     * @return GeoInfo
     */
    public function getGeo(): ?GeoInfo
    {
        return $this->geo;
    }

    /**
     * Set geo
     *
     * @param  GeoInfo $geo
     * @return self
     */
    public function setGeo(GeoInfo $geo): self
    {
        $this->geo = $geo;
        return $this;
    }

    /**
     * Get fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Set fragment
     *
     * @param  string $fragment
     * @return self
     */
    public function setFragment(string $fragment): self
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * Set instances
     *
     * @param  array $instances
     * @return self
     */
    public function setInstances(array $instances): self
    {
        $this->instances = array_filter($instances, static fn ($inst) => $inst instanceof LegacyInstanceDataInfo);
        return $this;
    }

    /**
     * Get instances
     *
     * @return array
     */
    public function getInstances(): array
    {
        return $this->instances;
    }

    /**
     * Get alarmData
     *
     * @return AlarmDataInfo
     */
    public function getAlarmData(): ?AlarmDataInfo
    {
        return $this->alarmData;
    }

    /**
     * Set alarmData
     *
     * @param  AlarmDataInfo $alarmData
     * @return self
     */
    public function setAlarmData(AlarmDataInfo $alarmData): self
    {
        $this->alarmData = $alarmData;
        return $this;
    }
}
