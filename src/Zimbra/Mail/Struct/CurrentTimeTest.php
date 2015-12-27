<?php
/**
 * This file is time of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

/**
 * CurrentTimeTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CurrentTimeTest extends FilterTest
{

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
        if(null !== $dateComparison)
        {
            $this->setProperty('dateComparison', trim($dateComparison));
        }
        if(null !== $time)
        {
            $this->setProperty('time', trim($time));
        }
    }

    /**
     * Gets date comparison setting
     *
     * @return string
     */
    public function getDateComparison()
    {
        return $this->getProperty('dateComparison');
    }

    /**
     * Sets date comparison setting
     *
     * @param  string $dateComparison
     * @return self
     */
    public function setDateComparison($dateComparison)
    {
        return $this->setProperty('dateComparison', trim($dateComparison));
    }

    /**
     * Gets time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->getProperty('time');
    }

    /**
     * Sets time
     *
     * @param  string $time
     * @return self
     */
    public function setTime($time)
    {
        return $this->setProperty('time', trim($time));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'currentTimeTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'currentTimeTest')
    {
        return parent::toXml($name);
    }
}
