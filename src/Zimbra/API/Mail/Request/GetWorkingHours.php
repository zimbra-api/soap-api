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
 * GetWorkingHours request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetWorkingHours extends Request
{
    /**
     * Range start in milliseconds since the epoch
     * @var int
     */
    private $_s;

    /**
     * Range end in milliseconds since the epoch
     * @var int
     */
    private $_e;

    /**
     * Comma-separated list of Zimbra IDs
     * @var string
     */
    private $_id;

    /**
     * Comma-separated list of email addresses
     * @var string
     */
    private $_name;

    /**
     * Constructor method for GetWorkingHours
     * @param  int $s
     * @param  int $e
     * @param  string $id
     * @param  string $name
     * @return self
     */
    public function __construct($s, $e, $id = null, $name = null)
    {
        parent::__construct();
        $this->_s = (int) $s;
        $this->_e = (int) $e;
        $this->_id = trim($id);
        $this->_name = trim($name);
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
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
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
        if(!empty($this->_id))
        {
            $this->array['id'] = $this->_id;
        }
        if(!empty($this->_name))
        {
            $this->array['name'] = $this->_name;
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
        if(!empty($this->_id))
        {
            $this->xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_name))
        {
            $this->xml->addAttribute('name', $this->_name);
        }
        return parent::toXml();
    }
}
