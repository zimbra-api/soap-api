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
 * AlarmInfoInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface AlarmInfoInterface
{
    function setDescription(string $description): self;
    function setSummary(string $summary): self;
    function getAction(): ?string;
    function getDescription(): ?string;
    function getSummary(): ?string;

    function setTrigger(AlarmTriggerInfoInterface $trigger): self;
    function setRepeat(DurationInfoInterface $repeat): self;
    function setAttach(CalendarAttachInterface $attach): self;

    function setAttendees(array $attendees): self;
    function addAttendee(CalendarAttendeeInterface $attendee): self;
    function getAttendees(): array;

    function setXProps(array $xProps): self;
    function addXProp(XPropInterface $xProp): self;
    function getXProps(): array;

    function getTriggerInfo(): ?AlarmTriggerInfoInterface;
    function getRepeatInfo(): ?DurationInfoInterface;
    function getAttachInfo(): ?CalendarAttachInterface;
}
