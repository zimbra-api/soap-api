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
use Zimbra\Common\Enum\{
    FreeBusyStatus,
    InviteClass,
    InviteStatus,
    ParticipationStatus,
    Transparency
};

/**
 * LegacyInstanceDataAttrs struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class LegacyInstanceDataAttrs extends CommonInstanceDataAttrs
{
    /**
     * Duration
     *
     * @var int
     */
    #[Accessor(getter: "getDuration", setter: "setDuration")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private $duration;

    /**
     * Constructor
     *
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
        if (null !== $duration) {
            $this->setDuration($duration);
        }
    }

    /**
     * Get the duration
     *
     * @return int
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * Set the duration
     *
     * @param  int $duration
     * @return self
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }
}
