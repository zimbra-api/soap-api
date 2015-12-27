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

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\Msg;

/**
 * ForwardAppointment request class
 * Used by an attendee to forward an instance or entire appointment to another user who is not already an attendee.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ForwardAppointment extends Base
{
    /**
     * Constructor method for ForwardAppointment
     * @param  string $id
     * @param  DtTimeInfo $exceptionId
     * @param  CalTZInfo $timezone
     * @param  Msg $msg
     * @return self
     */
    public function __construct(
        $id = null,
        DtTimeInfo $exceptionId = null,
        CalTZInfo $timezone = null,
        Msg $msg = null
    )
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if($exceptionId instanceof DtTimeInfo)
        {
            $this->setChild('exceptId', $exceptionId);
        }
        if($timezone instanceof CalTZInfo)
        {
            $this->setChild('tz', $timezone);
        }
        if($msg instanceof Msg)
        {
            $this->setChild('m', $msg);
        }
    }

    /**
     * Gets appointment item ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets appointment item ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets exception Id
     *
     * @return DtTimeInfo
     */
    public function getExceptionId()
    {
        return $this->getChild('exceptId');
    }

    /**
     * Sets exception Id
     *
     * @param  DtTimeInfo $exceptionId
     * @return self
     */
    public function setExceptionId(DtTimeInfo $exceptionId)
    {
        return $this->setChild('exceptId', $exceptionId);
    }

    /**
     * Gets timezone
     *
     * @return CalTZInfo
     */
    public function getTimezone()
    {
        return $this->getChild('tz');
    }

    /**
     * Sets timezone
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function setTimezone(CalTZInfo $timezone)
    {
        return $this->setChild('tz', $timezone);
    }

    /**
     * Gets details of the appointment.
     *
     * @return Msg
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets details of the appointment.
     *
     * @param  Msg $msg
     * @return self
     */
    public function setMsg(Msg $msg)
    {
        return $this->setChild('m', $msg);
    }
}
