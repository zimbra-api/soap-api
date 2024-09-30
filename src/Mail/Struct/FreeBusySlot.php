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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * FreeBusySlot class
 * Free busy slot information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FreeBusySlot
{
    /**
     * GMT Start time for slot in milliseconds
     *
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getStartTime", setter: "setStartTime")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private $startTime;

    /**
     * GMT End time for slot in milliseconds
     *
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getEndTime", setter: "setEndTime")]
    #[SerializedName("e")]
    #[Type("int")]
    #[XmlAttribute]
    private $endTime;

    /**
     * Calendar event id
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("eventId")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("eventId")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Appointment subject
     *
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("subject")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSubject", setter: "setSubject")]
    #[SerializedName("subject")]
    #[Type("string")]
    #[XmlAttribute]
    private $subject;

    /**
     * Location of meeting
     *
     * @Accessor(getter="getLocation", setter="setLocation")
     * @SerializedName("location")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getLocation", setter: "setLocation")]
    #[SerializedName("location")]
    #[Type("string")]
    #[XmlAttribute]
    private $location;

    /**
     * Returns a bool value whether this calendar event is a meeting or not.
     *
     * @Accessor(getter="isMeeting", setter="setMeeting")
     * @SerializedName("isMeeting")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isMeeting", setter: "setMeeting")]
    #[SerializedName("isMeeting")]
    #[Type("bool")]
    #[XmlAttribute]
    private $isMeeting;

    /**
     * Returns a bool indicating whether it is continuous or not.
     *
     * @Accessor(getter="isRecurring", setter="setRecurring")
     * @SerializedName("isRecurring")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isRecurring", setter: "setRecurring")]
    #[SerializedName("isRecurring")]
    #[Type("bool")]
    #[XmlAttribute]
    private $isRecurring;

    /**
     * Returns a bool indicating whether there is any exception or not.
     *
     * @Accessor(getter="isException", setter="setException")
     * @SerializedName("isException")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isException", setter: "setException")]
    #[SerializedName("isException")]
    #[Type("bool")]
    #[XmlAttribute]
    private $isException;

    /**
     * Returns a bool indicating whether any reminder has been set or not.
     *
     * @Accessor(getter="isReminderSet", setter="setReminderSet")
     * @SerializedName("isReminderSet")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isReminderSet", setter: "setReminderSet")]
    #[SerializedName("isReminderSet")]
    #[Type("bool")]
    #[XmlAttribute]
    private $isReminderSet;

    /**
     * Returns a bool indicating whether this meeting is private or not.
     *
     * @Accessor(getter="isPrivate", setter="setPrivate")
     * @SerializedName("isPrivate")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isPrivate", setter: "setPrivate")]
    #[SerializedName("isPrivate")]
    #[Type("bool")]
    #[XmlAttribute]
    private $isPrivate;

    /**
     * Returns a bool indicating hasPermission to view FreeBusy information
     *
     * @Accessor(getter="hasPermission", setter="setHasPermission")
     * @SerializedName("hasPermission")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "hasPermission", setter: "setHasPermission")]
    #[SerializedName("hasPermission")]
    #[Type("bool")]
    #[XmlAttribute]
    private $hasPermission;

    /**
     * Constructor
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $id
     * @param  string $subject
     * @param  string $location
     * @param  bool $isMeeting
     * @param  bool $isRecurring
     * @param  bool $isException
     * @param  bool $isReminderSet
     * @param  bool $isPrivate
     * @param  bool $hasPermission
     * @return self
     */
    public function __construct(
        int $startTime = 0,
        int $endTime = 0,
        ?string $id = null,
        ?string $subject = null,
        ?string $location = null,
        ?bool $isMeeting = null,
        ?bool $isRecurring = null,
        ?bool $isException = null,
        ?bool $isReminderSet = null,
        ?bool $isPrivate = null,
        ?bool $hasPermission = null
    ) {
        $this->setStartTime($startTime)->setEndTime($endTime);
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $subject) {
            $this->setSubject($subject);
        }
        if (null !== $location) {
            $this->setLocation($location);
        }
        if (null !== $isMeeting) {
            $this->setMeeting($isMeeting);
        }
        if (null !== $isRecurring) {
            $this->setRecurring($isRecurring);
        }
        if (null !== $isException) {
            $this->setException($isException);
        }
        if (null !== $isReminderSet) {
            $this->setReminderSet($isReminderSet);
        }
        if (null !== $isPrivate) {
            $this->setPrivate($isPrivate);
        }
        if (null !== $hasPermission) {
            $this->setHasPermission($hasPermission);
        }
    }

    /**
     * Get startTime
     *
     * @return int
     */
    public function getStartTime(): int
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
     * Get endTime
     *
     * @return int
     */
    public function getEndTime(): int
    {
        return $this->endTime;
    }

    /**
     * Set endTime
     *
     * @param  int $endTime
     * @return self
     */
    public function setEndTime(int $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
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
     * Get subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set subject
     *
     * @param  string $subject
     * @return self
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
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
     * Get isMeeting
     *
     * @return bool
     */
    public function isMeeting(): ?bool
    {
        return $this->isMeeting;
    }

    /**
     * Set isMeeting
     *
     * @param  bool $isMeeting
     * @return self
     */
    public function setMeeting(bool $isMeeting): self
    {
        $this->isMeeting = $isMeeting;
        return $this;
    }

    /**
     * Get isRecurring
     *
     * @return bool
     */
    public function isRecurring(): ?bool
    {
        return $this->isRecurring;
    }

    /**
     * Set isRecurring
     *
     * @param  bool $isRecurring
     * @return self
     */
    public function setRecurring(bool $isRecurring): self
    {
        $this->isRecurring = $isRecurring;
        return $this;
    }

    /**
     * Get isException
     *
     * @return bool
     */
    public function isException(): ?bool
    {
        return $this->isException;
    }

    /**
     * Set isException
     *
     * @param  bool $isException
     * @return self
     */
    public function setException(bool $isException): self
    {
        $this->isException = $isException;
        return $this;
    }

    /**
     * Get isReminderSet
     *
     * @return bool
     */
    public function isReminderSet(): ?bool
    {
        return $this->isReminderSet;
    }

    /**
     * Set isReminderSet
     *
     * @param  bool $isReminderSet
     * @return self
     */
    public function setReminderSet(bool $isReminderSet): self
    {
        $this->isReminderSet = $isReminderSet;
        return $this;
    }

    /**
     * Get isPrivate
     *
     * @return bool
     */
    public function isPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    /**
     * Set isPrivate
     *
     * @param  bool $isPrivate
     * @return self
     */
    public function setPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;
        return $this;
    }

    /**
     * Get hasPermission
     *
     * @return bool
     */
    public function hasPermission(): ?bool
    {
        return $this->hasPermission;
    }

    /**
     * Set hasPermission
     *
     * @param  bool $hasPermission
     * @return self
     */
    public function setHasPermission(bool $hasPermission): self
    {
        $this->hasPermission = $hasPermission;
        return $this;
    }
}
