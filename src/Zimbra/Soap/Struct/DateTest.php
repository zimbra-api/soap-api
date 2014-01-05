<?php
/**
 * This file is d of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * DateTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DateTest extends FilterTest
{
    /**
     * Date comparison
     * @var string
     */
    private $_dateComparison;

    /**
     * Date
     * @var string
     */
    private $_d;

    /**
     * Constructor method for DateTest
     * @param int $index
     * @param string $dateComparison
     * @param int $d
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index,
        $dateComparison = null,
        $d = null,
        $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_dateComparison = trim($dateComparison);
        if(null !== $d)
        {
	        $this->_d = (int) $d;
        }
    }

    /**
     * Gets or sets dateComparison
     *
     * @param  string $dateComparison
     * @return string|self
     */
    public function dateComparison($dateComparison = null)
    {
        if(null === $dateComparison)
        {
            return $this->_dateComparison;
        }
        $this->_dateComparison = trim($dateComparison);
        return $this;
    }

    /**
     * Gets or sets d
     *
     * @param  int $d
     * @return int|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->_d;
        }
        $this->_d = (int) $d;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'dateTest')
    {
        $name = !empty($name) ? $name : 'dateTest';
        $arr = parent::toArray($name);
        if(!empty($this->_dateComparison))
        {
            $arr[$name]['dateComparison'] = $this->_dateComparison;
        }
        if(is_int($this->_d))
        {
            $arr[$name]['d'] = $this->_d;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'dateTest')
    {
        $name = !empty($name) ? $name : 'dateTest';
        $xml = parent::toXml($name);
        if(!empty($this->_dateComparison))
        {
            $xml->addAttribute('dateComparison', $this->_dateComparison);
        }
        if(is_int($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        return $xml;
    }
}
