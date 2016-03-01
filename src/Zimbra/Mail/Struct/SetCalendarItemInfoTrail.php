<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Enum\ParticipationStatus;
use Zimbra\Struct\Base;

/**
 * SetCalendarItemInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
trait SetCalendarItemInfoTrail
{
    /**
     * Constructor method for SetCalendarItemInfo
     * @param  Msg $m Message
     * @param  ParticipationStatus $ptst iCalendar PTST (Participation status)
     * @return self
     */
    public function __construct(Msg $m = null, ParticipationStatus $ptst = null)
    {
        parent::__construct();
        if($m instanceof Msg)
        {
            $this->setChild('m', $m);
        }
        if($ptst instanceof ParticipationStatus)
        {
            $this->setProperty('ptst', $ptst);
        }
    }

    /**
     * Gets message
     *
     * @return Msg
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets message
     *
     * @param  Msg $m
     * @return self
     */
    public function setMsg(Msg $m)
    {
        return $this->setChild('m', $m);
    }

    /**
     * Gets participation status
     *
     * @return ParticipationStatus
     */
    public function getPartStat()
    {
        return $this->getProperty('ptst');
    }

    /**
     * Sets participation status
     *
     * @param  ParticipationStatus $ptst
     * @return self
     */
    public function setPartStat(ParticipationStatus $ptst)
    {
        return $this->setProperty('ptst', $ptst);
    }
}
