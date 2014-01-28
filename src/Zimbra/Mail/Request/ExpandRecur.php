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
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;
use Zimbra\Soap\Request;

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
class ExpandRecur extends Request
{
    /**
     * Timezones
     * @var TypedSequence<CalTZInfo>
     */
    private $_tz;

    /**
     * Constructor method for CheckRecurConflicts
     * @param  int $s
     * @param  int $e
     * @param  array $tz
     * @param  ExpandedRecurrenceInvite $comp
     * @param  ExpandedRecurrenceException $except
     * @param  ExpandedRecurrenceCancel $cancel
     * @return self
     */
    public function __construct(
        $s,
        $e,
        array $tz = array(),
        ExpandedRecurrenceInvite $comp = null,
        ExpandedRecurrenceException $except = null,
        ExpandedRecurrenceCancel $cancel = null
    )
    {
        parent::__construct();
        $this->property('s', (int) $s);
        $this->property('e', (int) $e);

        $this->_tz = new TypedSequence('Zimbra\Mail\Struct\CalTZInfo', $tz);
        if($comp instanceof ExpandedRecurrenceInvite)
        {
            $this->child('comp', $comp);
        }
        if($except instanceof ExpandedRecurrenceException)
        {
            $this->child('except', $except);
        }
        if($cancel instanceof ExpandedRecurrenceCancel)
        {
            $this->child('cancel', $cancel);
        }

        $this->addHook(function($sender)
        {
            if(count($sender->tz()))
            {
                $sender->child('tz', $sender->tz()->all());
            }
        });
    }

    /**
     * Gets or sets s
     * End time in milliseconds
     *
     * @param  int $s
     * @return int|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->property('s');
        }
        return $this->property('s', (int) $s);
    }

    /**
     * Gets or sets e
     * Start time in milliseconds
     *
     * @param  int $e
     * @return int|self
     */
    public function e($e = null)
    {
        if(null === $e)
        {
            return $this->property('e');
        }
        return $this->property('e', (int) $e);
    }

    /**
     * Add tz
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function addTz(CalTZInfo $tz)
    {
        $this->_tz->add($tz);
        return $this;
    }

    /**
     * Gets tz sequence
     *
     * @return Sequence
     */
    public function tz()
    {
        return $this->_tz;
    }

    /**
     * Gets or sets comp
     *
     * @param  ExpandedRecurrenceInvite $comp
     * @return ExpandedRecurrenceInvite|self
     */
    public function comp(ExpandedRecurrenceInvite $comp = null)
    {
        if(null === $comp)
        {
            return $this->child('comp');
        }
        return $this->child('comp', $comp);
    }

    /**
     * Gets or sets except
     *
     * @param  ExpandedRecurrenceException $except
     * @return ExpandedRecurrenceException|self
     */
    public function except(ExpandedRecurrenceException $except = null)
    {
        if(null === $except)
        {
            return $this->child('except');
        }
        return $this->child('except', $except);
    }

    /**
     * Gets or sets cancel
     *
     * @param  ExpandedRecurrenceCancel $cancel
     * @return ExpandedRecurrenceCancel|self
     */
    public function cancel(ExpandedRecurrenceCancel $cancel = null)
    {
        if(null === $cancel)
        {
            return $this->child('cancel');
        }
        return $this->child('cancel', $cancel);
    }
}
