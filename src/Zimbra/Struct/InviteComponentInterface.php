<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

/**
 * InviteComponentInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface InviteComponentInterface extends InviteComponentCommonInterface
{
    function setCategories(array $categories): self;
    function addCategory(string $category): self;
    function setComments(array $comments): self;
    function addComment(string $comment): self;
    function setContacts(array $contacts): self;
    function addContact(string $contact): self;

    function setFragment(string $fragment): self;
    function setDescription(string $description): self;
    function setHtmlDescription(string $htmlDescription): self;
    function getCategories(): array;
    function getComments(): array;
    function getContacts(): array;
    function getFragment(): string;
    function getDescription(): string;
    function getHtmlDescription(): string;

    function setGeoInterface(GeoInfoInterface $geo): self;
    function setAttendeeInterfaces(array $attendees): self;
    function addAttendeeInterface(CalendarAttendeeInterface $attendee): self;
    function setAlarmInterfaces(array $alarms): self;
    function addAlarmInterface(AlarmInfoInterface $alarm): self;
    function setXPropInterfaces(array $xProps): self;
    function addXPropInterface(XPropInterface $xProp): self;
    function setOrganizerInterface(CalOrganizerInterface $organizer): self;
    function setRecurrenceInterface(RecurrenceInfoInterface $recurrence): self;
    function setExceptionIdInterface(ExceptionRecurIdInfoInterface $exceptionId): self;
    function setDtStartInterface(DtTimeInfoInterface $dtStart): self;
    function setDtEndInterface(DtTimeInfoInterface $dtEnd): self;
    function setDurationInterface(DurationInfoInterface $duration): self;

    function getGeoInterface(): GeoInfoInterface;
    function getAttendeeInterfaces(): array;
    function getAlarmInterfaces(): array;
    function getXPropInterfaces(): array;
    function getOrganizerInterface(): CalOrganizerInterface;
    function getRecurrenceInterface(): RecurrenceInfoInterface;
    function getExceptionIdInterface(): ExceptionRecurIdInfoInterface;
    function getDtStartInterface(): DtTimeInfoInterface;
    function getDtEndInterface(): DtTimeInfoInterface;
    function getDurationInterface(): DurationInfoInterface;
}
