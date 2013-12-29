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

use Zimbra\Soap\Struct\Msg;

/**
 * CreateAppointmentException request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateAppointmentException extends CalItemRequestBase
{
    /**
     * ID of default invite
     * @var string
     */
    private $_id;

    /**
     * Component of default invite
     * @var int
     */
    private $_comp;

    /**
     * Change sequence of fetched series
     * @var int
     */
    private $_ms;

    /**
     * Revision of fetched series
     * @var int
     */
    private $_rev;

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
     * Get or set id
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
     * Get or set comp
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
     * Get or set ms
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
     * Get or set rev
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
        return parent::toXml();
    }
}
