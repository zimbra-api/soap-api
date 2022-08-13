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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Enum\{FreeBusyStatus, InviteClass, InviteStatus, ParticipationStatus, Transparency};

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
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * Set if is an exception
     * 
     * @Accessor(getter="getIsException", setter="setIsException")
     * @SerializedName("ex")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isException;

    /**
     * Organizer
     * @Accessor(getter="getOrganizer", setter="setOrganizer")
     * @SerializedName("or")
     * @Type("Zimbra\Mail\Struct\CalOrganizer")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var CalOrganizer
     */
    private $organizer;

    /**
     * Categories
     * 
     * @Accessor(getter="getCategories", setter="setCategories")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="category", namespace="urn:zimbraMail")
     */
    private $categories = [];

    /**
     * Information for iCalendar GEO property
     * 
     * @Accessor(getter="getGeo", setter="setGeo")
     * @SerializedName("geo")
     * @Type("Zimbra\Mail\Struct\GeoInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var GeoInfo
     */
    private $geo;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * 
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $fragment;

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
        ?int $startTime = NULL,
        ?bool $isException = NULL,
        ?CalOrganizer $organizer = NULL,
        array $categories = [],
        ?GeoInfo $geo = NULL,
        ?string $fragment = NULL,
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
        if (NULL !== $startTime) {
            $this->setStartTime($startTime);
        }
        if (NULL !== $isException) {
            $this->setIsException($isException);
        }
        if ($organizer instanceof CalOrganizer) {
            $this->setOrganizer($organizer);
        }
        if ($geo instanceof GeoInfo) {
            $this->setGeo($geo);
        }
        if (NULL !== $fragment) {
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
