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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FreeBusySlot
{
    /**
     * GMT Start time for slot in milliseconds
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * GMT End time for slot in milliseconds
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("integer")
     * @XmlAttribute
     */
    private $endTime;

    /**
     * calendar event id
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("eventId")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Appointment subject
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("subject")
     * @Type("string")
     * @XmlAttribute
     */
    private $subject;

    /**
     * location of meeting
     * @Accessor(getter="getLocation", setter="setLocation")
     * @SerializedName("location")
     * @Type("string")
     * @XmlAttribute
     */
    private $location;

    /**
     * returns a boolean value whether this calendar event is a meeting or not.
     * @Accessor(getter="isMeeting", setter="setMeeting")
     * @SerializedName("isMeeting")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isMeeting;

    /**
     * returns a boolean indicating whether it is continuous or not.
     * @Accessor(getter="isRecurring", setter="setRecurring")
     * @SerializedName("isRecurring")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isRecurring;

    /**
     * returns a boolean indicating whether there is any exception or not.
     * @Accessor(getter="isException", setter="setException")
     * @SerializedName("isException")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isException;

    /**
     * returns a boolean indicating whether any reminder has been set or not.
     * @Accessor(getter="isReminderSet", setter="setReminderSet")
     * @SerializedName("isReminderSet")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isReminderSet;

    /**
     * returns a boolean indicating whether this meeting is private or not.
     * @Accessor(getter="isPrivate", setter="setPrivate")
     * @SerializedName("isPrivate")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isPrivate;

    /**
     * returns a boolean indicating hasPermission to view FreeBusy information
     * @Accessor(getter="hasPermission", setter="setHasPermission")
     * @SerializedName("hasPermission")
     * @Type("bool")
     * @XmlAttribute
     */
    private $hasPermission;

    /**
     * Constructor method for FreeBusySlot
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
        ?string $id = NULL,
        ?string $subject = NULL,
        ?string $location = NULL,
        ?bool $isMeeting = NULL,
        ?bool $isRecurring = NULL,
        ?bool $isException = NULL,
        ?bool $isReminderSet = NULL,
        ?bool $isPrivate = NULL,
        ?bool $hasPermission = NULL
    )
    {
        $this->setStartTime($startTime)
             ->setEndTime($endTime);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $subject) {
            $this->setSubject($subject);
        }
        if (NULL !== $location) {
            $this->setLocation($location);
        }
        if (NULL !== $isMeeting) {
            $this->setMeeting($isMeeting);
        }
        if (NULL !== $isRecurring) {
            $this->setRecurring($isRecurring);
        }
        if (NULL !== $isException) {
            $this->setException($isException);
        }
        if (NULL !== $isReminderSet) {
            $this->setReminderSet($isReminderSet);
        }
        if (NULL !== $isPrivate) {
            $this->setPrivate($isPrivate);
        }
        if (NULL !== $hasPermission) {
            $this->setHasPermission($hasPermission);
        }
    }

    /**
     * Gets startTime
     *
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * Sets startTime
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
     * Gets endTime
     *
     * @return int
     */
    public function getEndTime(): int
    {
        return $this->endTime;
    }

    /**
     * Sets endTime
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
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
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
     * Gets subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Sets subject
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
     * Gets isMeeting
     *
     * @return bool
     */
    public function isMeeting(): ?bool
    {
        return $this->isMeeting;
    }

    /**
     * Sets isMeeting
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
     * Gets isRecurring
     *
     * @return bool
     */
    public function isRecurring(): ?bool
    {
        return $this->isRecurring;
    }

    /**
     * Sets isRecurring
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
     * Gets isException
     *
     * @return bool
     */
    public function isException(): ?bool
    {
        return $this->isException;
    }

    /**
     * Sets isException
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
     * Gets isReminderSet
     *
     * @return bool
     */
    public function isReminderSet(): ?bool
    {
        return $this->isReminderSet;
    }

    /**
     * Sets isReminderSet
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
     * Gets isPrivate
     *
     * @return bool
     */
    public function isPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    /**
     * Sets isPrivate
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
     * Gets hasPermission
     *
     * @return bool
     */
    public function hasPermission(): ?bool
    {
        return $this->hasPermission;
    }

    /**
     * Sets hasPermission
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
