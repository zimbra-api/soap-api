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
 * GetApptSummaries request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetApptSummaries extends Request
{
    /**
     * Range start in milliseconds since the epoch GMT
     * @var int
     */
    private $_s;

    /**
     * Range end in milliseconds since the epoch GMT
     * @var int
     */
    private $_e;

    /**
     * Folder ID.
     * Optional folder to constrain requests to; otherwise, searches all folders but trash and spam
     * @var string
     */
    private $_l;

    /**
     * Constructor method for GetApptSummaries
     * @param  int    $s
     * @param  int    $e
     * @param  string $l
     * @return self
     */
    public function __construct($s, $e, $l = null)
    {
        parent::__construct();
        $this->_s = (int) $s;
        $this->_e = (int) $e;
        $this->_l = trim($l);
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            's' => $this->_s,
            'e' => $this->_e,
        );
        if(!empty($this->_l))
        {
            $this->array['l'] = $this->_l;
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
        if(!empty($this->_l))
        {
            $this->xml->addAttribute('l', $this->_l);
        }
        return parent::toXml();
    }
}
