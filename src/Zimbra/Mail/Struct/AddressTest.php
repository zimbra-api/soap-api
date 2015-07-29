<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

/**
 * AddressTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddressTest extends FilterTest
{
    /**
     * Constructor method for AddressTest
     * @param int $index Index - specifies a guaranteed order for the test elements
     * @param string $header Header
     * @param string $part Part
     * @param string $comparison String comparison
     * @param string $value Value
     * @param bool $caseSensitive Case sensitive
     * @param bool $negative Specifies a "not" condition for the test
     * @return self
     */
    public function __construct(
        $index,
        $header,
        $part,
        $comparison,
        $value,
        $caseSensitive = null,
        $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->setProperty('header', trim($header));
        $this->setProperty('part', trim($part));
        $this->setProperty('stringComparison', trim($comparison));
        $this->setProperty('value', trim($value));
        if(null !== $caseSensitive)
        {
            $this->setProperty('caseSensitive', (bool) $caseSensitive);
        }
    }

    /**
     * Gets header
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->getProperty('header');
    }

    /**
     * Sets header
     *
     * @param  string $header
     * @return self
     */
    public function setHeader($header)
    {
        return $this->setProperty('header', trim($header));
    }

    /**
     * Gets part
     *
     * @return string
     */
    public function getPart()
    {
        return $this->getProperty('part');
    }

    /**
     * Sets part
     *
     * @param  string $part
     * @return self
     */
    public function setPart($part)
    {
        return $this->setProperty('part', trim($part));
    }

    /**
     * Gets comparison
     *
     * @return string
     */
    public function getComparison()
    {
        return $this->getProperty('stringComparison');
    }

    /**
     * Sets comparison
     *
     * @param  string $comparison
     * @return self
     */
    public function setComparison($comparison)
    {
        return $this->setProperty('stringComparison', trim($comparison));
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->getProperty('value');
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        return $this->setProperty('value', trim($value));
    }

    /**
     * Gets case sensitive setting
     *
     * @return bool
     */
    public function getCaseSensitive()
    {
        return $this->getProperty('caseSensitive');
    }

    /**
     * Sets case sensitive setting
     *
     * @param  bool $caseSensitive
     * @return self
     */
    public function setCaseSensitive($caseSensitive)
    {
        return $this->setProperty('caseSensitive', (bool) $caseSensitive);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'addressTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'addressTest')
    {
        return parent::toXml($name);
    }
}
