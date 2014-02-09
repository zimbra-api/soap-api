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
    /**
     * Constructor method for AddAppointmentInvite
     * @param  Msg $m
     * @param  ParticipationStatus $ptst
     * @return self
     */
    public function __construct(Msg $m = null, ParticipationStatus $ptst = null)
    {
        parent::__construct();
        if($m instanceof Msg)
        {
            $this->child('m', $m);
        }
        if($ptst instanceof ParticipationStatus)
        {
            $this->property('ptst', $ptst);
        }
    }

    /**
     * Get or set m
     *
     * @param  Msg $m
     * @return Msg|self
     */
    public function m(Msg $m = null)
    {
        if(null === $m)
        {
            return $this->child('m');
        }
        return $this->child('m', $m);
    }

    /**
     * Get or set ptst
     * iCalendar PTST (Participation status)
     * Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF 
     * Meanings: 
     *   "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo), "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     *
     * @param  ParticipationStatus $ptst
     * @return ParticipationStatus|self
     */
    public function ptst(ParticipationStatus $ptst = null)
    {
        if(null === $ptst)
        {
            return $this->property('ptst');
        }
        return $this->property('ptst', $ptst);
    }
}
