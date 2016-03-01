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
        $date = null,
        $negative = null
    )
    {
        parent::__construct($index, $negative);
        if(null !== $dateComparison)
        {
            $this->setProperty('dateComparison', trim($dateComparison));
        }
        if(null !== $date)
        {
            $this->setProperty('d', (int) $date);
        }
    }

    /**
     * Gets dateComparison
     *
     * @return string
     */
    public function getDateComparison()
    {
        return $this->getProperty('dateComparison');
    }

    /**
     * Sets dateComparison
     *
     * @param  string $dateComparison
     * @return self
     */
    public function setDateComparison($dateComparison)
    {
        return $this->setProperty('dateComparison', trim($dateComparison));
    }

    /**
     * Gets date
     *
     * @return int
     */
    public function getDate()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets date
     *
     * @param  int $date
     * @return self
     */
    public function setDate($date)
    {
        return $this->setProperty('d', (int) $date);
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
