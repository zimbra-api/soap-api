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

use Zimbra\Common\Enum\{FreeBusyStatus, InviteClass, InviteStatus, ParticipationStatus, Transparency};

/**
 * CommonInstanceDataAttrsInterface interface
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface CommonInstanceDataAttrsInterface
{
    function setPartStat(ParticipationStatus $partStat);
    function setRecurIdZ(string $recurIdZ);
    function setTzOffset(int $tzOffset);
    function setFreeBusyActual(FreeBusyStatus $freeBusyActual);
    function setTaskPercentComplete(string $taskPercentComplete);
    function setIsRecurring(bool $isRecurring);
    function setPriority(string $priority);
    function setFreeBusyIntended(FreeBusyStatus $freeBusyIntended);
    function setTransparency(Transparency $transparency);
    function setName(string $name);
    function setLocation(string $location);
    function setHasOtherAttendees(bool $hasOtherAttendees);
    function setHasAlarm(bool $hasAlarm);
    function setIsOrganizer(bool $isOrganizer);
    function setInvId(string $invId);
    function setComponentNum(int $componentNum);
    function setStatus(InviteStatus $status);
    function setCalClass(InviteClass $calClass);
    function setAllDay(bool $allDay);
    function setDraft(bool $draft);
    function setNeverSent(bool $neverSent);
    function setTaskDueDate(int $taskDueDate);
    function setTaskTzOffsetDue(int $taskTzOffsetDue);

    // see CommonInstanceDataAttrs
    function getPartStat(): ?ParticipationStatus;
    function getRecurIdZ(): ?string;
    function getTzOffset(): ?int;
    function getFreeBusyActual(): ?FreeBusyStatus;
    function getTaskPercentComplete(): ?string;
    function getIsRecurring(): ?bool;
    function getPriority(): ?string;
    function getFreeBusyIntended(): ?FreeBusyStatus;
    function getTransparency(): ?Transparency;
    function getName(): ?string;
    function getLocation(): ?string;
    function getHasOtherAttendees(): ?bool;
    function getHasAlarm(): ?bool;
    function getIsOrganizer(): ?bool;
    function getInvId(): ?string;
    function getComponentNum(): ?int;
    function getStatus(): ?InviteStatus;
    function getCalClass(): ?InviteClass;
    function getAllDay(): ?bool;
    function getDraft(): ?bool;
    function getNeverSent(): ?bool;
    function getTaskDueDate(): ?int;
    function getTaskTzOffsetDue(): ?int;

    // see InstanceDataAttrs /LegacyInstanceDataAttrs
    function setDuration(int $duration);
    function getDuration(): ?int;
}
