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
 * AddTaskInviteRequest class
 * Add a task invite
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AddTaskInviteRequest")
 */
class AddTaskInviteRequest extends Request
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
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof AddTaskInviteEnvelope)) {
            $this->envelope = new AddTaskInviteEnvelope(
                new AddTaskInviteBody($this)
            );
        }
    }
}
