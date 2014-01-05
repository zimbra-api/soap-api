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
 * SizeTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SizeTest extends FilterTest
{
    /**
     * Number comparison
     * @var string
     */
    private $_numberComparison;

    /**
     * String
     * @var string
     */
    private $_s;

    /**
     * Constructor method for SizeTest
     * @param int $index
     * @param string $numberComparison
     * @param string $s
     * @return self
     */
    public function __construct(
        $index,
        $numberComparison = null,
        $s = null,
        $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_numberComparison = trim($numberComparison);
        $this->_s = trim($s);
    }

    /**
     * Gets or sets numberComparison
     *
     * @param  string $numberComparison
     * @return string|self
     */
    public function numberComparison($numberComparison = null)
    {
        if(null === $numberComparison)
        {
            return $this->_numberComparison;
        }
        $this->_numberComparison = trim($numberComparison);
        return $this;
    }

    /**
     * Gets or sets s
     *
     * @param  string $s
     * @return string|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->_s;
        }
        $this->_s = trim($s);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'sizeTest')
    {
        $name = !empty($name) ? $name : 'sizeTest';
        $arr = parent::toArray($name);
        if(!empty($this->_numberComparison))
        {
            $arr[$name]['numberComparison'] = $this->_numberComparison;
        }
        if(!empty($this->_s))
        {
            $arr[$name]['s'] = $this->_s;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'sizeTest')
    {
        $name = !empty($name) ? $name : 'sizeTest';
        $xml = parent::toXml($name);
        if(!empty($this->_numberComparison))
        {
            $xml->addAttribute('numberComparison', $this->_numberComparison);
        }
        if(!empty($this->_numberComparison))
        {
            $xml->addAttribute('s', $this->_s);
        }
        return $xml;
    }
}
