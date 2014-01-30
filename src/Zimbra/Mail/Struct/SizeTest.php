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
        if(null !== $numberComparison)
        {
            $this->property('numberComparison', trim($numberComparison));
        }
        $this->_numberComparison = trim($numberComparison);
        if(null !== $s)
        {
            $this->property('s', trim($s));
        }
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
            return $this->property('numberComparison');
        }
        return $this->property('numberComparison', trim($numberComparison));
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
            return $this->property('s');
        }
        return $this->property('s', trim($s));
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
