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
     * @param  Msg $m
     * @param  bool $echo
     * @param  int $max
     * @param  bool $html
     * @param  bool $neuter
     * @param  bool $forcesend
     * @return self
     */
    public function __construct(
        Msg $m = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    )
    {
        parent::__construct();
        if($m instanceof Msg)
        {
            $this->child('m', $m);
        }
        if(null !== $echo)
        {
            $this->property('echo', (bool) $echo);
        }
        if(null !== $max)
        {
            $this->property('max', (int) $max);
        }
        if(null !== $html)
        {
            $this->property('html', (bool) $html);
        }
        if(null !== $neuter)
        {
            $this->property('neuter', (bool) $neuter);
        }
        if(null !== $forcesend)
        {
            $this->property('forcesend', (bool) $forcesend);
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
     * Get or set echo
     * If specified, the created appointment is echoed back in the response as if a GetMsgRequest was made
     *
     * @param  bool $echo
     * @return bool|self
     */
    public function echo_($echo = null)
    {
        if(null === $echo)
        {
            return $this->property('echo');
        }
        return $this->property('echo', (bool) $echo);
    }

    /**
     * Get or set max
     * Maximum inlined length
     *
     * @param  int $max
     * @return int|self
     */
    public function max($max = null)
    {
        if(null === $max)
        {
            return $this->property('max');
        }
        return $this->property('max', (int) $max);
    }

    /**
     * Get or set html
     * Set if want HTML included in echoing
     *
     * @param  bool $html
     * @return bool|self
     */
    public function html($html = null)
    {
        if(null === $html)
        {
            return $this->property('html');
        }
        return $this->property('html', (bool) $html);
    }

    /**
     * Get or set neuter
     * Set if want "neuter" set for echoed response
     *
     * @param  bool $neuter
     * @return bool|self
     */
    public function neuter($neuter = null)
    {
        if(null === $neuter)
        {
            return $this->property('neuter');
        }
        return $this->property('neuter', (bool) $neuter);
    }

    /**
     * Get or set forcesend
     * If set, ignore smtp 550 errors when sending the notification to attendees.
     * If unset, throw the soapfaultexception with invalid addresses so that client can give the forcesend option to the end user.
     * The default is 1.
     *
     * @param  bool $forcesend
     * @return bool|self
     */
    public function forcesend($forcesend = null)
    {
        if(null === $forcesend)
        {
            return $this->property('forcesend');
        }
        return $this->property('forcesend', (bool) $forcesend);
    }
}
