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
    function getFragment(): ?string;
    function getDescription(): ?string;
    function getHtmlDescription(): ?string;

    function setGeo(GeoInfoInterface $geo): self;
    function setAttendees(array $attendees): self;
    function addAttendee(CalendarAttendeeInterface $attendee): self;
    function setAlarms(array $alarms): self;
    function addAlarm(AlarmInfoInterface $alarm): self;
    function setXProps(array $xProps): self;
    function addXProp(XPropInterface $xProp): self;
    function setOrganizer(CalOrganizerInterface $organizer): self;
    function setRecurrence(RecurrenceInfoInterface $recurrence): self;
    function setExceptionId(ExceptionRecurIdInfoInterface $exceptionId): self;
    function setDtStart(DtTimeInfoInterface $dtStart): self;
    function setDtEnd(DtTimeInfoInterface $dtEnd): self;
    function setDuration(DurationInfoInterface $duration): self;

    function getGeo(): ?GeoInfoInterface;
    function getAttendees(): array;
    function getAlarms(): array;
    function getXProps(): array;
    function getOrganizer(): ?CalOrganizerInterface;
    function getRecurrence(): ?RecurrenceInfoInterface;
    function getExceptionId(): ?ExceptionRecurIdInfoInterface;
    function getDtStart(): ?DtTimeInfoInterface;
    function getDtEnd(): ?DtTimeInfoInterface;
    function getDuration(): ?DurationInfoInterface;
}
