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

use Zimbra\Common\TypedSequence;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceComponent;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;

/**
 * ExpandRecur request class
 * Expand recurrences
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExpandRecur extends Base
{
    /**
     * Timezones
     * @var TypedSequence<CalTZInfo>
     */
    private $_timezones;

    /**
     * Components
     * @var TypedSequence<ExpandedRecurrenceComponent>
     */
    private $_components;

    /**
     * Constructor method for ExpandRecur
     * @param  int $startTime
     * @param  int $endTime
     * @param  array $timezones
     * @param  array $components
     * @return self
     */
    public function __construct(
        $startTime,
        $endTime,
        array $timezones = [],
        array $components = []
    )
    {
        parent::__construct();
        $this->setProperty('s', (int) $startTime);
        $this->setProperty('e', (int) $endTime);

        $this->setTimezones($timezones);
        $this->setComponents($components);

        $this->on('before', function(Base $sender)
        {
            if($sender->getTimezones()->count())
            {
                $sender->setChild('tz', $sender->getTimezones()->all());
            }

            if($sender->getComponents()->count())
            {
                foreach ($sender->getComponents()->all() as $component)
                {
                    if($component instanceof ExpandedRecurrenceInvite)
                    {
                        $this->setChild('comp', $component);
                    }
                    if($component instanceof ExpandedRecurrenceException)
                    {
                        $this->setChild('except', $component);
                    }
                    if($component instanceof ExpandedRecurrenceCancel)
                    {
                        $this->setChild('cancel', $component);
                    }
                }
            }
        });
    }

    /**
     * Gets start time
     *
     * @return int
     */
    public function getStartTime()
    {
        return $this->getProperty('s');
    }

    /**
     * Sets start time
     *
     * @param  int $startTime
     *    Start time in milliseconds
     * @return self
     */
    public function setStartTime($startTime)
    {
        return $this->setProperty('s', (int) $startTime);
    }

    /**
     * Gets end time
     *
     * @return int
     */
    public function getEndTime()
    {
        return $this->getProperty('e');
    }

    /**
     * Sets end time
     *
     * @param  int $endTime
     *    End time in milliseconds
     * @return self
     */
    public function setEndTime($endTime)
    {
        return $this->setProperty('e', (int) $endTime);
    }

    /**
     * Add timezone
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function addTimezone(CalTZInfo $tz)
    {
        $this->_timezones->add($tz);
        return $this;
    }

    /**
     * Sets timezone sequence
     *
     * @param  array $timezones
     * @return self
     */
    public function setTimezones(array $timezones)
    {
        $this->_timezones = new TypedSequence('Zimbra\Mail\Struct\CalTZInfo', $timezones);
        return $this;
    }

    /**
     * Gets timezone sequence
     *
     * @return Sequence
     */
    public function getTimezones()
    {
        return $this->_timezones;
    }

    /**
     * Add component
     *
     * @param  ExpandedRecurrenceComponent $component
     * @return self
     */
    public function addComponent(ExpandedRecurrenceComponent $component)
    {
        $this->_components->add($component);
        return $this;
    }

    /**
     * Sets component sequence
     *
     * @param  array $components
     * @return self
     */
    public function setComponents(array $components)
    {
        $this->_components = new TypedSequence('Zimbra\Mail\Struct\ExpandedRecurrenceComponent', $components);
        return $this;
    }

    /**
     * Gets component sequence
     *
     * @return Sequence
     */
    public function getComponents()
    {
        return $this->_components;
    }
}
