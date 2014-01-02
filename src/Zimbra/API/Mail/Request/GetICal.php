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
 * GetICal request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetICal extends Request
{
    /**
     * If specified, gets the iCalendar representation for one invite
     * @var string
     */
    private $_id;

    /**
     * Range start in milliseconds
     * @var int
     */
    private $_s;

    /**
     * Range end in milliseconds
     * @var int
     */
    private $_e;

    /**
     * Constructor method for GetICal
     * @param  string $id
     * @param  int $s
     * @param  int $e
     * @return self
     */
    public function __construct(
        $id = null,
        $s = null,
        $e = null
    )
    {
        parent::__construct();
        $this->_id = trim($id);
        $this->_s = (int) $s;
        $this->_e = (int) $e;
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
     * Get or set s
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
     * Get or set e
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
        if(is_int($this->_s))
        {
            $this->array['s'] = $this->_s;
        }
        if(is_int($this->_e))
        {
            $this->array['e'] = $this->_e;
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
        if(is_int($this->_s))
        {
            $this->xml->addAttribute('s', $this->_s);
        }
        if(is_int($this->_e))
        {
            $this->xml->addAttribute('e', $this->_e);
        }
        return parent::toXml();
    }
}
