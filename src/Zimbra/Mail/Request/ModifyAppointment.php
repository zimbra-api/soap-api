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
     * @param  Msg $msg
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
        Msg $msg = null,
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
            $msg,
            $echo,
            $max,
            $html,
            $neuter,
            $forcesend
        );
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $comp)
        {
            $this->setProperty('comp', (int) $comp);
        }
        if(null !== $ms)
        {
            $this->setProperty('ms', (int) $ms);
        }
        if(null !== $rev)
        {
            $this->setProperty('rev', (int) $rev);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets component number
     *
     * @return int
     */
    public function getComponentNum()
    {
        return $this->getProperty('comp');
    }

    /**
     * Sets component number
     *
     * @param  int $componentNum
     * @return self
     */
    public function setComponentNum($componentNum)
    {
        return $this->setProperty('comp', (int) $componentNum);
    }

    /**
     * Gets changed sequence
     *
     * @return int
     */
    public function getModifiedSequence()
    {
        return $this->getProperty('ms');
    }

    /**
     * Sets changed sequence
     *
     * @param  int $modifiedSequence
     * @return self
     */
    public function setModifiedSequence($modifiedSequence)
    {
        return $this->setProperty('ms', (int) $modifiedSequence);
    }

    /**
     * Gets revision
     *
     * @return int
     */
    public function getRevision()
    {
        return $this->getProperty('rev');
    }

    /**
     * Sets revision
     *
     * @param  int $revision
     * @return self
     */
    public function setRevision($revision)
    {
        return $this->setProperty('rev', (int) $revision);
    }
}
