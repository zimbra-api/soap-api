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
 * SizeTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SizeTest extends FilterTest
{
    /**
     * Constructor method for SizeTest
     * @param int $index
     * @param string $numberComparison Number comparison setting - over|under
     * @param string $size Size value
     *    Value can be specified in bytes (no suffix), kilobytes (50K), megabytes (50M) or gigabytes (2G)
     * @return self
     */
    public function __construct(
        $index,
        $numberComparison = null,
        $size = null,
        $negative = null
    )
    {
        parent::__construct($index, $negative);
        if(null !== $numberComparison)
        {
            $this->setProperty('numberComparison', trim($numberComparison));
        }
        $this->_numberComparison = trim($numberComparison);
        if(null !== $size)
        {
            $this->setProperty('s', trim($size));
        }
    }

    /**
     * Gets number comparison setting
     *
     * @return string
     */
    public function getNumberComparison()
    {
        return $this->getProperty('numberComparison');
    }

    /**
     * Sets number comparison setting
     *
     * @param  string $numberComparison
     * @return self
     */
    public function setNumberComparison($numberComparison)
    {
        return $this->setProperty('numberComparison', trim($numberComparison));
    }

    /**
     * Gets size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->getProperty('s');
    }

    /**
     * Sets size
     *
     * @param  string $s
     * @return self
     */
    public function setSize($s)
    {
        return $this->setProperty('s', trim($s));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'sizeTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'sizeTest')
    {
        return parent::toXml($name);
    }
}
