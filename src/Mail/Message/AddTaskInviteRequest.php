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

use Zimbra\Common\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\{Msg, SetCalendarItemInfoTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * AddTaskInviteRequest class
 * Add a task invite
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddTaskInviteRequest extends SoapRequest
{
    use SetCalendarItemInfoTrait {
        SetCalendarItemInfoTrait::__construct as private __traitConstruct;
    }

    /**
     * Constructor method for AddTaskInviteRequest
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
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AddTaskInviteEnvelope(
            new AddTaskInviteBody($this)
        );
    }
}
