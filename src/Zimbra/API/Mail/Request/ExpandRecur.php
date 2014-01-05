<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\CalTZInfo;
use Zimbra\Soap\Struct\ExpandedRecurrenceCancel;
use Zimbra\Soap\Struct\ExpandedRecurrenceInvite;
use Zimbra\Soap\Struct\ExpandedRecurrenceException;
use Zimbra\Utils\TypedSequence;

/**
 * ExpandRecur request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExpandRecur extends Request
{
    /**
     * Timezones
     * @var TypedSequence<CalTZInfo>
     */
    private $_tz;

    /**
     * Comp
     * @var ExpandedRecurrenceInvite
     */
    private $_comp;

    /**
     * Except
     * @var ExpandedRecurrenceException
     */
    private $_except;

    /**
     * Cancel
     * @var ExpandedRecurrenceCancel
     */
    private $_cancel;

    /**
     * Start time in milliseconds
     * @var int
     */
    private $_s;

    /**
     * End time in milliseconds
     * @var int
     */
    private $_e;

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
        $this->_s = (int) $s;
        $this->_e = (int) $e;

        $this->_tz = new TypedSequence('Zimbra\Soap\Struct\CalTZInfo', $tz);
        if($comp instanceof ExpandedRecurrenceInvite)
        {
            $this->_comp = $comp;
        }
        if($except instanceof ExpandedRecurrenceException)
        {
            $this->_except = $except;
        }
        if($cancel instanceof ExpandedRecurrenceCancel)
        {
            $this->_cancel = $cancel;
        }
    }

    /**
     * Gets or sets s
     *
     * @param  int $s
     * @return int|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->_s;
        }
        $this->_s = (int) $s;
        return $this;
    }

    /**
     * Gets or sets e
     *
     * @param  int $e
     * @return int|self
     */
    public function e($e = null)
    {
        if(null === $e)
        {
            return $this->_e;
        }
        $this->_e = (int) $e;
        return $this;
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
            return $this->_comp;
        }
        $this->_comp = $comp;
        return $this;
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
            return $this->_except;
        }
        $this->_except = $except;
        return $this;
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
            return $this->_cancel;
        }
        $this->_cancel = $cancel;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['s'] = $this->_s;
        $this->array['e'] = $this->_e;
        if(count($this->_tz))
        {
            $this->array['tz'] = array();
            foreach ($this->_tz as $tz)
            {
                $tzArr = $tz->toArray('tz');
                $this->array['tz'][] = $tzArr['tz'];
            }
        }
        if($this->_comp instanceof ExpandedRecurrenceInvite)
        {
            $this->array += $this->_comp->toArray('comp');
        }
        if($this->_except instanceof ExpandedRecurrenceException)
        {
            $this->array += $this->_except->toArray('except');
        }
        if($this->_cancel instanceof ExpandedRecurrenceCancel)
        {
            $this->array += $this->_cancel->toArray('cancel');
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('s', $this->_s)
                  ->addAttribute('e', $this->_e);
        foreach ($this->_tz as $tz)
        {
            $this->xml->append($tz->toXml('tz'));
        }
        if($this->_comp instanceof ExpandedRecurrenceInvite)
        {
            $this->xml->append($this->_comp->toXml('comp'));
        }
        if($this->_except instanceof ExpandedRecurrenceException)
        {
            $this->xml->append($this->_except->toXml('except'));
        }
        if($this->_cancel instanceof ExpandedRecurrenceCancel)
        {
            $this->xml->append($this->_cancel->toXml('cancel'));
        }
        return parent::toXml();
    }
}
