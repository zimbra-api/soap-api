<?php
/**
 * This file is time of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * CurrentTimeTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CurrentTimeTest extends FilterTest
{
    /**
     * Date comparison
     * @var string
     */
    private $_dateComparison;

    /**
     * Time
     * @var string
     */
    private $_time;

    /**
     * Constructor method for CurrentTimeTest
     * @param int $index
     * @param string $dateComparison
     * @param string $time
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index,
        $dateComparison = null,
        $time = null,
        $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_dateComparison = trim($dateComparison);
        $this->_time = trim($time);
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
     * Gets or sets time
     *
     * @param  string $time
     * @return string|self
     */
    public function time($time = null)
    {
        if(null === $time)
        {
            return $this->_time;
        }
        $this->_time = trim($time);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'currentTimeTest')
    {
        $name = !empty($name) ? $name : 'currentTimeTest';
        $arr = parent::toArray($name);
        if(!empty($this->_dateComparison))
        {
            $arr[$name]['dateComparison'] = $this->_dateComparison;
        }
        if(!empty($this->_time))
        {
            $arr[$name]['time'] = $this->_time;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'currentTimeTest')
    {
        $name = !empty($name) ? $name : 'currentTimeTest';
        $xml = parent::toXml($name);
        if(!empty($this->_dateComparison))
        {
            $xml->addAttribute('dateComparison', $this->_dateComparison);
        }
        if(!empty($this->_time))
        {
            $xml->addAttribute('time', $this->_time);
        }
        return $xml;
    }
}
