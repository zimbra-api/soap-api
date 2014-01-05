<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * FilterTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterTest
{
    /**
     * Index - specifies a guaranteed order for the test elements
     * @var int
     */
    private $_index;

    /**
     * Specifies a "not" condition for the test
     * @var bool
     */
    private $_negative;

    /**
     * Constructor method for FilterTest
     * @param int $index
     * @param bool $negative
     * @return self
     */
    public function __construct($index, $negative = null)
    {
        $this->_index = (int) $index;
        if(null !== $negative)
        {
            $this->_negative = (bool) $negative;
        }
    }

    /**
     * Gets or sets index
     *
     * @param  string $index
     * @return string|self
     */
    public function index($index = null)
    {
        if(null === $index)
        {
            return $this->_index;
        }
        $this->_index = (int) $index;
        return $this;
    }

    /**
     * Gets or sets negative
     *
     * @param  bool $negative
     * @return bool|self
     */
    public function negative($negative = null)
    {
        if(null === $negative)
        {
            return $this->_negative;
        }
        $this->_negative = (bool) $negative;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'filterTest')
    {
        $name = !empty($name) ? $name : 'filterTest';
        $arr = array('index' => $this->_index);
        if(is_bool($this->_negative))
        {
            $arr['negative'] = $this->_negative ? 1 : 0;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'filterTest')
    {
        $name = !empty($name) ? $name : 'filterTest';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('index', $this->_index);
        if(is_bool($this->_negative))
        {
            $xml->addAttribute('negative', $this->_negative ? 1 : 0);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
