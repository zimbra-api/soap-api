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
use Zimbra\Common\Struct\SearchHit;

/**
 * CalendarItemHitInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class CalendarItemHitInfo extends CommonCalendaringData implements
    SearchHit
{
    /**
     * Sort field value
     *
     * @var string
     */
    #[Accessor(getter: "getSortField", setter: "setSortField")]
    #[SerializedName("sf")]
    #[Type("string")]
    #[XmlAttribute]
    private $sortField;

    /**
     * Date
     *
     * @var int
     */
    #[Accessor(getter: "getDate", setter: "setDate")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private $date;

    /**
     * Set if the message matched the specified query string
     *
     * @var bool
     */
    #[Accessor(getter: "getContentMatched", setter: "setContentMatched")]
    #[SerializedName("cm")]
    #[Type("bool")]
    #[XmlAttribute]
    private $contentMatched;

    /**
     * Time in millis to show the alarm
     *
     * @var int
     */
    #[Accessor(getter: "getNextAlarm", setter: "setNextAlarm")]
    #[SerializedName("nextAlarm")]
    #[Type("int")]
    #[XmlAttribute]
    private $nextAlarm;

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
    private $categories;

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
    private $fragment;

    /**
     * Data for instances
     *
     * @var array
     */
    #[Accessor(getter: "getInstances", setter: "setInstances")]
    #[Type("array<Zimbra\Mail\Struct\InstanceDataInfo>")]
    #[XmlList(inline: true, entry: "inst", namespace: "urn:zimbraMail")]
    private $instances = [];

    /**
     * Alarm information
     *
     * @var AlarmDataInfo
     */
    #[Accessor(getter: "getAlarmData", setter: "setAlarmData")]
    #[SerializedName("alarmData")]
    #[Type(AlarmDataInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?AlarmDataInfo $alarmData;

    /**
     * Invites
     *
     * @var array
     */
    #[Accessor(getter: "getInvites", setter: "setInvites")]
    #[Type("array<Zimbra\Mail\Struct\Invitation>")]
    #[XmlList(inline: true, entry: "inv", namespace: "urn:zimbraMail")]
    private $invites = [];

    /**
     * Replies
     *
     * @var array
     */
    #[Accessor(getter: "getReplies", setter: "setReplies")]
    #[SerializedName("replies")]
    #[Type("array<Zimbra\Mail\Struct\CalReply>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "reply", namespace: "urn:zimbraMail")]
    private $replies = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $sortField
     * @param  int $date
     * @param  bool $contentMatched
     * @param  int $nextAlarm
     * @param  CalOrganizer $organizer
     * @param  array $categories
     * @param  GeoInfo $geo
     * @param  string $fragment
     * @param  array $instances
     * @param  AlarmDataInfo $alarmData
     * @param  array $invites
     * @param  array $replies
     * @return self
     */
    public function __construct(
        ?string $id = null,
        ?string $sortField = null,
        ?int $date = null,
        ?bool $contentMatched = null,
        ?int $nextAlarm = null,
        ?CalOrganizer $organizer = null,
        array $categories = [],
        ?GeoInfo $geo = null,
        ?string $fragment = null,
        array $instances = [],
        ?AlarmDataInfo $alarmData = null,
        array $invites = [],
        array $replies = []
    ) {
        parent::__construct();
        $this->setCategories($categories)
            ->setInstances($instances)
            ->setInvites($invites)
            ->setReplies($replies);
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $sortField) {
            $this->setSortField($sortField);
        }
        if (null !== $date) {
            $this->setDate($date);
        }
        if (null !== $contentMatched) {
            $this->setContentMatched($contentMatched);
        }
        if (null !== $nextAlarm) {
            $this->setNextAlarm($nextAlarm);
        }
        $this->organizer = $organizer;
        $this->geo = $geo;
        $this->alarmData = $alarmData;
        if (null !== $fragment) {
            $this->setFragment($fragment);
        }
    }

    public function setId(string $id): self
    {
        parent::setId($id);
        return $this;
    }

    /**
     * Get sortField
     *
     * @return string
     */
    public function getSortField(): ?string
    {
        return $this->sortField;
    }

    /**
     * Set sortField
     *
     * @param  string $sortField
     * @return self
     */
    public function setSortField(string $sortField): self
    {
        $this->sortField = $sortField;
        return $this;
    }

    /**
     * Get date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get contentMatched
     *
     * @return bool
     */
    public function getContentMatched(): ?bool
    {
        return $this->contentMatched;
    }

    /**
     * Set contentMatched
     *
     * @param  bool $contentMatched
     * @return self
     */
    public function setContentMatched(bool $contentMatched): self
    {
        $this->contentMatched = $contentMatched;
        return $this;
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
        $this->categories = array_unique(
            array_map(static fn($category) => trim($category), $categories)
        );
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
        $this->instances = array_filter(
            $instances,
            static fn($instance) => $instance instanceof InstanceDataInfo
        );
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

    /**
     * Set invites
     *
     * @param  array $invites
     * @return self
     */
    public function setInvites(array $invites): self
    {
        $this->invites = array_filter(
            $invites,
            static fn($invite) => $invite instanceof Invitation
        );
        return $this;
    }

    /**
     * Get invites
     *
     * @return array
     */
    public function getInvites(): array
    {
        return $this->invites;
    }

    /**
     * Set replies
     *
     * @param  array $replies
     * @return self
     */
    public function setReplies(array $replies): self
    {
        $this->replies = array_filter(
            $replies,
            static fn($reply) => $reply instanceof CalReply
        );
        return $this;
    }

    /**
     * Get replies
     *
     * @return array
     */
    public function getReplies(): array
    {
        return $this->replies;
    }
}
