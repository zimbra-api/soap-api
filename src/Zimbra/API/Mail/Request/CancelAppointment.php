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
use Zimbra\Soap\Struct\InstanceRecurIdInfo;
use Zimbra\Soap\Struct\Msg;

/**
 * CancelAppointment request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CancelAppointment extends Request
{
    /**
     * Instance recurrence ID information
     * @var InstanceRecurIdInfo
     */
    private $_inst;

    /**
     * Instance recurrence ID information
     * @var CalTZInfo
     */
    private $_tz;

    /**
     * Message
     * @var Msg
     */
    private $_m;

    /**
     * ID of default invite
     * @var string
     */
    private $_id;

    /**
     * Component number of default invite
     * @var int
     */
    private $_comp;

    /**
     * Modified sequence
     * @var int
     */
    private $_ms;

    /**
     * Revision
     * @var int
     */
    private $_rev;

    /**
     * Constructor method for CancelAppointment
     * @param  InstanceRecurIdInfo $inst
     * @param  CalTZInfo $tz
     * @param  Msg $m
     * @param  string $id
     * @param  int $comp
     * @param  int $ms
     * @param  int $rev
     * @return self
     */
    public function __construct(
        InstanceRecurIdInfo $inst = null,
        CalTZInfo $tz = null,
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null
    )
    {
        parent::__construct();
        if($inst instanceof InstanceRecurIdInfo)
        {
            $this->_inst = $inst;
        }
        if($tz instanceof CalTZInfo)
        {
            $this->_tz = $tz;
        }
        if($m instanceof Msg)
        {
            $this->_m = $m;
        }
        $this->_id = trim($id);
        if(null !== $comp)
        {
            $this->_comp = (int) $comp;
        }
        if(null !== $ms)
        {
            $this->_ms = (int) $ms;
        }
        if(null !== $rev)
        {
            $this->_rev = (int) $rev;
        }
    }

    /**
     * Get or set inst
     *
     * @param  InstanceRecurIdInfo $inst
     * @return InstanceRecurIdInfo|self
     */
    public function inst(InstanceRecurIdInfo $inst = null)
    {
        if(null === $inst)
        {
            return $this->_inst;
        }
        $this->_inst = $inst;
        return $this;
    }

    /**
     * Get or set tz
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->_tz;
        }
        $this->_tz = $tz;
        return $this;
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
            return $this->_m;
        }
        $this->_m = $m;
        return $this;
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets or sets comp
     *
     * @param  int $comp
     * @return int|self
     */
    public function comp($comp = null)
    {
        if(null === $comp)
        {
            return $this->_comp;
        }
        $this->_comp = (int) $comp;
        return $this;
    }

    /**
     * Gets or sets ms
     *
     * @param  int $ms
     * @return int|self
     */
    public function ms($ms = null)
    {
        if(null === $ms)
        {
            return $this->_ms;
        }
        $this->_ms = (int) $ms;
        return $this;
    }

    /**
     * Gets or sets rev
     *
     * @param  int $rev
     * @return int|self
     */
    public function rev($rev = null)
    {
        if(null === $rev)
        {
            return $this->_rev;
        }
        $this->_rev = (int) $rev;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_id))
        {
            $this->array['id'] = $this->_id;
        }
        if(is_int($this->_comp))
        {
            $this->array['comp'] = $this->_comp;
        }
        if(is_int($this->_ms))
        {
            $this->array['ms'] = $this->_ms;
        }
        if(is_int($this->_rev))
        {
            $this->array['rev'] = $this->_rev;
        }
        if($this->_inst instanceof InstanceRecurIdInfo)
        {
            $this->array += $this->_inst->toArray('inst');
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->array += $this->_tz->toArray('tz');
        }
        if($this->_m instanceof Msg)
        {
            $this->array += $this->_m->toArray('m');
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
        if(!empty($this->_id))
        {
            $this->xml->addAttribute('id', $this->_id);
        }
        if(is_int($this->_comp))
        {
            $this->xml->addAttribute('comp', $this->_comp);
        }
        if(is_int($this->_ms))
        {
            $this->xml->addAttribute('ms', $this->_ms);
        }
        if(is_int($this->_rev))
        {
            $this->xml->addAttribute('rev', $this->_rev);
        }
        if($this->_inst instanceof InstanceRecurIdInfo)
        {
            $this->xml->append($this->_inst->toXml('inst'));
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->xml->append($this->_tz->toXml('tz'));
        }
        if($this->_m instanceof Msg)
        {
            $this->xml->append($this->_m->toXml('m'));
        }
        return parent::toXml();
    }
}
