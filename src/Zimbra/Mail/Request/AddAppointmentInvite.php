<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\Msg;
use Zimbra\Mail\Struct\SetCalendarItemInfoTrail;

/**
 * AddAppointmentInvite request class
 * Add an invite to an appointment. 
 * The invite corresponds to a VEVENT component.
 * Based on the UID specified (required), a new appointment is created in the default calendar if necessary.
 * If an appointment with the same UID exists, the appointment is updated with the new invite only if the invite is not outdated, according to the iCalendar sequencing rule (based on SEQUENCE, RECURRENCE-ID and DTSTAMP).
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddAppointmentInvite extends Base
{
    use SetCalendarItemInfoTrail;
}
