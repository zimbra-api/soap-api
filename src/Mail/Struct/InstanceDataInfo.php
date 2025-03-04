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
    XmlElement,
    XmlList
};
use Zimbra\Common\Enum\{
    FreeBusyStatus,
    InviteClass,
    InviteStatus,
    ParticipationStatus,
    Transparency
};

/**
 * InstanceDataInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InstanceDataInfo extends InstanceDataAttrs
{
    /**
     * Start time
     *
     * @var int
     */
    #[Accessor(getter: "getStartTime", setter: "setStartTime")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $startTime = null;

    /**
     * Set if is an exception
     *
     * @var bool
     */
    #[Accessor(getter: "getIsException", setter: "setIsException")]
    #[SerializedName("ex")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isException = null;

    /**
     * Organizer
     *
     * @var CalOrganizer
     */
    #[Accessor(getter: "getOrganizer", setter: "setOrganizer")]
    #[SerializedName("or")]
    #[Type(CalOrganizer::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?CalOrganizer $organizer;

    /**
     * Categories
     *
     * @var array
     */
    #[Accessor(getter: "getCategories", setter: "setCategories")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "category", namespace: "urn:zimbraMail")]
    private array $categories = [];

    /**
     * Information for iCalendar GEO property
     *
     * @var GeoInfo
     */
    #[Accessor(getter: "getGeo", setter: "setGeo")]
    #[SerializedName("geo")]
    #[Type(GeoInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?GeoInfo $geo;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     *
     * @var string
     */
    #[Accessor(getter: "getFragment", setter: "setFragment")]
    #[SerializedName("fr")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private ?string $fragment = null;

    /**
     * Constructor
     *
     * @param int $startTime
     * @param bool $isException
     * @param CalOrganizer $organizer
     * @param array $categories
     * @param GeoInfo $geo
     * @param string $fragment
     * @param int $duration
     * @param ParticipationStatus $partStat
     * @param string $recurIdZ
     * @param int $tzOffset
     * @param FreeBusyStatus $freeBusyActual
     * @param string $taskPercentComplete
     * @param bool $isRecurring
     * @param bool $hasExceptions
     * @param string $priority
     * @param FreeBusyStatus $freeBusyIntended
     * @param Transparency $transparency
     * @param string $name
     * @param string $location
     * @param bool $hasOtherAttendees
     * @param bool $hasAlarm
     * @param bool $isOrganizer
     * @param string $invId
     * @param int $componentNum
     * @param InviteStatus $status
     * @param InviteClass $calClass
     * @param bool $allDay
     * @param bool $draft
     * @param bool $neverSent
     * @param int $taskDueDate
     * @param int $taskTzOffsetDue
     * @return self
     */
    public function __construct(
        ?int $startTime = null,
        ?bool $isException = null,
        ?CalOrganizer $organizer = null,
        array $categories = [],
        ?GeoInfo $geo = null,
        ?string $fragment = null,
        ?int $duration = null,
        ?ParticipationStatus $partStat = null,
        ?string $recurIdZ = null,
        ?int $tzOffset = null,
        ?FreeBusyStatus $freeBusyActual = null,
        ?string $taskPercentComplete = null,
        ?bool $isRecurring = null,
        ?bool $hasExceptions = null,
        ?string $priority = null,
        ?FreeBusyStatus $freeBusyIntended = null,
        ?Transparency $transparency = null,
        ?string $name = null,
        ?string $location = null,
        ?bool $hasOtherAttendees = null,
        ?bool $hasAlarm = null,
        ?bool $isOrganizer = null,
        ?string $invId = null,
        ?int $componentNum = null,
        ?InviteStatus $status = null,
        ?InviteClass $calClass = null,
        ?bool $allDay = null,
        ?bool $draft = null,
        ?bool $neverSent = null,
        ?int $taskDueDate = null,
        ?int $taskTzOffsetDue = null
    ) {
        parent::__construct(
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
        $this->setCategories($categories);
        $this->organizer = $organizer;
        $this->geo = $geo;
        if (null !== $startTime) {
            $this->setStartTime($startTime);
        }
        if (null !== $isException) {
            $this->setIsException($isException);
        }
        if (null !== $fragment) {
            $this->setFragment($fragment);
        }
    }

    /**
     * Get startTime
     *
     * @return int
     */
    public function getStartTime(): ?int
    {
        return $this->startTime;
    }

    /**
     * Set startTime
     *
     * @param  int $startTime
     * @return self
     */
    public function setStartTime(int $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Get isException
     *
     * @return bool
     */
    public function getIsException(): ?bool
    {
        return $this->isException;
    }

    /**
     * Set isException
     *
     * @param  bool $isException
     * @return self
     */
    public function setIsException(bool $isException): self
    {
        $this->isException = $isException;
        return $this;
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
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set categories
     *
     * @param  array $categories
     * @return self
     */
    public function setCategories(array $categories)
    {
        $this->categories = array_unique($categories);
        return $this;
    }

    /**
     * add category
     *
     * @param  string $category
     * @return self
     */
    public function addCategory(string $category)
    {
        $category = trim($category);
        if (!in_array($category, $this->categories)) {
            $this->categories[] = $category;
        }
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
}
