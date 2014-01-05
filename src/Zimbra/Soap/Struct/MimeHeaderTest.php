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
 * MimeHeaderTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MimeHeaderTest extends FilterTest
{
    /**
     * Header
     * @var string
     */
    private $_header;

    /**
     * String comparison
     * @var string
     */
    private $_stringComparison;

    /**
     * Value
     * @var string
     */
    private $_value;

    /**
     * Case sensitive
     * @var bool
     */
    private $_caseSensitive;

    /**
     * Constructor method for MimeHeaderTest
     * @param int $index
     * @param string $header
     * @param string $stringComparison
     * @param string $value
     * @param bool $caseSensitive
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index,
        $header = null,
        $stringComparison = null,
        $value = null,
        $caseSensitive = null,
        $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_header = trim($header);
        $this->_stringComparison = trim($stringComparison);
        $this->_value = trim($value);
        if(null !== $caseSensitive)
        {
            $this->_caseSensitive = (bool) $caseSensitive;
        }
    }

    /**
     * Gets or sets header
     *
     * @param  string $header
     * @return string|self
     */
    public function header($header = null)
    {
        if(null === $header)
        {
            return $this->_header;
        }
        $this->_header = trim($header);
        return $this;
    }

    /**
     * Gets or sets stringComparison
     *
     * @param  string $stringComparison
     * @return string|self
     */
    public function stringComparison($stringComparison = null)
    {
        if(null === $stringComparison)
        {
            return $this->_stringComparison;
        }
        $this->_stringComparison = trim($stringComparison);
        return $this;
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets or sets caseSensitive
     *
     * @param  bool $caseSensitive
     * @return bool|self
     */
    public function caseSensitive($caseSensitive = null)
    {
        if(null === $caseSensitive)
        {
            return $this->_caseSensitive;
        }
        $this->_caseSensitive = (bool) $caseSensitive;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'mimeHeaderTest')
    {
        $name = !empty($name) ? $name : 'mimeHeaderTest';
        $arr = parent::toArray($name);
        if(!empty($this->_header))
        {
            $arr[$name]['header'] = $this->_header;
        }
        if(!empty($this->_stringComparison))
        {
            $arr[$name]['stringComparison'] = $this->_stringComparison;
        }
        if(!empty($this->_value))
        {
            $arr[$name]['value'] = $this->_value;
        }
        if(is_bool($this->_caseSensitive))
        {
            $arr[$name]['caseSensitive'] = $this->_caseSensitive ? 1 : 0;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'mimeHeaderTest')
    {
        $name = !empty($name) ? $name : 'mimeHeaderTest';
        $xml = parent::toXml($name);
        if(!empty($this->_header))
        {
            $xml->addAttribute('header', $this->_header);
        }
        if(!empty($this->_header))
        {
            $xml->addAttribute('stringComparison', $this->_stringComparison);
        }
        if(!empty($this->_header))
        {
            $xml->addAttribute('value', $this->_value);
        }
        if(is_bool($this->_caseSensitive))
        {
            $xml->addAttribute('caseSensitive', $this->_caseSensitive ? 1 : 0);
        }
        return $xml;
    }
}
