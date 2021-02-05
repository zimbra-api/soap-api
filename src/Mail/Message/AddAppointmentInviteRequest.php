<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{AccessType, XmlRoot};
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\Msg;
use Zimbra\Mail\Struct\SetCalendarItemInfoTrait;
use Zimbra\Soap\Request;

/**
 * AddAppointmentInviteRequest class
 * Add an invite to an appointment.
 * The invite corresponds to a VEVENT component.  Based on the UID specified (required), a new appointment is created
 * in the default calendar if necessary.  If an appointment with the same UID exists, the appointment is updated with
 * the new invite only if the invite is not outdated, according to the iCalendar sequencing rule (based on SEQUENCE,
 * RECURRENCE-ID and DTSTAMP).
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AddAppointmentInviteRequest")
 */
class AddAppointmentInviteRequest extends Request
{
    use SetCalendarItemInfoTrait {
        SetCalendarItemInfoTrait::__construct as private __traitConstruct;
    }

    /**
     * Constructor method for AddAppointmentInviteRequest
     *
     * @param  ParticipationStatus $partStat
     * @param  Msg $msg
     * @return self
     */
    public function __construct(
        ?ParticipationStatus $partStat = NULL, ?Msg $msg = NULL
    )
    {
        $this->__traitConstruct($partStat, $msg);
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof AddAppointmentInviteEnvelope)) {
            $this->envelope = new AddAppointmentInviteEnvelope(
                new AddAppointmentInviteBody($this)
            );
        }
    }
}