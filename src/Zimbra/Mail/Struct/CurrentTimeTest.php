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
     * Date comparison
     * @var string
     */
    private $_dateComparison;

    /**
     * Time
     * @var string
     */
    private $_time;

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
            $this->property('dateComparison', trim($dateComparison));
        }
        if(null !== $time)
        {
            $this->property('time', trim($time));
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
     * Gets or sets time
     *
     * @param  string $time
     * @return string|self
     */
    public function time($time = null)
    {
        if(null === $time)
        {
            return $this->property('time');
        }
        return $this->property('time', trim($time));
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
