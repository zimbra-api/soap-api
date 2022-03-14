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

use Zimbra\Mail\Struct\CalItemRequestBase;

/**
 * CreateAppointmentRequest class
 * This is the API to create a new Appointment, optionally  sending out meeting
 * Invitations to other people.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateAppointmentRequest extends CalItemRequestBase
{
    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CreateAppointmentEnvelope)) {
            $this->envelope = new CreateAppointmentEnvelope(
                new CreateAppointmentBody($this)
            );
        }
    }
}
