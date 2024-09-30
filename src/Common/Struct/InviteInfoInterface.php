<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use Zimbra\Common\Enum\InviteType;

/**
 * InviteInfoInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface InviteInfoInterface
{
    function getCalItemType(): ?InviteType;

    function setTimezones(array $timezones): self;
    function addTimezone(CalTZInfoInterface $timezone): self;
    function setInviteComponent(
        InviteComponentInterface $inviteComponent
    ): self;
    function setCalendarReplies(array $calendarReplies): self;
    function addCalendarReply(CalendarReplyInterface $calendarReply): self;

    function getTimezones(): array;
    function getInviteComponent(): ?InviteComponentInterface;
    function getCalendarReplies(): array;
}
