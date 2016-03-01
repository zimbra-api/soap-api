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
 * CreateAppointmentException request class
 * Create Appointment Exception.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateAppointmentException extends CalItemRequestBase
{
    /**
     * Constructor method for CreateAppointmentException
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
     *     ID of default invite
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets component of default invite
     *
     * @return int
     */
    public function getComponentNum()
    {
        return $this->getProperty('comp');
    }

    /**
     * Sets component of default invite
     *
     * @param  int $comp
     * @return self
     */
    public function setComponentNum($comp)
    {
        return $this->setProperty('comp', (int) $comp);
    }

    /**
     * Gets change sequence of fetched series
     *
     * @return int
     */
    public function getModifiedSequence()
    {
        return $this->getProperty('ms');
    }

    /**
     * Sets change sequence of fetched series
     *
     * @param  int $ms
     * @return self
     */
    public function setModifiedSequence($ms)
    {
        return $this->setProperty('ms', (int) $ms);
    }

    /**
     * Gets revision of fetched series
     *
     * @return int
     */
    public function getRevision()
    {
        return $this->getProperty('rev');
    }

    /**
     * Sets revision of fetched series
     *
     * @param  int $rev
     * @return self
     */
    public function setRevision($rev)
    {
        return $this->setProperty('rev', (int) $rev);
    }
}
