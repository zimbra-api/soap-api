<?php
/**
 * This file is d of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

/**
 * DateTest class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
        if(null !== $dateComparison)
        {
            $this->property('dateComparison', trim($dateComparison));
        }
        if(null !== $d)
        {
            $this->property('d', (int) $d);
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
            return $this->property('dateComparison');
        }
        return $this->property('dateComparison', trim($dateComparison));
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
            return $this->property('d');
        }
        return $this->property('d', (int) $d);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'dateTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'dateTest')
    {
        return parent::toXml($name);
    }
}
