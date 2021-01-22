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
    function createFromAction(string $action): AlarmInfoInterface;
    function setDescription(string $description): self;
    function setSummary(string $summary): self;
    function getAction(): string;
    function getDescription(): string;
    function getSummary(): string;

    function setTriggerInterface(AlarmTriggerInfoInterface $trigger): self;
    function setRepeatInterface(DurationInfoInterface $repeat): self;
    function setAttachInterface(CalendarAttachInterface $attach): self;
    function setAttendeeInterfaces(array $attendees): self;
    function addAttendeeInterface(CalendarAttendeeInterface $attendee): self;
    function setXPropsInterface(array $xProps): self;
    function addXPropInterface(XPropInterface $xProp): self;
    function getTriggerInfo(): AlarmTriggerInfoInterface;
    function getRepeatInfo(): DurationInfoInterface;
    function getAttachInfo(): CalendarAttachInterface;
    function getAttendeeInterfaces(): array;
    function getXPropInterfaces(): array;
}
