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
 * HeaderTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class HeaderTest extends FilterTest
{
    /**
     * Constructor method for HeaderTest
     * @param int $index Index - specifies a guaranteed order for the test elements
     * @param string $header Header. Comma separated list of header names.
     * @param string $stringComparison String comparison
     * @param string $value Value
     * @param bool $caseSensitive Case sensitive
     * @param bool $negative Specifies a "not" condition for the test
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
        if(null !== $header)
        {
            $this->setProperty('header', trim($header));
        }
        if(null !== $stringComparison)
        {
            $this->setProperty('stringComparison', trim($stringComparison));
        }
        if(null !== $value)
        {
            $this->setProperty('value', trim($value));
        }
        if(null !== $caseSensitive)
        {
            $this->setProperty('caseSensitive', (bool) $caseSensitive);
        }
    }

    /**
     * Gets headers
     *
     * @return string
     */
    public function getHeaders()
    {
        return $this->getProperty('header');
    }

    /**
     * Sets headers
     *
     * @param  string $header
     * @return self
     */
    public function setHeaders($header)
    {
        return $this->setProperty('header', trim($header));
    }

    /**
     * Gets string comparison
     *
     * @return string
     */
    public function getStringComparison()
    {
        return $this->getProperty('stringComparison');
    }

    /**
     * Sets string comparison
     *
     * @param  string $stringComparison
     * @return self
     */
    public function setStringComparison($stringComparison)
    {
        return $this->setProperty('stringComparison', trim($stringComparison));
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
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'headerTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'headerTest')
    {
        return parent::toXml($name);
    }
}
