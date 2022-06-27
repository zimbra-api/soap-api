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

/**
 * LegacyCalendaringData struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class LegacyCalendaringData extends CommonCalendaringData implements CalendaringDataInterface
{
    /**
     * Organizer
     * @Accessor(getter="getOrganizer", setter="setOrganizer")
     * @SerializedName("or")
     * @Type("Zimbra\Mail\Struct\CalOrganizer")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?CalOrganizer $organizer = NULL;

    /**
     * Categories
     * @Accessor(getter="getCategories", setter="setCategories")
     * @SerializedName("category")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="category", namespace="urn:zimbraMail")
     */
    private $categories = [];

    /**
     * Information for iCalendar GEO property
     * @Accessor(getter="getGeo", setter="setGeo")
     * @SerializedName("geo")
     * @Type("Zimbra\Mail\Struct\GeoInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?GeoInfo $geo = NULL;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $fragment;

    /**
     * Instances
     * @Accessor(getter="getInstances", setter="setInstances")
     * @SerializedName("inst")
     * @Type("array<Zimbra\Mail\Struct\LegacyInstanceDataInfo>")
     * @XmlList(inline=true, entry="inst", namespace="urn:zimbraMail")
     */
    private $instances = [];

    /**
     * Alarm information
     * @Accessor(getter="getAlarmData", setter="setAlarmData")
     * @SerializedName("alarmData")
     * @Type("Zimbra\Mail\Struct\AlarmDataInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?AlarmDataInfo $alarmData = NULL;

    /**
     * Constructor LegacyCalendaringData
     *
     * @param  string $xUid
     * @param  string $uid
     * @return self
     */
    public function __construct(
        string $xUid,
        string $uid,
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
     * Gets organizer
     *
     * @return CalOrganizer
     */
    public function getOrganizer(): ?CalOrganizer
    {
        return $this->organizer;
    }

    /**
     * Sets organizer
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
     * Gets categories
     *
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * Sets categories
     *
     * @param  array $categories
     * @return self
     */
    public function setCategories(array $categories): self
    {
        $this->categories = [];
        foreach ($categories as $category) {
            $this->addCategory($category);
        }
        return $this;
    }

    /**
     * add category
     *
     * @param  string $category
     * @return self
     */
    public function addCategory(string $category): self
    {
        $category = trim($category);
        if (!in_array($category, $this->categories)) {
            $this->categories[] = $category;
        }
        return $this;
    }

    /**
     * Gets geo
     *
     * @return GeoInfo
     */
    public function getGeo(): ?GeoInfo
    {
        return $this->geo;
    }

    /**
     * Sets geo
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
     * Gets fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Sets fragment
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
     * Sets instances
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
     * Gets instances
     *
     * @return array
     */
    public function getInstances(): array
    {
        return $this->instances;
    }

    /**
     * Add instance
     *
     * @param  LegacyInstanceDataInfo $instance
     * @return self
     */
    public function addInstance(InstanceDataInterface $instance): self
    {
        $this->instances[] = $instance;
        return $this;
    }

    /**
     * Gets alarmData
     *
     * @return AlarmDataInfo
     */
    public function getAlarmData(): ?AlarmDataInfo
    {
        return $this->alarmData;
    }

    /**
     * Sets alarmData
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
