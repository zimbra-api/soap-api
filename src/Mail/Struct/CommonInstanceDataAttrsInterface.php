<?php declare(strict_types=1): self;
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

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
    function setPartStat(string $partStat): self;
    function setRecurIdZ(string $recurIdZ): self;
    function setTzOffset(int $tzOffset): self;
    function setFreeBusyActual(string $freeBusyActual): self;
    function setTaskPercentComplete(string $taskPercentComplete): self;
    function setIsRecurring(bool $isRecurring): self;
    function setPriority(string $priority): self;
    function setFreeBusyIntended(string $freeBusyIntended): self;
    function setTransparency(string $transparency): self;
    function setName(string $name): self;
    function setLocation(string $location): self;
    function setHasOtherAttendees(bool $hasOtherAttendees): self;
    function setHasAlarm(bool $hasAlarm): self;
    function setIsOrganizer(bool $isOrganizer): self;
    function setInvId(string $invId): self;
    function setComponentNum(int $componentNum): self;
    function setStatus(string $status): self;
    function setCalClass(string $calClass): self;
    function setAllDay(bool $allDay): self;
    function setDraft(bool $draft): self;
    function setNeverSent(bool $neverSent): self;
    function setTaskDueDate(int $taskDueDate): self;
    function setTaskTzOffsetDue(int $taskTzOffsetDue): self;

    // see CommonInstanceDataAttrs
    function getPartStat(): ?string;
    function getRecurIdZ(): ?string;
    function getTzOffset(): ?int;
    function getFreeBusyActual(): ?string;
    function getTaskPercentComplete(): ?string;
    function getIsRecurring(): ?bool;
    function getPriority(): ?string;
    function getFreeBusyIntended(): ?string;
    function getTransparency(): ?string;
    function getName(): ?string;
    function getLocation(): ?string;
    function getHasOtherAttendees(): ?bool;
    function getHasAlarm(): ?bool;
    function getIsOrganizer(): ?bool;
    function getInvId(): ?string;
    function getComponentNum(): ?int;
    function getStatus(): ?string;
    function getCalClass(): ?string;
    function getAllDay(): ?bool;
    function getDraft(): ?bool;
    function getNeverSent(): ?bool;
    function getTaskDueDate(): self;
    function getTaskTzOffsetDue(): ?int;

    // see InstanceDataAttrs /LegacyInstanceDataAttrs
    function setDuration(int $duration): self;
    function getDuration(): self;
}
