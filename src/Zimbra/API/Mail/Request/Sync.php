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

/**
 * Sync request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Sync extends Request
{
    /**
     * Token - not provided for initial sync
     * @var string
     */
    private $_token;

    /**
     * Earliest Calendar date.
     * If present, omit all appointments and tasks that don't have a recurrence ending after that time (specified in ms)
     * @var int
     */
    private $_calCutoff;

    /**
     * Root folder ID.
     * If present, we start sync there rather than at folder 11
     * @var string
     */
    private $_l;

    /**
     * If specified and set, deletes are also broken down by item type
     * @var bool
     */
    private $_typed;

    /**
     * Constructor method for Sync
     * @param  string $token
     * @param  int   $calCutoff
     * @param  string $l
     * @param  bool   $typed
     * @return self
     */
    public function __construct(
        $token = null,
        $calCutoff = null,
        $l = null,
        $typed = null
    )
    {
        parent::__construct();
        $this->_token = trim($token);
        if(null !== $calCutoff)
        {
            $this->_calCutoff = (int) $calCutoff;
        }
        $this->_l = trim($l);
        if(null !== $typed)
        {
            $this->_typed = (bool) $typed;
        }
    }

    /**
     * Get or set token
     *
     * @param  string $token
     * @return string|self
     */
    public function token($token = null)
    {
        if(null === $token)
        {
            return $this->_token;
        }
        $this->_token = trim($token);
        return $this;
    }

    /**
     * Get or set calCutoff
     *
     * @param  int $calCutoff
     * @return int|self
     */
    public function calCutoff($calCutoff = null)
    {
        if(null === $calCutoff)
        {
            return $this->_calCutoff;
        }
        $this->_calCutoff = (int) $calCutoff;
        return $this;
    }

    /**
     * Get or set l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->_l;
        }
        $this->_l = trim($l);
        return $this;
    }

    /**
     * Get or set typed
     *
     * @param  bool $typed
     * @return bool|self
     */
    public function typed($typed = null)
    {
        if(null === $typed)
        {
            return $this->_typed;
        }
        $this->_typed = (bool) $typed;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_token))
        {
            $this->array['token'] = $this->_token;
        }
        if(is_int($this->_calCutoff))
        {
            $this->array['calCutoff'] = $this->_calCutoff;
        }
        if(!empty($this->_l))
        {
            $this->array['l'] = $this->_l;
        }
        if(is_bool($this->_typed))
        {
            $this->array['typed'] = $this->_typed ? 1 : 0;
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
        if(!empty($this->_token))
        {
            $this->xml->addAttribute('token', $this->_token);
        }
        if(is_int($this->_calCutoff))
        {
            $this->xml->addAttribute('calCutoff', $this->_calCutoff);
        }
        if(!empty($this->_l))
        {
            $this->xml->addAttribute('l', $this->_l);
        }
        if(is_bool($this->_typed))
        {
            $this->xml->addAttribute('typed', $this->_typed ? 1 : 0);
        }
        return parent::toXml();
    }
}
