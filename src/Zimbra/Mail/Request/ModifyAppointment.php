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
 * ModifyAppointment request class
 * Modify an appointment, or if the appointment is a recurrence then modify the "default" invites.
 * That is, all instances that do not have exceptions. 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyAppointment extends CalItemRequestBase
{
    /**
     * Constructor method for ModifyAppointment
     * @param  Msg $m
     * @param  string $id
     * @param  int $comp
     * @param  int $ms
     * @param  int $rev
     * @param  bool $echo
     * @param  int $max
     * @param  bool $html
     * @param  bool $neuter
     * @param  bool $forcesend
     * @return self
     */
    public function __construct(
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    )
    {
        parent::__construct(
            $m,
            $echo,
            $max,
            $html,
            $neuter,
            $forcesend
        );
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $comp)
        {
            $this->property('comp', (int) $comp);
        }
        if(null !== $ms)
        {
            $this->property('ms', (int) $ms);
        }
        if(null !== $rev)
        {
            $this->property('rev', (int) $rev);
        }
    }

    /**
     * Get or set id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Get or set comp
     *
     * @param  int $comp
     * @return int|self
     */
    public function comp($comp = null)
    {
        if(null === $comp)
        {
            return $this->property('comp');
        }
        return $this->property('comp', (int) $comp);
    }

    /**
     * Get or set ms
     *
     * @param  int $ms
     * @return int|self
     */
    public function ms($ms = null)
    {
        if(null === $ms)
        {
            return $this->property('ms');
        }
        return $this->property('ms', (int) $ms);
    }

    /**
     * Get or set rev
     *
     * @param  int $rev
     * @return int|self
     */
    public function rev($rev = null)
    {
        if(null === $rev)
        {
            return $this->property('rev');
        }
        return $this->property('rev', (int) $rev);
    }
}
