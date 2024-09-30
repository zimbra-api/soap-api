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

use Zimbra\Mail\Struct\GetCalendarItemRequestBase;
use Zimbra\Common\Struct\SoapEnvelopeInterface;

/**
 * GetAppointmentRequest class
 * Get Appointment. Returns the metadata info for each Invite that makes up this appointment.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAppointmentRequest extends GetCalendarItemRequestBase
{
    public static function createForUidInvitesContent(
        string $uid,
        bool $includeInvites,
        bool $includeContent
    ): GetAppointmentRequest {
        $request = new GetAppointmentRequest();
        $request->setUid($uid);
        $request->setIncludeContent($includeContent);
        $request->setIncludeInvites($includeInvites);
        return $request;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAppointmentEnvelope(new GetAppointmentBody($this));
    }
}
