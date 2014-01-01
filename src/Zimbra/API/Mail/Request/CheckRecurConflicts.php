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
use Zimbra\Soap\Struct\FreeBusyUserSpec;
use Zimbra\Utils\TypedSequence;

/**
 * CheckRecurConflicts request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckRecurConflicts extends Request
{
    /**
     * Timezones
     * @var TypedSequence<CalTZInfo>
     */
    private $_tz;

    /**
     * Cancel
     * @var ExpandedRecurrenceCancel
     */
    private $_cancel;

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
     * Freebusy user specifications
     * @var TypedSequence<FreeBusyUserSpec>
     */
    private $_usr;

    /**
     * Start time in millis. If not specified, defaults to current time
     * @var int
     */
    private $_s;

    /**
     * End time in millis. If not specified, unlimited
     * @var String
     */
    private $_e;

    /**
     * Set this to get all instances, even those without conflicts.
     * By default only instances that have conflicts are returned.
     * @var bool
     */
    private $_all;

    /**
     * UID of appointment to exclude from free/busy search
     * @var string
     */
    private $_excludeUid;

    /**
     * Constructor method for CheckRecurConflicts
     * @param  array $tz
     * @param  ExpandedRecurrenceCancel $cancel
     * @param  ExpandedRecurrenceInvite $comp
     * @param  ExpandedRecurrenceException $except
     * @param  array $usr
     * @param  int $s
     * @param  int $e
     * @param  bool $all
     * @param  string $excludeUid
     * @return self
     */
    public function __construct(
        array $tz = array(),
        ExpandedRecurrenceCancel $cancel = null,
        ExpandedRecurrenceInvite $comp = null,
        ExpandedRecurrenceException $except = null,
        array $usr = array(),
        $s = null,
        $e = null,
        $all = null,
        $excludeUid = null
    )
    {
        parent::__construct();
        $this->_tz = new TypedSequence('Zimbra\Soap\Struct\CalTZInfo', $tz);
        if($cancel instanceof ExpandedRecurrenceCancel)
        {
            $this->_cancel = $cancel;
        }
        if($comp instanceof ExpandedRecurrenceInvite)
        {
            $this->_comp = $comp;
        }
        if($except instanceof ExpandedRecurrenceException)
        {
            $this->_except = $except;
        }
        $this->_usr = new TypedSequence('Zimbra\Soap\Struct\FreeBusyUserSpec', $usr);
        if(null !== $s)
        {
            $this->_s = (int) $s;
        }
        if(null !== $e)
        {
            $this->_e = (int) $e;
        }
        if(null !== $all)
        {
            $this->_all = (bool) $all;
        }

        $this->_excludeUid = trim($excludeUid);
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
     * Add usr
     *
     * @param  FreeBusyUserSpec $usr
     * @return self
     */
    public function addUsr(FreeBusyUserSpec $usr)
    {
        $this->_usr->add($usr);
        return $this;
    }

    /**
     * Gets usr sequence
     *
     * @return Sequence
     */
    public function usr()
    {
        return $this->_usr;
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
     * Gets or sets all
     *
     * @param  bool $all
     * @return bool|self
     */
    public function all($all = null)
    {
        if(null === $all)
        {
            return $this->_all;
        }
        $this->_all = (bool) $all;
        return $this;
    }

    /**
     * Gets or sets excludeUid
     *
     * @param  string $excludeUid
     * @return string|self
     */
    public function excludeUid($excludeUid = null)
    {
        if(null === $excludeUid)
        {
            return $this->_excludeUid;
        }
        $this->_excludeUid = trim($excludeUid);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_tz))
        {
            $this->array['tz'] = array();
            foreach ($this->_tz as $tz)
            {
                $tzArr = $tz->toArray('tz');
                $this->array['tz'][] = $tzArr['tz'];
            }
        }
        if($this->_cancel instanceof ExpandedRecurrenceCancel)
        {
            $this->array += $this->_cancel->toArray('cancel');
        }
        if($this->_comp instanceof ExpandedRecurrenceInvite)
        {
            $this->array += $this->_comp->toArray('comp');
        }
        if($this->_except instanceof ExpandedRecurrenceException)
        {
            $this->array += $this->_except->toArray('except');
        }
        if(count($this->_usr))
        {
            $this->array['usr'] = array();
            foreach ($this->_usr as $usr)
            {
                $usrArr = $usr->toArray('usr');
                $this->array['usr'][] = $usrArr['usr'];
            }
        }
        if(is_int($this->_s))
        {
            $this->array['s'] = $this->_s;
        }
        if(is_int($this->_e))
        {
            $this->array['e'] = $this->_e;
        }
        if(is_bool($this->_all))
        {
            $this->array['all'] = $this->_all ? 1 : 0;
        }
        if(!empty($this->_excludeUid))
        {
            $this->array['excludeUid'] = $this->_excludeUid;
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
        foreach ($this->_tz as $tz)
        {
            $this->xml->append($tz->toXml('tz'));
        }
        if($this->_cancel instanceof ExpandedRecurrenceCancel)
        {
            $this->xml->append($this->_cancel->toXml('cancel'));
        }
        if($this->_comp instanceof ExpandedRecurrenceInvite)
        {
            $this->xml->append($this->_comp->toXml('comp'));
        }
        if($this->_except instanceof ExpandedRecurrenceException)
        {
            $this->xml->append($this->_except->toXml('except'));
        }
        foreach ($this->_usr as $usr)
        {
            $this->xml->append($usr->toXml('usr'));
        }
        if(is_int($this->_s))
        {
            $this->xml->addAttribute('s', $this->_s);
        }
        if(is_int($this->_e))
        {
            $this->xml->addAttribute('e', $this->_e);
        }
        if(is_bool($this->_all))
        {
            $this->xml->addAttribute('all', $this->_all ? 1 : 0);
        }
        if(!empty($this->_excludeUid))
        {
            $this->xml->addAttribute('excludeUid', $this->_excludeUid);
        }
        return parent::toXml();
    }
}
