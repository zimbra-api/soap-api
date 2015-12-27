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

use Zimbra\Mail\Struct\Msg;

/**
 * ForwardAppointmentInvite request class
 * Used by an attendee to forward an appointment invite email to another user who is not already an attendee. 
 * To forward an appointment item, use ForwardAppointmentRequest instead.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ForwardAppointmentInvite extends Base
{
    /**
     * Constructor method for ForwardAppointmentInvite
     * @param  string $id
     * @param  Msg $msg
     * @return self
     */
    public function __construct($id = null, Msg $msg = null)
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if($msg instanceof Msg)
        {
            $this->setChild('m', $msg);
        }
    }

    /**
     * Gets invite message item ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets invite message item ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets details of the invite.
     *
     * @return Msg
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets details of the invite.
     *
     * @param  Msg $msg
     * @return self
     */
    public function setMsg(Msg $msg)
    {
        return $this->setChild('m', $msg);
    }
}
