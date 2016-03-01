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
 * CalItemRequestBase request class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class CalItemRequestBase extends Base
{
    /**
     * Constructor method for CalItemRequestBase
     * @param  Msg $msg
     * @param  bool $echo
     * @param  int $max
     * @param  bool $html
     * @param  bool $neuter
     * @param  bool $forcesend
     * @return self
     */
    public function __construct(
        Msg $msg = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    )
    {
        parent::__construct();
        if($msg instanceof Msg)
        {
            $this->setChild('m', $msg);
        }
        if(null !== $echo)
        {
            $this->setProperty('echo', (bool) $echo);
        }
        if(null !== $max)
        {
            $this->setProperty('max', (int) $max);
        }
        if(null !== $html)
        {
            $this->setProperty('html', (bool) $html);
        }
        if(null !== $neuter)
        {
            $this->setProperty('neuter', (bool) $neuter);
        }
        if(null !== $forcesend)
        {
            $this->setProperty('forcesend', (bool) $forcesend);
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
    public function setMsg(Msg $msg)
    {
        return $this->setChild('m', $msg);
    }

    /**
     * Gets echo
     *
     * @return bool
     */
    public function getEcho()
    {
        return $this->getProperty('echo');
    }

    /**
     * Sets echo
     *
     * @param  bool $echo
     *     If specified, the created appointment is echoed back in the response as if a GetMsgRequest was made
     * @return self
     */
    public function setEcho($echo)
    {
        return $this->setProperty('echo', (bool) $echo);
    }

    /**
     * Gets maximum inlined length
     *
     * @return int
     */
    public function getMaxSize()
    {
        return $this->getProperty('max');
    }

    /**
     * Sets maximum inlined length
     *
     * @param  int $max
     * @return self
     */
    public function setMaxSize($max)
    {
        return $this->setProperty('max', (int) $max);
    }

    /**
     * Gets want html
     *
     * @return bool
     */
    public function getWantHtml()
    {
        return $this->getProperty('html');
    }

    /**
     * Sets want html
     *
     * @param  bool $html
     *    Set if want HTML included in echoing
     * @return self
     */
    public function setWantHtml($html)
    {
        return $this->setProperty('html', (bool) $html);
    }

    /**
     * Gets neuter
     *
     * @return bool
     */
    public function getNeuter()
    {
        return $this->getProperty('neuter');
    }

    /**
     * Sets neuter
     *
     * @param  bool $neuter
     *     Set if want "neuter" set for echoed response
     * @return self
     */
    public function setNeuter($neuter)
    {
        return $this->setProperty('neuter', (bool) $neuter);
    }

    /**
     * Gets force send
     *
     * @return bool
     */
    public function getForceSend()
    {
        return $this->getProperty('forcesend');
    }

    /**
     * Sets force send
     *
     * @param  bool $forcesend
     *     If set, ignore smtp 550 errors when sending the notification to attendees.
     *     If unset, throw the soapfaultexception with invalid addresses so that client can give the forcesend option to the end user.
     *     The default is 1.
     * @return self
     */
    public function setForceSend($forcesend)
    {
        return $this->setProperty('forcesend', (bool) $forcesend);
    }
}
