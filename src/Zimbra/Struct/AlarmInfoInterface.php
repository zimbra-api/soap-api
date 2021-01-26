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

use Zimbra\Enum\AlarmAction;

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
    function setAction(AlarmAction $action): self;
    function setDescription(string $description): self;
    function setSummary(string $summary): self;
    function getAction(): AlarmAction;
    function getDescription(): ?string;
    function getSummary(): ?string;

    function setTrigger(AlarmTriggerInfoInterface $trigger): self;
    function setRepeat(DurationInfoInterface $repeat): self;
    function setAttach(CalendarAttachInterface $attach): self;
    function getTrigger(): ?AlarmTriggerInfoInterface;
    function getRepeat(): ?DurationInfoInterface;
    function getAttach(): ?CalendarAttachInterface;

    function addAttendee(CalendarAttendeeInterface $attendee): self;
    function setAttendees(array $attendees): self;
    function getAttendees(): array;

    function addXProp(XPropInterface $xProp): self;
    function setXProps(array $xProps): self;
    function getXProps(): array;
}
