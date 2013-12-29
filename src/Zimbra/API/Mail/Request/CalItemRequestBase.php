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
use Zimbra\Soap\Struct\Msg;

/**
 * CalItemRequestBase request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class CalItemRequestBase extends Request
{
    /**
     * Message
     * @var Msg
     */
    private $_m;

    /**
     * If specified, the created appointment is echoed back in the response as if a GetMsgRequest was made
     * @var bool
     */
    private $_echo;

    /**
     * Maximum inlined length
     * @var int
     */
    private $_max;

    /**
     * Set if want HTML included in echoing
     * @var bool
     */
    private $_html;

    /**
     * Set if want "neuter" set for echoed response
     * @var bool
     */
    private $_neuter;

    /**
     * If set, ignore smtp 550 errors when sending the notification to attendees.
     * If unset, throw the soapfaultexception with invalid addresses so that client can give the forcesend option to the end user.
     * The default is 1.
     * @var bool
     */
    private $_forcesend;

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
            $this->_m = $m;
        }
        if(null !== $echo)
        {
            $this->_echo = (bool) $echo;
        }
        if(null !== $max)
        {
            $this->_max = (int) $max;
        }
        if(null !== $html)
        {
            $this->_html = (bool) $html;
        }
        if(null !== $neuter)
        {
            $this->_neuter = (bool) $neuter;
        }
        if(null !== $forcesend)
        {
            $this->_forcesend = (bool) $forcesend;
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
            return $this->_m;
        }
        $this->_m = $m;
        return $this;
    }

    /**
     * Get or set echo
     *
     * @param  bool $echo
     * @return bool|self
     */
    public function echo_($echo = null)
    {
        if(null === $echo)
        {
            return $this->_echo;
        }
        $this->_echo = (bool) $echo;
        return $this;
    }

    /**
     * Get or set max
     *
     * @param  int $max
     * @return int|self
     */
    public function max($max = null)
    {
        if(null === $max)
        {
            return $this->_max;
        }
        $this->_max = (int) $max;
        return $this;
    }

    /**
     * Get or set html
     *
     * @param  bool $html
     * @return bool|self
     */
    public function html($html = null)
    {
        if(null === $html)
        {
            return $this->_html;
        }
        $this->_html = (bool) $html;
        return $this;
    }

    /**
     * Get or set neuter
     *
     * @param  bool $neuter
     * @return bool|self
     */
    public function neuter($neuter = null)
    {
        if(null === $neuter)
        {
            return $this->_neuter;
        }
        $this->_neuter = (bool) $neuter;
        return $this;
    }

    /**
     * Get or set forcesend
     *
     * @param  bool $forcesend
     * @return bool|self
     */
    public function forcesend($forcesend = null)
    {
        if(null === $forcesend)
        {
            return $this->_forcesend;
        }
        $this->_forcesend = (bool) $forcesend;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_echo))
        {
            $this->array['echo'] = $this->_echo ? 1 : 0;
        }
        if(is_int($this->_max))
        {
            $this->array['max'] = $this->_max;
        }
        if(is_bool($this->_html))
        {
            $this->array['html'] = $this->_html ? 1 : 0;
        }
        if(is_bool($this->_neuter))
        {
            $this->array['neuter'] = $this->_neuter ? 1 : 0;
        }
        if(is_bool($this->_forcesend))
        {
            $this->array['forcesend'] = $this->_forcesend ? 1 : 0;
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
        if(is_bool($this->_echo))
        {
            $this->xml->addAttribute('echo', $this->_echo ? 1 : 0);
        }
        if(is_int($this->_max))
        {
            $this->xml->addAttribute('max', $this->_max);
        }
        if(is_bool($this->_html))
        {
            $this->xml->addAttribute('html', $this->_html ? 1 : 0);
        }
        if(is_bool($this->_neuter))
        {
            $this->xml->addAttribute('neuter', $this->_neuter ? 1 : 0);
        }
        if(is_bool($this->_forcesend))
        {
            $this->xml->addAttribute('forcesend', $this->_forcesend ? 1 : 0);
        }
        if($this->_m instanceof Msg)
        {
            $this->xml->append($this->_m->toXml('m'));
        }
        return parent::toXml();
    }
}
